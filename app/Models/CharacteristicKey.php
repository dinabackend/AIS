<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CharacteristicKey extends TranslatableModel
{
    use Translatable;

    protected $fillable = [
        'name',
        'locale'
    ];

    public array $translatedAttributes = ['name'];

    public function characteristics(): HasMany
    {
        return $this->hasMany(Characteristic::class);
    }
}
