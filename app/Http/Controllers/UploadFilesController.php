<?php

namespace App\Http\Controllers;

use App\Http\Requests\FileRequest;
use App\Models\File;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View as ViewFacade;
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

    public function index(): View
    {
        return ViewFacade::make('index');
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

        $link = URL::temporarySignedRoute('file.show', now()->addDays(7), ['file' => $this->identifier]);

        $data = [
            'title' => $request->title,
            'message' => $request->message,
            'identifier' => $this->identifier,
        ];

        if ($request->type == 'email' && $user_id = Auth::id()) {
            $data['user_id'] = $user_id;
            $data['email_to'] = $request->email_to;
        }

        File::create($data);
        // event();
        return response()->json(
            [
                'code' => 1,
                'message' => 'Decompression successful',
                'link' => $link
            ]
        );
    }

    public function show(File $file): View
    {
        return view('download', ['file' => $file]);
    }

    public function downloadAll(File $file): BinaryFileResponse
    {
        $zipFile = File::generateZipFile($file->identifier, $file->title);
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
}
