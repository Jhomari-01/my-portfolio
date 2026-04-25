<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AboutImage;

class AboutImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AboutImage::all();
    }

    /**
     * Store a newly created resource in storage.
     * This method acts as a sync: it replaces all existing images with the new set.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'images' => 'required|array',
            'images.*.data' => 'required|string', // Support base64 or URL
        ]);

        // Clear existing images
        AboutImage::truncate();

        // Add new images
        foreach ($validated['images'] as $img) {
            AboutImage::create(['image' => $img['data']]);
        }

        return AboutImage::all();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutImage $aboutImage)
    {
        $aboutImage->delete();
        return response()->json(['message' => 'Image removed']);
    }
}
