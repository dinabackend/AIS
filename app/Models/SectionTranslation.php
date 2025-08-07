<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionTranslation extends Model
{
    protected $table = 'section_translations';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'seo_title',
        'seo_description'
    ];

}
