<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Box extends TranslatableModel
{
    use Translatable;

    protected $fillable = [
        'name',
        'products',
        'count',
        'images'
    ];

    public array $translatedAttributes = ['name'];

    public function products()
    {
        return $this->belongsToMany(BoxProduct::class, 'boxes_products', 'box_id', 'product_id')
            ->using(BoxProduct::class);
    }
}
