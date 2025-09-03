<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlockTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'options'];
    protected $casts = [
        'options' => 'array',
    ];
}
