<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method static count()
 */
class Event extends TranslatableModel implements HasMedia
{
    use Translatable, InteractsWithMedia;

    protected $fillable = ['title', 'description', 'image', 'img', 'time', 'category', 'status', 'top'];

    public array $translatedAttributes = ['title', 'description'];
}
