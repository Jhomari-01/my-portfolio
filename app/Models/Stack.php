<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stack extends Model
{
    protected $fillable = [
        'name',
        'category',
        'image',
        'is_featured'
    ];

    protected $casts = [
        'is_featured' => 'boolean'
    ];
}
