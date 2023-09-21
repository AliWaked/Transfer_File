<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FilesController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $user = Auth::user();
        $all_files = $user->files();
        if ($request->type == 'received') {
            $all_files = File::where('email', $user->email);
        }
        $files = $all_files->filter($request->all())->get()->groupBy(function (File $file) {
            $file->number_of_file = $file->getNumberOfItems($file->identifier);
            $file->send_at = $file->created_at->diffForHumans();
            return $file->created_at->format('F Y');
        });
        return Response::json($files);
    }
}
