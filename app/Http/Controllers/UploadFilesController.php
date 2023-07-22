<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use League\Flysystem\Filesystem;
// use League\Flysystem\Adapter\Local;
use ZipArchive;

class UploadFilesController extends Controller
{
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
            dd($file);
            $path[] = $file->storeAs("/upload/$identifier", $fileName, ['disk' => 'public']);
            // Storage::disk('pubic')->append('/upload',$file)
        }
        // dd($request->all(), $request->file('file')[0]->getClientOriginalName(), Str::beforeLast($fileName[0], '*'));
        File::create([
            'title' => $request->title,
            'message' => $request->message,
            'path' => $path,
            'identifier' => $identifier,
        ]);
        return to_route('home');
    }
    public function show(File $file)
    {
        // $files = Storage::disk('public')->files("upload/$file->identifier");
        // $zipFile = storage_path('app/' . $file->title . '.zip');
        // $zip = new ZipArchive;
        // if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
        //     foreach ($files as $file) {
        //         $fileContent = Storage::disk('public')->get($file);
        //         $zip->addFromString($file, $fileContent);
        //     }
        //     $zip->close();
        // }

        // return response()->download($zipFile)->deleteFileAfterSend(true);
        return view('download',['file' => $file]);
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
}
