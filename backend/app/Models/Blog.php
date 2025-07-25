<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Translatable\HasTranslations;

class Blog extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;
    use HasTranslations;

    protected $casts = [
        'content' => 'array',
        'tags' => 'array',
        'title' => 'string',
        'description' => 'string',
    ];

    protected $fillable = [
        'title', 'description', 'content', 'tags'
    ];

    protected $translatable= [
        'title', 'description', 'content', 'tags'
    ];
}
