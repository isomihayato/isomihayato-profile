<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExperiencedTechnology extends Model
{
    use HasFactory;

    protected $fillable = ['technology_field_id', 'name'];

    public function technologyField(): BelongsTo
    {
        return $this->belongsTo(TechnologyField::class);
    }
}
