<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminSecurityController;
use App\Http\Controllers\SocialLinkController;
use App\Http\Controllers\AboutImageController;
use App\Http\Controllers\StackController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ResumeRequestController;
use App\Http\Controllers\UploadController;

// Define specific API/Upload routes BEFORE the catch-all route
Route::post('/upload', [UploadController::class, 'upload']);
Route::apiResource('works', WorkController::class);
Route::apiResource('certificates', CertificateController::class);
Route::apiResource('stacks', StackController::class);
Route::apiResource('about-images', AboutImageController::class);
Route::apiResource('social-links', SocialLinkController::class);
Route::get('/admin-security', [AdminSecurityController::class, 'index']);
Route::post('/admin-security', [AdminSecurityController::class, 'store']);
Route::post('/admin-login', [AdminSecurityController::class, 'login']);
Route::get('/resume-requests', [ResumeRequestController::class, 'index']);
Route::post('/resume-requests', [ResumeRequestController::class, 'store']);
Route::post('/resume-requests/check-access', [ResumeRequestController::class, 'checkAccess']);
Route::patch('/resume-requests/{resumeRequest}/status', [ResumeRequestController::class, 'updateStatus']);

Route::get('/resume', [App\Http\Controllers\ResumeController::class, 'index']);
Route::post('/resume', [App\Http\Controllers\ResumeController::class, 'store']);

// Catch-all route for Vue Router
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
