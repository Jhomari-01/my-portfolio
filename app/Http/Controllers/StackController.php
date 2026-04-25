<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stack;

class StackController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Stack::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        return Stack::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Stack $stack)
    {
        return $stack;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Stack $stack)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'image' => 'nullable|string',
            'is_featured' => 'nullable|boolean',
        ]);

        $stack->update($validated);

        return $stack;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Stack $stack)
    {
        $stack->delete();

        return response()->json(['message' => 'Stack deleted successfully']);
    }
}
