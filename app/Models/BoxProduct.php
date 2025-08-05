<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BoxProduct extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'box_id',
        'product_id',
        'images',
        'price'
    ];

    protected $table = 'boxes_products';

    public function box(): BelongsTo
    {
        return $this->belongsTo(Box::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
