<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReviewTranslation extends Model
{
    protected $table = 'product_translations';

    protected $fillable = [
        'name',
        'text',
        'locale',
    ];
}
