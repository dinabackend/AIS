<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method withFilters($categories, $filters, $search)
 * @method static count()
 * @property $name
 * @property $id
 */
class Product extends TranslatableModel implements HasMedia, Sortable
{
    use Translatable, InteractsWithMedia, SortableTrait;

    protected $fillable = [
        'name',
        'ingredients',
        'description',
        'price',
        'category_id',
        'image',
        'img',
        'article',
        'status',
        'min_days',
        'max_days',
        'amount',
        'type',
        'home_visibility',
        'collection_visibility',
        'time',
        'seo_title',
        'seo_description'
    ];

    /** @noinspection PhpUnused */
    public array $translatedAttributes = ['name', 'ingredients', 'description', 'history', 'seo_title', 'seo_description'];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'categories_products'); //
    }

    public function characteristics(): HasMany
    {
        return $this->hasMany(Characteristic::class, 'product_id'); //
    }

    public function types(): BelongsToMany
    {
        return $this->belongsToMany(Type::class, 'types_products');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'group_products');
    }

    /** @noinspection PhpUnused */
    public function scopeWithFilters($query, $categories = [], $types = [], $search = false)
    {
        return $query
            ->when($categories, fn($q) => $q->wherehas('categories', function ($q) use ($categories) {
                return $q->whereIn('id', $categories)->orWhereIn('parent_id', $categories);
            }))
            ->when($types, fn($q) => $q->wherehas('types', function ($q) use ($types) {
                return $q->whereIn('type_id', $types);
            }))
            ->when($search, fn($q) => $q->whereHas('translations', function ($q) use ($search) {
                return $q->where('name', 'ILIKE', "%{$search}%")
                    ->orWhere('description', 'ILIKE', "%{$search}%");
            })
            );
    }

    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($product) {
            $product->sku = 'PRD-' . strtoupper(substr($product->name, 0, 3) . '-' . rand(1000, 9999));
            $product->slug = Str::slug($product->translate('uz')->name . '-' . Str::random(5));
        });
    }
}
