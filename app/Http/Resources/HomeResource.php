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

        $replace = ['[' => '<span>', ']' => '</span>'];
        $banners = [];
        foreach ($settings->banner as $banner) {
            $url = Arr::get($banner, 'banner', '');
            $banners[] = [
                'url' => $url != '' ? asset("storage/$url") : '',
                'type' => preg_match('/(.jpg|.png|.webp)/', $url) ? 'image' : 'video',
                'title' => [
                    'en' => strtr(Arr::get($banner, 'title_en', ""), $replace),
                    'uz' => strtr(Arr::get($banner, 'title_uz', ""), $replace),
                    'ru' => strtr(Arr::get($banner, 'title_ru', ""), $replace),
                ],
                'subtitle' => [
                    'en' => Arr::get($banner, 'subtitle_en'),
                    'uz' => Arr::get($banner, 'subtitle_uz'),
                    'ru' => Arr::get($banner, 'subtitle_ru'),
                ],
                'info' => [
                    'en' => Arr::get($banner, 'info_en'),
                    'uz' => Arr::get($banner, 'info_uz'),
                    'ru' => Arr::get($banner, 'info_ru'),
                ],
            ];
        }

        return [
            'banners' => $banners,
        ];
    }
}
