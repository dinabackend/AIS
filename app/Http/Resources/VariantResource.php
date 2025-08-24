<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'description' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->description];
            }),
            'advantages' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->advantages];
            }),
            'img' => $this->getFirstMediaUrl('product_img'),
            'images' => $this->getMedia('product_image')->pluck('original_url'),
            'video' => $this->getFirstMediaUrl('product_video'),
            'slug' => $this->slug,
            'home_visibility' => $this->home_visibility,
            'characteristics' => CharacteristicResource::collection($this->characteristics),
            'seo_title' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->seo_title];
            }),
            'seo_description' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->seo_description];
            }),
        ];
    }
}
