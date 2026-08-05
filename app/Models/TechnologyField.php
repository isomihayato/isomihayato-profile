<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechnologyField extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function experiencedTechnologies(): HasMany
    {
        return $this->hasMany(ExperiencedTechnology::class)->orderBy('name');
    }
}
