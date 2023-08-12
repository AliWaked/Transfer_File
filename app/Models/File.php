<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class File extends Model
{
    use HasFactory;
    const DISK = 'uploads';
    protected $fillable = [
        'title', 'message', 'identifier',
    ];
    // protected $casts = [
    //     'path' => 'json',
    // ];
    protected static function booted(): void
    {
        // static::deleted(function (File $file) {
        //     Storage::disk(self::DISK)->deleteDirectory($file->identifier);
        // });
        // static::creating(function (File $file) {
        //     $file->user_id = Auth::id();
        // });
    }
    public function getTotalSizeAttribute(): float
    {
        $files = Storage::disk(self::DISK)->allFiles("/{$this->identifier}");
        $sum = 0;
        foreach ($files as $file) {
            $sum += Storage::disk(self::DISK)->size($file);
        }
        return round($sum / (1024 * 1024), 2);
    }
    public function getFileSize(string $path): float
    {
        return round(Storage::disk(self::DISK)->size($path) / (1024 * 1024), 2);
    }


    public static function generateZipFile(string $folderPath, string $nameFilezip)
    {
        $zip = new ZipArchive;
        $zipFile = storage_path("app/{$nameFilezip}.zip");
        $sourceFolderPath = Storage::disk(File::DISK)->path($folderPath);
        // File::generateZipFile($zipFile, $sourceFolderPath);
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            static::addFolderToZip($sourceFolderPath, $zip);
            $zip->close();
        }
        return $zipFile;
    }
    public static function addFolderToZip($sourceFolderPath, $zip, $parentFolder = '')
    {
        $handle = opendir($sourceFolderPath);
        // Loop through the folder and its contents
        while (false !== ($file = readdir($handle))) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $sourceFolderPath . '/' . $file;
                $relativePath = ltrim($parentFolder . '/' . $file, '/');

                if (is_file($filePath)) {
                    // Add the file to the ZIP archive
                    $zip->addFile($filePath, $relativePath);
                } elseif (is_dir($filePath)) {
                    // Recursively add the sub-folder and its contents
                    static::addFolderToZip($filePath, $zip, $relativePath);
                }
            }
        }

        closedir($handle);
    }
    public function getNumberOfItems(string $folderPath)
    {
        return count(Storage::disk(self::DISK)->allFiles($folderPath));
    }
    public function getNumberOfFilesAttribute()
    {
        return count(Storage::disk(self::DISK)->allFiles($this->identifier));
    }
    public function getFilesAttribute()
    {
        return Storage::disk(self::DISK)->files($this->identifier);
    }
    public function getFoldersAttribute()
    {
        return Storage::disk(self::DISK)->directories($this->identifier);
    }
}
