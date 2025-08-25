<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return $this->collection->transform(function (ProductResource $product) {

            return [
                'id' => $product->id,
                'img' => $product->getFirstMediaUrl('product_image'),
                'title' => $product->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->name];
                }),
                'categories' => $product->categories->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'slug' => $category->slug,
                        'name' => $category->translations->mapWithKeys(function ($item) {
                            return [$item->locale => $item->name];
                        })
                    ];
                }),
                'type' => $product->type,
                'slug' => $product->slug,
                'order' => $product->order,
            ];
        });
    }
}
