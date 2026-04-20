<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpeg,png,jpg,gif,svg,mp4,webm,pdf|max:51200', // 50MB max
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            
            // Store in storage/app/public/files
            $path = $file->store('files', 'public');
            
            // Return the public URL
            return response()->json([
                'url' => Storage::url($path),
                'name' => $file->getClientOriginalName(),
            ]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
