<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Models\Event;
use App\Settings\ButtonsSettings;
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
        $buttons = app(ButtonsSettings::class);
        $events = Event::query()->take(3)->get();

        $replace = ['[' => '<span>', ']' => '</span>'];
        $banners = [];
        foreach ($settings->banner as $banner) {
            $url = Arr::get($banner, 'banner', '');
            $banners[] = [
                'url' => $url !== '' ? asset("storage/$url") : '',
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
            ? array_map(static fn($img) => asset('storage/' . $img), $settings->imagess)
            : [];
        $cooperationImages = is_array($settings->images ?? null)
            ? array_map(static fn($img) => asset('storage/' . $img), $settings->images)
            : [];

        $data = ['banners' => $banners];

        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['info']['title'][$lang] = $settings->{'title2_' . $lang} ?? '';
            $data['info']['subtitle']['ru'] = 'AIS TECHNO GROUP';
            $data['info']['subtitle']['uz'] = 'AIS TECHNO GROUP';
            $data['info']['subtitle']['en'] = 'AIS TECHNO GROUP';
            $data['info']['text_top'][$lang] = $settings->{'subtitle2_' . $lang} ?? '';

            foreach (range(1, 3) as $i) {
                $data['info']['info_text'][$i][$lang] = $settings->{'text1_' . $lang} ?? '';
                $data['info']['info_text'][$i][$lang] = $settings->{'text2_' . $lang} ?? '';
                $data['info']['info_text'][$i][$lang] = $settings->{'text3_' . $lang} ?? '';
            }

            $data['info']['button']['text'][$lang] = $buttons->{'about_link_text_' . $lang} ?? '';
        }
        $data['info']['button']['link'] = $buttons->about_link_link ?? '';

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
            $data['advantages']['title'][$lang] = strtr($settings->{'titlee_' . $lang} ?? '', $replace);
            $data['advantages']['subtitle']['ru'] = 'Почему именно мы?';
            $data['advantages']['subtitle']['uz'] = 'Nima uchun biz?';
            $data['advantages']['subtitle']['en'] = 'Why us?';
            foreach ($settings->{'itemss_' . $lang} as $i => $item) {
                $data['advantages']['items'][$i]['title'][$lang] = $item['title'] ?? '';
                $data['advantages']['items'][$i]['text'][$lang] = $item['text'] ?? '';
                $data['advantages']['items'][$i]['icon'] = asset("img/advantages$i.svg");
            }
            $data['advantages']['buttons']['left']['text'][$lang] = $buttons->{'info_link_text_' . $lang} ?? '';
            $data['advantages']['buttons']['right']['text'][$lang] = $buttons->{'info_contact_text_' . $lang} ?? '';


            $data['company']['title'][$lang] = strtr($settings->{'title3_' . $lang} ?? '', $replace);
            $data['company']['subtitle']['ru'] = 'Нам доверяют';
            $data['company']['subtitle']['uz'] = 'Bizga ishonishadi';
            $data['company']['subtitle']['en'] = 'They trust us';
            $data['company']['company_content'][0]['name'][$lang] = $settings->{'name1' . "_$lang"} ?? '';
            $data['company']['company_content'][0]['text'][$lang] = $settings->{'text5' . "_$lang"} ?? '';
            $data['company']['company_content'][1]['name'][$lang] = $settings->{'name2' . "_$lang"} ?? '';
            $data['company']['company_content'][1]['text'][$lang] = $settings->{'text6' . "_$lang"} ?? '';

            $data['company']['images'] = $companyImages;
            $data['company']['buttons']['left']['text'][$lang] = $buttons->{'company_link_text_' . $lang} ?? '';
            $data['company']['buttons']['right']['text'][$lang] = $buttons->{'catalog_link_text_' . $lang} ?? '';

            $data['cooperation']['title'][$lang] = strtr($settings->{'cooperation_title_' . $lang} ?? '', $replace);
            $data['cooperation']['subtitle']['ru'] = 'Официальные партнеры';
            $data['cooperation']['subtitle']['uz'] = 'Rasmiy hamkorlar';
            $data['cooperation']['subtitle']['en'] = 'Official partners';
            $cooperation = [];
            foreach ($settings->cooperation ?? [] as $i => $item) {
                $cooperation[$i]['logo'] = !empty($item['logo']) ? asset('storage/' . $item['logo']) : '';
                $cooperation[$i]['img'] = !empty($item['img_document']) ? asset('storage/' . $item['img_document']) : '';
                foreach (['ru', 'uz', 'en'] as $lang) {
                    $cooperation[$i]['subtitle'][$lang] = $item["cooperation_subtitle_$lang"];
                    $cooperation[$i]['text'][$lang] = $item["cooperation_text_$lang"];
                }
            }
            $data['cooperation']['items'] = $cooperation;
            $data['event']['title'][$lang] = $settings->{'event_title_' . $lang} ?? '';
            $data['event']['subtitle']['ru'] = 'Новости';
            $data['event']['subtitle']['uz'] = 'Yangiliklar';
            $data['event']['subtitle']['en'] = 'News';
        }
        $data['advantages']['buttons']['left']['link'] = $buttons->info_link_link ?? '';
        $data['advantages']['buttons']['right']['link'] = $buttons->info_contact_link ?? '';
        $data['company']['buttons']['left']['link'] = $buttons->company_link_link ?? '';
        $data['company']['buttons']['right']['link'] = $buttons->catalog_link_link ?? '';

        $data['event']['items'] = EventCollection::make($events);
        $categories = Category::query()
            ->where('home_visibility', true)
            ->with(['translations', 'children'])
            ->orderBy('order')
            ->get();
        $data['categories']['title'] = [
            'ru' => 'Широкий ассортимент промышленного оборудования',
            'uz' => 'Sanoat uskunalarining keng assortimenti',
            'en' => 'Wide range of industrial equipment',
        ];
        $data['categories']['subtitle'] = [
            'ru' => 'Каталог продукции',
            'uz' => 'Mahsulotlar katalogi',
            'en' => 'Product catalog',
        ];
        $data['categories']['items'] = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->name];
                }),
                'slug' => $category->slug,
                'img' => $category->getFirstMediaUrl('category_img'),
            ];
        });

        $data['categories']['full_catalog'] = [
            'title' => [
                'ru' => 'Перейти к полному списку категорий',
                'uz' => 'To\'liq kategoriyalar ro\'yxatiga o\'tish',
                'en' => 'Go to the full list of categories',
            ],
            'subtitle' => [
                'ru' => 'Вся продукция',
                'uz' => 'Barcha mahsulotlar',
                'en' => 'All products',
            ],
            'text' => [
                'ru' => 'Ознакомьтесь с полным перечнем продукции',
                'uz' => 'To\'liq mahsulotlar ro\'yxati bilan tanishing',
                'en' => 'Familiarize yourself with the full list of products',
            ],
        ];

        return $data;
    }
}

