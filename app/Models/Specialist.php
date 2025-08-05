<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Specialist extends TranslatableModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'position',
        'main',
        'image'
    ];

    public array $translatedAttributes = ['name', 'description', 'position'];

}
