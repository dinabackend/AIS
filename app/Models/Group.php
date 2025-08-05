<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends TranslatableModel
{
    protected $fillable = ['visible', 'order'];

    public array $translatedAttributes = ['name'];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'group_products');
    }
}
