<?php

namespace App\Http\Resources;

use App\Models\Group;
use App\Models\Product;
use App\Settings\HomePageSettings;
use Arr;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $settings = app(HomePageSettings::class);

        $products = Product::query()->whereHomeVisibility(true)->get();

        $groups = [];
        foreach (Group::with('products')->orderBy('order')->where('visible', true)->get() as $group) {
            $grouped = $products->whereIn('id', $group->products->pluck('id'));

            $groups[] = [
                'name' => $group->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->name];
                }),
                'order' => (int)$group->order,
                'products' => $grouped->map(function ($product) {
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
                })->toArray(),
            ];
        }

        $banners = [];
        foreach ($settings->upcoming_banner as $banner) {
            $url = Arr::get($banner, 'banner', '');
            $banners[] = [
                'url' => strlen($url) ? asset("storage/$url") : '',
                'type' => preg_match('/(.jpg|.png|.webp)/', $url) ? 'image' : 'video',
                'title' => [
                    'en' => Arr::get($banner, 'title_en'),
                    'uz' => Arr::get($banner, 'title_uz'),
                    'ru' => Arr::get($banner, 'title_ru'),
                ],
            ];
        }

        return [
            'banners' => $banners,
            'products' => [
                'collection'    => Arr::get($groups, '0.products'),
                'bestsellers'   => Arr::get($groups, '1.products'),
                'new_collection'=> Arr::get($groups, '2.products'),
            ],
            'groups' => $groups,
        ];
    }
}
