<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'address', 'contact', 'email', 
        'profile_image_light', 'profile_image_dark', 'resume_pdf',
        'career_objective', 'educational_background', 
        'work_experience', 'trainings', 'personal_info', 'references',
        'skills'
    ];

    protected $casts = [
        'educational_background' => 'array',
        'work_experience' => 'array',
        'trainings' => 'array',
        'personal_info' => 'array',
        'references' => 'array',
        'skills' => 'array',
    ];
}
