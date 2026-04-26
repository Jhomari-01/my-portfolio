<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        $resume = Resume::first();
        if (!$resume) {
            return response()->json([
                'basicInfo' => [
                    'name' => '',
                    'address' => '',
                    'contact' => '',
                    'email' => '',
                    'profileImageLight' => '',
                    'profileImageDark' => '',
                    'resumePdf' => '',
                ],
                'careerObjective' => '',
                'educationalBackground' => [],
                'workExperience' => [],
                'trainings' => [],
                'personalInfo' => (object)[],
                'references' => [],
                'skills' => []
            ]);
        }

        // Map database columns to frontend structure
        return response()->json([
            'basicInfo' => [
                'name' => $resume->name,
                'address' => $resume->address,
                'contact' => $resume->contact,
                'email' => $resume->email,
                'profileImageLight' => $resume->profile_image_light,
                'profileImageDark' => $resume->profile_image_dark,
                'resumePdf' => $resume->resume_pdf,
            ],
            'careerObjective' => $resume->career_objective,
            'educationalBackground' => $resume->educational_background ?? [],
            'workExperience' => $resume->work_experience ?? [],
            'trainings' => $resume->trainings ?? [],
            'personalInfo' => $resume->personal_info ?? (object)[],
            'references' => $resume->references ?? [],
            'skills' => $resume->skills ?? [],
            'downloads' => $resume->downloads ?? 0
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $basicInfo = $data['basicInfo'] ?? [];

        $resume = Resume::firstOrNew();
        
        $resume->fill([
            'name' => $basicInfo['name'] ?? null,
            'address' => $basicInfo['address'] ?? null,
            'contact' => $basicInfo['contact'] ?? null,
            'email' => $basicInfo['email'] ?? null,
            'profile_image_light' => $basicInfo['profileImageLight'] ?? null,
            'profile_image_dark' => $basicInfo['profileImageDark'] ?? null,
            'resume_pdf' => $basicInfo['resumePdf'] ?? null,
            'career_objective' => $data['careerObjective'] ?? null,
            'educational_background' => $data['educationalBackground'] ?? [],
            'work_experience' => $data['workExperience'] ?? [],
            'trainings' => $data['trainings'] ?? [],
            'personal_info' => $data['personalInfo'] ?? [],
            'references' => $data['references'] ?? [],
            'skills' => $data['skills'] ?? [],
        ]);

        $resume->save();

        return response()->json(['message' => 'Resume saved successfully', 'resume' => $resume]);
    }

    public function incrementDownloads()
    {
        $resume = Resume::first();
        if ($resume) {
            $resume->increment('downloads');
            return response()->json(['downloads' => $resume->downloads]);
        }
        return response()->json(['downloads' => 0]);
    }
}
