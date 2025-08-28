<?php

namespace App\Http\Resources;

use App\Models\Category;
use App\Settings\FooterSettings;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FooterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $settings = app(FooterSettings::class);

        $address = urlencode($settings->address_ru ?: $settings->address_uz);

        $yandexUrl = "https://yandex.uz/maps/?text=$address";

        $categories = Category::take(5)->get();

        return [
            'telegram' => $settings->telegram,
            'instagram' => $settings->instagram,
            'linkedin' => $settings->linkedin,
            'facebook' => $settings->facebook,
            'mail1' => $settings->mail1,
            'mail2' => $settings->mail2,
            'phone' => $settings->phone,
            'address' => [
                'uz' => $settings->address_uz,
                'ru' => $settings->address_ru,
                'en' => $settings->address_en,
            ],
            'address_url' => $yandexUrl,
            'left_text' => [
                'uz' => $settings->left_text_uz,
                'ru' => $settings->left_text_ru,
                'en' => $settings->left_text_en,
            ],
            'right_text' => [
                'uz' => $settings->right_text_uz,
                'ru' => $settings->right_text_ru,
                'en' => $settings->right_text_en,
            ],
            'title' => [
                'uz' => $settings->title_uz,
                'ru' => $settings->title_ru,
                'en' => $settings->title_en,
            ],
            'text' => [
                'uz' => $settings->text_uz,
                'ru' => $settings->text_ru,
                'en' => $settings->text_en,
            ],
            'img' => $settings->img ? asset('storage/' . $settings->img) : '',
            'navigation' => [
                [
                    'url' => '',
                    'title' => [
                        'ru' => 'Главная',
                        'uz' => 'Bosh sahifa',
                        'en' => 'Home',
                    ],
                ],
                [
                    'url' => '',
                    'title' => [
                        'ru' => 'Компания',
                        'uz' => 'Kompaniya',
                        'en' => 'Company',
                    ],
                ],
                [
                    'url' => '',
                    'title' => [
                        'ru' => 'Каталог',
                        'uz' => 'Katalog',
                        'en' => 'Catalog',
                    ],
                ],
                [
                    'url' => '',
                    'title' => [
                        'ru' => 'Запчасти',
                        'uz' => 'Ehtiyot qismlar',
                        'en' => 'Parts',
                    ],
                ],
                [
                    'url' => '',
                    'title' => [
                        'ru' => 'Инженеры и сервис',
                        'uz' => 'Muhandislar va servis',
                        'en' => 'Engineers & Service',
                    ],
                ],
                [
                    'url' => '',
                    'title' => [
                        'ru' => 'Блог',
                        'uz' => 'Blog',
                        'en' => 'Blog',
                    ],
                ],
                [
                    'url' => '',
                    'title' => [
                        'ru' => 'Контакты',
                        'uz' => 'Kontaktlar',
                        'en' => 'Contacts',
                    ],
                ],
            ],
            'categories' => CategoryResource::collection($categories),
        ];
    }
}
