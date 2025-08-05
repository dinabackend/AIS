<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed $title
 * @property mixed $count
 * @property mixed $box
 * @property mixed $product
 * @method getMedia(string $string)
 */
class BoxResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $images = $this->getMedia('box_images')->map(function ($image) {
            return $image->getUrl();
        })->all();


        $images = array_merge($images, $this->product->getMedia('product_image')->map(function ($image) {
            return $image->getUrl();
        })->all());

        return [
            'title' => $this->box->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'images'=> $images,
            'price' => $this->price ?? $this->box->count * $this->product->price
        ];
    }
}
