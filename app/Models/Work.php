<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Work extends Model
{
    protected $fillable = [
        'title',
        'link',
        'github_link',
        'stacks',
        'summary',
        'description',
        'features',
        'files',
        'is_featured',
    ];

    protected $casts = [
        'files' => 'array',
        'is_featured' => 'boolean',
    ];
}
