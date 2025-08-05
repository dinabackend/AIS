<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Type extends TranslatableModel
{
    protected $fillable = ['name'];

    public array $translatedAttributes = ['name'];

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'types_products');
    }
}
