<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSecurityController extends Controller
{
    /**
     * Get current credentials (username only for security)
     */
    public function index()
    {
        $user = User::first();
        if (!$user) {
            // Create default admin if none exists
            $user = User::create([
                'name' => 'Admin',
                'username' => 'Dev_Joms',
                'email' => 'admin@example.com',
                'password' => Hash::make('Tsuitachi_01'), // Default password
            ]);
        }
        return response()->json([
            'username' => $user->username,
            'email' => $user->email
        ]);
    }

    /**
     * Update credentials
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'oldPassword' => 'required|string',
            'newPassword' => 'nullable|string|min:6',
        ]);

        $user = User::first();
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Verify old password
        if (!Hash::check($validated['oldPassword'], $user->password)) {
            return response()->json(['message' => 'Current password incorrect'], 422);
        }

        // Update username
        $user->username = $validated['username'];
        $user->name = $validated['username']; // Keep name in sync for simplicity

        // Update password if provided
        if (!empty($validated['newPassword'])) {
            $user->password = Hash::make($validated['newPassword']);
        }

        $user->save();

        return response()->json([
            'message' => 'Credentials updated successfully',
            'username' => $user->username
        ]);
    }

    /**
     * Handle Login
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $validated['username'])->first();

        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json(['message' => 'Invalid username or password'], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'username' => $user->username,
            'success' => true
        ]);
    }
}
