<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewTranslation extends Model
{
//8426464
    protected $table = 'review_translations';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'text',
        'locale',
    ];
}
