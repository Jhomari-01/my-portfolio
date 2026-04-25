<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Work;

class WorkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Work::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'link' => 'nullable|string',
            'github_link' => 'nullable|string',
            'stacks' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'files' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        return Work::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Work $work)
    {
        return $work;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Work $work)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'link' => 'nullable|string',
            'github_link' => 'nullable|string',
            'stacks' => 'nullable|string',
            'summary' => 'nullable|string',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'files' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        $work->update($validated);

        return $work;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Work $work)
    {
        $work->delete();

        return response()->json(['message' => 'Work deleted successfully']);
    }
}
