<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BACTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'b_a_c_id',
        'locale',
        'title',
        'description',
        'image',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function bAC()
    {
        return $this->belongsTo(BAC::class, 'b_a_c_id');
    }
}
