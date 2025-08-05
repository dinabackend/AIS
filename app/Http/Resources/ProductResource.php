<?php

namespace App\Http\Resources;

use App\Models\BoxProduct;
use App\Models\Product;
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
        $boxes = BoxProduct::query()->where('product_id', $this->id)->get();

        $recommendations = Product::query()->select('id')->with(['categories' => function ($query) {
            $query->whereIn('id', $this->categories->pluck('id'));
        }])->take(8)->get();
        if ($recommendations->count() < 8) {
            $recommendations->merge(
                Product::query()->inRandomOrder()->select(['id'])->with('categories')->take(8 - $recommendations->count())
            );
        }
        $recProducts = Product::query()->with('categories')->whereIn('id', $recommendations->pluck('id'))->get();

        return [
            'id' => $this->id,
            'title' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->name];
            }),
            'ingredients' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->ingredients];
            }),
            'description' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->description];
            }),
            'categories' => $this->categories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->translations->mapWithKeys(function ($item) {
                        return [$item->locale => $item->name];
                    })
                ];
            }),
            'img' => $this->getFirstMediaUrl('product_img'),
            'images' => $this->getMedia('product_image')->pluck('original_url'),
            'wrapper' => $this->getFirstMediaUrl('wrapper'),
            'history_images' => $this->getMedia('history_images')->pluck('original_url'),
            'price' => $this->price,
            'amount' => $this->amount,
            'term' => [
                'uz' => "$this->min_days dan $this->max_days kungacha",
                'en' => "from $this->min_days to $this->max_days days",
                'ru' => "от $this->min_days до $this->max_days дней",
            ],
            'term_show' => $this->min_days&&$this->min_days ? $this->getPreorder() : false,
            'sku' => $this->sku,
            'slug' => $this->slug,
            'candyBoxes' => BoxResource::collection($boxes),
            'characteristics' => CharacteristicResource::collection($this->characteristics),
            'history' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->history];
            }),
            'order' => $this->order,
            'recommendations' => new ProductCollection($recProducts),
            'seo_title' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->seo_title];
            }),
            'seo_description' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->seo_description];
            }),
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
