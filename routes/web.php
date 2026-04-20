<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ResumeRequestController;
use App\Http\Controllers\UploadController;

// Define specific API/Upload routes BEFORE the catch-all route
Route::post('/upload', [UploadController::class, 'upload']);
Route::get('/resume-requests', [ResumeRequestController::class, 'index']);
Route::post('/resume-requests', [ResumeRequestController::class, 'store']);
Route::post('/resume-requests/check-access', [ResumeRequestController::class, 'checkAccess']);
Route::patch('/resume-requests/{resumeRequest}/status', [ResumeRequestController::class, 'updateStatus']);

// Catch-all route for Vue Router
Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
