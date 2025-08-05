<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CharacteristicTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'key',
        'value'
    ];
}
