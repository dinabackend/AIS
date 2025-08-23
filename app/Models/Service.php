<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Service extends TranslatableModel implements HasMedia
{
    use Translatable, InteractsWithMedia;
    protected $fillable =['title', 'description', 'img', 'locale'];

    protected array $translatedAttributes = ['title', 'description'];
}
