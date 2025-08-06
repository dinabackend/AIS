<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;

class Service extends TranslatableModel
{
    use Translatable;
    protected $fillable =['title', 'description', 'img', 'locale'];

    protected array $translatedAttributes = ['title', 'description'];
}
