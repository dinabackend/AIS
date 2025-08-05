<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Reviews extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name',
        'rating',
        'date',
        'text',
    ];

    protected $translatable = ['name', 'text'];
}
