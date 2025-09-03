<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Block extends TranslatableModel implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = ['name', 'options'];

    public $translatedAttributes = ['name', 'options'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
