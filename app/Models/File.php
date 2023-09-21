<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use ZipArchive;

class File extends Model
{
    use HasFactory;
    const DISK = 'uploads';
    protected $fillable = [
        'title',
        'message',
        'identifier',
        'total',
        'user_id',
    ];
    protected $hidden = [
        'updated_at', 'created_at',
    ];
    protected $appends = [
        'file_link',
        'total_size'
    ];
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
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE)) {
            static::addFolderToZip($sourceFolderPath, $zip);
            $zip->close();
        }
        return $zipFile;
    }
    public static function addFolderToZip($sourceFolderPath, $zip, $parentFolder = '')
    {
        $handle = opendir($sourceFolderPath);
        while (false !== ($file = readdir($handle))) {
            if ($file !== '.' && $file !== '..') {
                $filePath = $sourceFolderPath . '/' . $file;
                $relativePath = ltrim($parentFolder . '/' . $file, '/');
                if (is_file($filePath)) {
                    $zip->addFile($filePath, $relativePath);
                } elseif (is_dir($filePath)) {
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
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function fileLink(): Attribute
    {
        return Attribute::make(
            get: fn () =>  URL::temporarySignedRoute('file.show', now()->addDays(7), ['file' => $this->identifier]),
        );
    }
    public function scopeFilter(Builder $query, ?array $options = []): void
    {
        $query->when($options['search'] ?? false, function (Builder $builder, $value) {
            $builder->where('title', 'like', "%$value%")
                ->orWhere('email', 'like', "%$value%");
        });
        $query->when($options['sort'] ?? false, function (Builder $builder, $value) {
            $value == 'asc' ?: $value = 'desc';
            $builder->orderBy('created_at', $value);
        });
    }
}
