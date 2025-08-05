<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AboutTranslation extends Model
{
    protected $fillable = [
        'title',
        'subtitle',
        'description',
    ];

    public $timestamps = false;
}
