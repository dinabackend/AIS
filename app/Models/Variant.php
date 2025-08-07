<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public function characteristics()
    {
        return $this->morphMany(Characteristic::class, 'characteristicable');
    }
    public function sections()
    {
        return $this->morphMany(\App\Models\Section::class, 'sectionable');
    }
}
