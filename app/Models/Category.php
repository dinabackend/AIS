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

    // Rekursiv tarzda barcha child kategoriyalarni olish
    public function getAllChildren()
    {
        $children = collect();

        foreach ($this->children as $child) {
            $children->push($child);
            $children = $children->merge($child->getAllChildren());
        }

        return $children;
    }

    // Kategoriya darajasini aniqlash
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
        static::saving(function ($category) {
            if (empty($category->slug)) {
                // Slug ni translation dan olish
                $translation = $category->translations()
                    ->where('locale', 'uz')
                    ->first();
                if ($translation && $translation->name) {
                    $category->slug = Str::slug($translation->name);
                }
            }
        });
    }
}
