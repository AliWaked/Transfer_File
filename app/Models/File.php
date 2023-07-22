<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'message', 'path', 'identifier',
    ];
    protected $casts = [
        'path' => 'json',
    ];
    public function getTotalSizeAttribute()
    {
        $files = Storage::disk('public')->files("upload/{$this->identifier}");
        $sum = 0;
        foreach ($files as $file) {
            $sum += Storage::disk('public')->size($file);
        }
        return round($sum / (1024 * 1024), 2);
    }
    public function getFileSize(string $path)
    {
        return round(Storage::disk('public')->size($path) / (1024 * 1024), 2);
    }
}
