<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Experience extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $casts = [
        'proficiency' => ExperienceLevel::class,
    ];

    protected $fillable = [
        'title', 'description', 'start_year', 'proficiency', 'image', 'experience_group_id', 'icon_abbreviation',
    ];

    public function experienceGroup(): BelongsTo
    {
        return $this->belongsTo(ExperienceGroup::class);
    }
}
