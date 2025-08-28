<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Str;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

/**
 * @method CategoryTranslation getTranslation(string $locale)
 * @method static count()
 */
class Category extends TranslatableModel implements HasMedia, Sortable
{
    use SortableTrait,InteractsWithMedia;

    protected $fillable = [
        'name',
        'parent_id',
        'slug',
        'home_visibility',
        'order',
        'description',
    ];

    public array $translatedAttributes = ['name', 'description'];

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

    public function children(): HasMany {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function parent(): BelongsTo {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function getTranslatedNameAttribute()
    {
        return $this->getTranslation('name', app()->getLocale());
    }

    // Daraxt shaklida kategoriyalarni olish uchun scope
    public function scopeTree($query)
    {
        return $query->with(['children' => function($q) {
            $q->with('translation');
        }])->whereNull('parent_id');
    }

    // Recursively get all child categories
    public function getAllChildren()
    {
        $children = collect();

        foreach ($this->children as $child) {
            $children->push($child);
            $children = $children->merge($child->getAllChildren());
        }

        return $children;
    }

    // Category level determination
    public function getDepthAttribute()
    {
        $depth = 0;
        $parent = $this->parent;

        while ($parent) {
            $depth++;
            $parent = $parent->parent;
        }

        return $depth;
    }

    protected static function boot()
    {
        parent::boot();

        // Generate slug when category is created or updated
        static::saved(function ($category) {
            // Check if we need to generate a slug
            if (empty($category->slug)) {
                // Try to get the name from the current translations
                $name = null;

                // First try to get from 'uz' locale
                if ($category->hasTranslation('uz')) {
                    $name = $category->translate('uz')->name;
                } else {
                    // If 'uz' is not available, try current locale
                    $currentLocale = app()->getLocale();
                    if ($category->hasTranslation($currentLocale)) {
                        $name = $category->translate($currentLocale)->name;
                    } else {
                        // Get any available translation
                        $translation = $category->translations->first();
                        if ($translation) {
                            $name = $translation->name;
                        }
                    }
                }

                // Generate slug if we found a name
                if ($name) {
                    $category->slug = Str::slug($name);
                    $category->saveQuietly(); // Save without triggering events again
                }
            }
        });
    }
}
