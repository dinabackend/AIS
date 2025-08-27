<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Category */
class CategoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->translations->mapWithKeys(function ($item, $key) {
                return [$item->locale => $item->name];
            }),
            'slug' => $this->slug,
            'parent_id' => $this->parent_id,
            'depth' => $this->depth,
            'image' => $this->getFirstMediaUrl('category_img'),
            /*'images' => $this->getMedia('category_img')->map(function ($media) {
                return $media->getUrl();
            }),*/
            'parent' => $this->when($this->parent, function() {
                return [
                    'id' =>   $this->parent->id,
                    'name' => $this->parent->translations->mapWithKeys(function ($item, $key) {
                        return [$item->locale => $item->name];
                    }),
                    'slug' => $this->parent->slug,
                ];
            }),
            'children' => CategoryResource::collection($this->whenLoaded('children')),
            'products_count' => $this->when($this->relationLoaded('products'), function() {
                return $this->products->count();
            }, function() {
                return Product::whereHas('categories', function ($query) {
                    $query->where('category_id', $this->id);
                })->count();
            }),
            'has_children' => $this->children()->count() > 0,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
