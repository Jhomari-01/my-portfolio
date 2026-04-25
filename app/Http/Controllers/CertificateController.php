<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Certificate;

class CertificateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Certificate::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'link' => 'nullable|string',
            'issuer' => 'required|string',
            'year_issued' => 'nullable|string',
            'description' => 'nullable|string',
            'cert_file' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        return Certificate::create($validated);
    }

    /**
     * Display the specified resource.
     */
    public function show(Certificate $certificate)
    {
        return $certificate;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Certificate $certificate)
    {
        $validated = $request->validate([
            'title' => 'required|string',
            'link' => 'nullable|string',
            'issuer' => 'required|string',
            'year_issued' => 'nullable|string',
            'description' => 'nullable|string',
            'cert_file' => 'nullable|array',
            'is_featured' => 'boolean',
        ]);

        $certificate->update($validated);

        return $certificate;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete();

        return response()->json(['message' => 'Certificate deleted successfully']);
    }
}
