<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExperienceGroup extends Model
{
    protected $fillable = [
        'name', 'description', 'color'
    ];

    /**
     * The experience of the experience group.
     */
    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }
}
