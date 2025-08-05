<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewTranslation extends Model
{

    protected $table = 'review_translations';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'text',
        'locale',
    ];
}
