<?php

namespace App\Http\Resources;

use App\Models\Event;
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
        $events = Event::query()->take(3)->get();

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
                    'en' => Arr::get($banner, 'subtitle_en', ""),
                    'uz' => Arr::get($banner, 'subtitle_uz', ""),
                    'ru' => Arr::get($banner, 'subtitle_ru', ""),
                ],
                'info' => [
                    'en' => Arr::get($banner, 'info_en'),
                    'uz' => Arr::get($banner, 'info_uz'),
                    'ru' => Arr::get($banner, 'info_ru'),
                ],
            ];
        }

        $companyImages = is_array($settings->imagess ?? null)
            ? array_map(fn($img) => asset('storage/' . $img), $settings->imagess)
            : [];
        $cooperationImages = is_array($settings->images ?? null)
            ? array_map(fn($img) => asset('storage/' . $img), $settings->images)
            : [];

        $data = [
            'banners' => $banners,
        ];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['info']['title'][$lang] = $settings->{'title2_' . $lang} ?? '';
            $data['info']['subtitle'][$lang] = $settings->{'subtitle2_' . $lang} ?? '';
            $data['info']['text1'][$lang] = $settings->{'text1_' . $lang} ?? '';
            $data['info']['text2'][$lang] = $settings->{'text2_' . $lang} ?? '';
            $data['info']['text3'][$lang] = $settings->{'text3_' . $lang} ?? '';
        }
        $data['info']['left_img'] = $settings->img ? asset('storage/' . $settings->img) : '';
        $data['info']['right_img'] = $settings->img2 ? asset('storage/' . $settings->img2) : '';
        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['info']['info'][$lang] = collect($settings->{'info2_' . $lang} ?? [])
                ->map(function ($item) {
                    return [
                        'number' => $item['number'] ?? '',
                        'text' => $item['text'] ?? '',
                    ];
                })->toArray();
            $data['company']['title'][$lang] = $settings->{'title3_' . $lang} ?? '';
            $data['company']['name1'][$lang] = $settings->{'name1_' . $lang} ?? '';
            $data['company']['text1'][$lang] = $settings->{'text5_' . $lang} ?? '';
            $data['company']['name2'][$lang] = $settings->{'name2_' . $lang} ?? '';
            $data['company']['text2'][$lang] = $settings->{'text6_' . $lang} ?? '';
            $data['company']['images'] = $companyImages;
            $data['cooperation']['title'][$lang] = $settings->{'titleb_' . $lang} ?? '';
            $data['cooperation']['images'] = $cooperationImages;
            $data['event']['title'][$lang] = $settings->{'event_title_' . $lang} ?? '';
        }
        $data['event']['items'] = EventCollection::make($events);

        return $data;
    }
}

