<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'title',
        'link',
        'issuer',
        'year_issued',
        'description',
        'cert_file',
        'is_featured',
    ];

    protected $casts = [
        'cert_file' => 'array',
        'is_featured' => 'boolean',
    ];
}
