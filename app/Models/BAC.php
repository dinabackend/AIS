<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class BAC extends TranslatableModel implements HasMedia, Sortable
{
    use Translatable, InteractsWithMedia, SortableTrait;

    protected $fillable = ['sort_order', 'type', 'image', 'images'];

    protected $translatedAttributes = ['title', 'description'];

    public array $sortable = [
        'order_column_name' => 'order_column',
        'sort_when_creating' => true,
    ];
}
