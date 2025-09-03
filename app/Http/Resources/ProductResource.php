<?php

namespace App\Http\Resources;

use App\Settings\HomePageSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'title' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'subtitle' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->subtitle];
            }),
            'description' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->description];
            }),
            'advantages' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->advantages];
            }),
            'categories' => $this->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->translations->mapWithKeys(function ($item) {
                        return [$item->locale => $item->name];
                    })
                ];
            }),
            'img' => $this->getFirstMediaUrl('product_image'),
            'images' => $this->getMedia('product_image')->pluck('original_url'),
            'video' => $this->getFirstMediaUrl('product_video'),
            'amount' => $this->amount,
            'slug' => $this->slug,
            'characteristics' => CharacteristicResource::collection($this->characteristics),
            'variants' => VariantResource::collection($this->variants),
            'has_variant' => $this->variants->count() > 0,
            'order' => $this->order,
            'seo_title' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->seo_title];
            }),
            'seo_description' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->seo_description];
            }),
            'blocks' => BlockResource::collection($this->blocks),
        ];
    }

    public function getPreorder(): array
    {
        $settings = app(HomePageSettings::class);
        return [
            'uz' => $settings->preorder_uz,
            'ru' => $settings->preorder_ru,
            'en' => $settings->preorder_en,
        ];
    }
}
