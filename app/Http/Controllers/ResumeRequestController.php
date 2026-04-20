<?php

namespace App\Http\Controllers;

use App\Models\ResumeRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ResumeRequestController extends Controller
{
    private function normalizeEmail(string $email): string
    {
        return strtolower(trim($email));
    }

    public function index(): JsonResponse
    {
        return response()->json(
            ResumeRequest::query()
                ->orderByDesc('submitted_at')
                ->orderByDesc('id')
                ->get()
        );
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'purpose' => ['required', 'string', 'max:2000'],
        ]);

        $normalizedEmail = $this->normalizeEmail($validated['email']);

        $existingRequest = ResumeRequest::query()
            ->whereRaw('LOWER(email) = ?', [$normalizedEmail])
            ->orderByDesc('submitted_at')
            ->orderByDesc('id')
            ->first();

        if ($existingRequest) {
            if ($existingRequest->status === 'accepted') {
                return response()->json([
                    'action' => 'accepted',
                    'message' => 'This email is already approved for resume access.',
                    'request' => $existingRequest,
                ]);
            }

            $existingRequest->update([
                'purpose' => $validated['purpose'],
                'status' => 'pending',
                'submitted_at' => now(),
            ]);

            return response()->json([
                'action' => 'updated',
                'message' => 'Your existing request was refreshed with the latest submission date.',
                'request' => $existingRequest->fresh(),
            ]);
        }

        $resumeRequest = ResumeRequest::create([
            'email' => $normalizedEmail,
            'purpose' => $validated['purpose'],
            'status' => 'pending',
            'submitted_at' => now(),
        ]);

        return response()->json([
            'action' => 'created',
            'message' => 'Your resume request has been sent successfully.',
            'request' => $resumeRequest,
        ], 201);
    }

    public function checkAccess(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => ['required', 'email', 'max:255'],
        ]);

        $normalizedEmail = $this->normalizeEmail($validated['email']);

        $approvedRequest = ResumeRequest::query()
            ->whereRaw('LOWER(email) = ?', [$normalizedEmail])
            ->where('status', 'accepted')
            ->latest()
            ->first();

        if ($approvedRequest) {
            return response()->json([
                'authorized' => true,
                'status' => 'accepted',
            ]);
        }

        $latestRequest = ResumeRequest::query()
            ->whereRaw('LOWER(email) = ?', [$normalizedEmail])
            ->latest()
            ->first();

        return response()->json([
            'authorized' => false,
            'status' => $latestRequest?->status ?? 'not_found',
        ]);
    }

    public function updateStatus(Request $request, ResumeRequest $resumeRequest): JsonResponse
    {
        $validated = $request->validate([
            'status' => ['required', 'in:accepted,declined'],
        ]);

        $resumeRequest->update($validated);

        return response()->json($resumeRequest->fresh());
    }
}
