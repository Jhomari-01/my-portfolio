<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSecurityController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\AboutImageController;
use App\Http\Controllers\StackController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\WorkController;

use App\Http\Controllers\UploadController;

// Define specific API/Upload routes BEFORE the catch-all route
// Fallback route to serve files directly on shared hosting without needing symlinks
Route::get('/storage/files/{filename}', function ($filename) {
    $path = storage_path('app/public/files/' . $filename);
    if (!file_exists($path)) {
        abort(404);
    }
    $file = file_get_contents($path);
    $type = mime_content_type($path);
    return response($file, 200)->header('Content-Type', $type);
})->where('filename', '.*');
Route::post('/upload', [UploadController::class, 'upload']);
Route::apiResource('works', WorkController::class);
Route::apiResource('certificates', CertificateController::class);
Route::apiResource('stacks', StackController::class);
Route::apiResource('about-images', AboutImageController::class);
Route::apiResource('social-links', SocialLinkController::class);
Route::get('/admin-security', [AdminSecurityController::class, 'index']);
Route::post('/admin-security', [AdminSecurityController::class, 'store']);
Route::post('/admin-login', [AdminSecurityController::class, 'login']);


Route::get('/resume', [App\Http\Controllers\ResumeController::class, 'index']);
Route::post('/resume', [App\Http\Controllers\ResumeController::class, 'store']);
Route::post('/resume/increment-downloads', [App\Http\Controllers\ResumeController::class, 'incrementDownloads']);

// Catch-all route for Vue Router
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
