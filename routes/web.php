<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\CustomRequestPasswordController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\SocailiteController;
use App\Http\Controllers\UploadFilesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/auth/{provider}/callback', [SocailiteController::class, 'callback'])->middleware('guest')->name('socialite.callback');
Route::controller(UploadFilesController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/files/{file:identifier}', 'show')->middleware('signed')->name('file.show');
    Route::get('/download/file', 'download')->middleware('verifiedPath')->name('file.download');
    Route::get('/download/{file:identifier}', 'downloadAll')->name('download');
    Route::post('/uploads', 'store')->name('file.upload');
});
// Route::view('/', 'index')->name('password.reset');
Route::view('/test', 'test');
Route::get('/reset-password', [CustomRequestPasswordController::class, 'index'])->name('password.reset');

Route::get('/auth/{provider}/redirect', [SocailiteController::class, 'redirect'])->name('socialite.redirect');

Route::get('/filter', [FilesController::class, 'index']);
Route::get('/my-contact', [ContactController::class, 'index']);
Route::post('/my-contact', [ContactController::class, 'store']);
