<?php

namespace App\Models\Extend;

use App\Facades\Component\Partial;

trait MultiLanguage
{
    
    public function getNameAttribute()
    {
        return Partial::getName($this);
    }
}
