<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin  Category */
class CategoryResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'count' => Product::whereHas('categories', function ($q) {
                return $q->where('id', $this->id)->orWhere('parent_id', $this->id);
            })->where('collection_visibility', '!=', 1)
                ->orWhere('collection_visibility', null)
                ->count(),
            'order' => $this->order,
            'childrens' => CategoryResource::collection($this->children),
        ];
    }
}
