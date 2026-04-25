<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\SocialLink;

class SocialLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return SocialLink::first() ?: response()->json([]);
    }

    /**
     * Store a newly created resource in storage (or update the existing one).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'gmail' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'github' => 'nullable|string',
            'instagram' => 'nullable|string',
            'facebook' => 'nullable|string',
            'viber' => 'nullable|string',
        ]);

        // We only ever want one record for social links
        $links = SocialLink::updateOrCreate(
            ['id' => 1], // Fixed ID for the single settings record
            $validated
        );

        return $links;
    }
}
