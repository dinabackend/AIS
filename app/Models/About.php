<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class About extends TranslatableModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['sort'];

    protected $translatedAttributes = ['title', 'subtitle', 'description'];
}
