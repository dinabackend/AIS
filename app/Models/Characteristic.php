<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Characteristic extends TranslatableModel
{
    use Translatable;
    protected $fillable = [
        'product_id',
        'key',
        'value',
    ];

    public array $translatedAttributes = ['key', 'value'];

    public function translations(): HasMany
    {
        return $this->hasMany(CharacteristicTranslation::class);
    }

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function characteristic_key(): BelongsTo {
        return $this->belongsTo(CharacteristicKey::class);
    }
}
