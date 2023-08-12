<?php

namespace App\Http\Middleware;

use App\Models\File;
use Closure;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class PathValidation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Storage::disk(File::DISK)->exists($path = $request->path)) {
            // throw new FileNotFoundException("The path='{$path}' is not valid !");
            abort(404);
        }
        return $next($request);
    }
}
