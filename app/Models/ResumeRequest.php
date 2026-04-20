<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResumeRequest extends Model
{
    protected $fillable = [
        'email',
        'purpose',
        'status',
        'submitted_at',
    ];

    protected $casts = [
        'submitted_at' => 'datetime',
    ];
}
