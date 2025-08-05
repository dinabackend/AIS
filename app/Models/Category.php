<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

/**
 * @method CategoryTranslation getTranslation(string $locale)
 * @method static count()
 */
class Category extends TranslatableModel implements Sortable
{
    use SortableTrait;

    protected $fillable = [
        'name',
        'parent_id',
    ];

    public array $translatedAttributes = ['name'];

    public function translations(): HasMany
    {
        return $this->hasMany(CategoryTranslation::class);
    }

    public function translation(): HasOne {
        return $this->hasOne(CategoryTranslation::class, 'category_id', 'id')
            ->where('locale', app()->getLocale());
    }

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class, 'categories_products');
    }

    public function productsCount(): int {
        return $this->belongsToMany(Product::class, 'categories_products')->count();
    }

    public function children() {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
