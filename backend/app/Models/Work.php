<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Work extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $fillable = [
        'title', 'start_year', 'stop_year', 'description', 'start_month', 'stop_month', 'image', 'experiences'
    ];

    protected $casts = [
        'experiences' => 'array',
    ];

    /**
     * The experience of the experience group.
     */
    public function experiences(): BelongsToMany
    {
        return $this->belongsToMany(Experience::class);
    }
}
