<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    protected $casts = [
        'content' => 'array',
        'tags' => 'array',
    ];

    protected $fillable = [
        'title', 'description', 'content', 'tags'
    ];
}
