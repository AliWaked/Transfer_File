<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem;
use ZipArchive;

class UploadFilesController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'file.*' => 'required|file',
        ]);
        $identifier = Str::random(40) . time();
        $files = $request->file('file');
        foreach ($files as $file) {
            $fileName =  time() . '*' . $file->getClientOriginalName();
            $path[] = $file->storeAs("/upload/$identifier", $fileName, ['disk' => 'public']);
        }
        File::create([
            'title' => $request->title,
            'message' => $request->message,
            'path' => $path,
            'identifier' => $identifier,
        ]);
        // Session::put('link', url("files/$identifier"));
        // Session::remove('')
        return to_route('home')->with('link', url("files/$identifier"));
    }
    public function show(File $file)
    {
        return view('download', ['file' => $file]);
    }
    public function download(File $file)
    {
        $files = Storage::disk('public')->files("upload/$file->identifier");
        $zipFile = storage_path('app/' . $file->title . '.zip');
        $zip = new ZipArchive;
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            foreach ($files as $file) {
                $fileContent = Storage::disk('public')->get($file);
                $zip->addFromString($file, $fileContent);
            }
            $zip->close();
        }

        return response()->download($zipFile)->deleteFileAfterSend(true);
    }
    public function downloadSingleFile(Request $request)
    {
        // dd($request->path);
        $path = $request->query('path');
        return Storage::disk('public')->download($path, Str::after($path, '*'));
    }
}
