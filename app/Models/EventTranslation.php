<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventTranslation extends Model
{
    protected $table = 'event_translations';

    public $timestamps = false;

    protected $fillable = [
        'title',
        'description',
        'locale',
        'status',
        'category'
    ];
}
