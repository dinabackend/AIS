<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VariantTranslation extends Model
{
    protected $table = 'variant_translations';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'advantages',
        'seo_title',
        'seo_description'
    ];

}
