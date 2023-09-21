<?php

namespace App\Http\Controllers;

use App\Events\DownloadFile;
use App\Http\Requests\FileRequest;
use App\Models\File;
use App\Models\User;
use Hamcrest\Type\IsObject;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\StreamedResponse;
use ZipArchive;

use function PHPSTORM_META\type;

class UploadFilesController extends Controller
{
    private readonly string $identifier;
    public function __construct()
    {
        $this->identifier = Str::random(40);
        // $this->identifier = Str::uuid()->toString();
    }

    public function index(Request $request): View
    {
        // dd($request->header('user-agent'),$request->ip());
        $data = [];
        if ($user = Auth::user()) {
            $data['files'] = Auth::user()->files()->latest()->get()->groupBy(function (File $file) {
                return $file->created_at->format('F Y');
            });
        }
        return view('index', $data);
    }

    public function store(FileRequest $request): JsonResponse
    {
        $folders = $request->file('folder');
        $files = $request->file('file');

        if ($files) {
            foreach ($files as $file) {
                $this->storeAsClientOriginalName($file);
            }
        }

        if ($folders) {
            foreach ($folders as $folder) {
                $this->uploadFolder($folder);
            }
        }

        // $link = URL::temporarySignedRoute('file.show', now()->addDays(7), ['file' => $this->identifier]);

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'identifier' => $this->identifier,
        ];

        if ($request->type == 'email' && $user_id = Auth::id()) {
            $data['user_id'] = $user_id;
            $data['email_to'] = $request->email_to;
        }

        $file = File::create($data);
        return response()->json(
            [
                'code' => 1,
                'message' => 'Decompression successful',
                'link' => $file->file_link
            ]
        );
    }

    public function show(File $file): View
    {
        return view('download', ['file' => $file]);
    }

    public function downloadAll(Request $request, File $file): BinaryFileResponse
    {
        $zipFile = File::generateZipFile($file->identifier, $file->title);
        // event(new DownloadFile($file, ['ip' => $request->ip, 'user_agent' => $request->user_agent]));
        DownloadFile::dispatch($file, [
            'ip' => $request->ip(),
            'user_agent' => $request->header('user-agent'),
        ]);
        return Response::download($zipFile)->deleteFileAfterSend(true);
    }

    public function download(Request $request): StreamedResponse|BinaryFileResponse
    {
        $path = $request->path;
        if (Storage::disk(File::DISK)->fileExists($request->query('path'))) {
            $path = $request->query('path');
            return Storage::disk(File::DISK)->download($path, Str::after($path, '*'));
        }
        $zipFile = File::generateZipFile($path, Str::afterLast($path, '/'));
        return Response::download($zipFile)->deleteFileAfterSend(true);
    }

    protected function uploadFolder(object $folder): void
    {
        $zip = new \ZipArchive();
        $zipFilePath = $folder->getPathname();
        $extractedFolderPath = Storage::disk(File::DISK)->path($this->identifier);
        if (!file_exists($extractedFolderPath)) {
            mkdir($extractedFolderPath, 0777, true);
        }
        if ($zip->open($zipFilePath) === true) {
            $zip->extractTo($extractedFolderPath);
            $zip->close();
        }
        // $folderName = Str::afterLast($folder->getClientOriginalName(), '.zip');
        // return "$extractedFolderPath/{$folderName}";
    }

    public function storeAsClientOriginalName(object $file): void
    {
        $fileName = time() . '*' . $file->getClientOriginalName();
        $file->storeAs("/{$this->identifier}", $fileName, ['disk' => File::DISK]);
    }

    public function filter(Request $request): JsonResponse
    {
        $files = Auth::user()->files()->filter($request->all())->get()->groupBy(function (File $file) {
            $file->number_of_file = $file->getNumberOfItems($file->identifier);
            $file->send_at = $file->created_at->diffForHumans();
            return $file->created_at->format('F Y');
        });
        return Response::json($files);
    }
}
