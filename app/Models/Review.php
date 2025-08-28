<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;

class Review extends TranslatableModel
{
    use Translatable;

    protected $fillable = [
        'name',
        'rating',
        'date',
        'text',
        'status'
    ];

    /** @noinspection PhpUnused */
    public array $translatedAttributes = ['name','text'];
}
