<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ProductCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return $this->collection->transform(function (ProductResource $product) {

            return [
                'id' => $product->id,
                'img' => $product->getFirstMediaUrl('product_img'),
                'title' => $product->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->name];
                }),
                'categories' => $product->categories->map(function ($category) {
                    return [
                        'id' => $category->id,
                        'name' => $category->translations->mapWithKeys(function ($item) {
                            return [$item->locale => $item->name];
                        })
                    ];
                }),
                'types' => $product->types->map(function ($type) {
                    return [
                        'id' => $type->id,
                        'name' => $type->translations->mapWithKeys(function ($item) {
                            return [$item->locale => $item->name];
                        })
                    ];
                }) ,
                'slug' => $product->slug,
                'price' => $product->price,
                'order' => $product->order,
            ];
        });
    }
}
