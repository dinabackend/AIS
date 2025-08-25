<?php

namespace App\Http\Resources;

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
            'footer_title' => [
                'uz' => $settings->footer_title_uz,
                'ru' => $settings->footer_title_ru,
                'en' => $settings->footer_title_en,
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
            'contact_page' => [
                'main_title' => [
                    'uz' => $settings->contact_main_title_uz,
                    'ru' => $settings->contact_main_title_ru,
                    'en' => $settings->contact_main_title_en,
                ],
                'title' => [
                    'uz' => $settings->contact_title_uz,
                    'ru' => $settings->contact_title_ru,
                    'en' => $settings->contact_title_en,
                ],
                'subtitle' => [
                    'uz' => $settings->contact_subtitle_uz,
                    'ru' => $settings->contact_subtitle_ru,
                    'en' => $settings->contact_subtitle_en,
                ],
                'text1' => [
                    'uz' => $settings->contact_text1_uz,
                    'ru' => $settings->contact_text1_ru,
                    'en' => $settings->contact_text1_en,
                ],
                'text2' => [
                    'uz' => $settings->contact_text2_uz,
                    'ru' => $settings->contact_text2_ru,
                    'en' => $settings->contact_text2_en,
                ],
                'text3' => [
                    'uz' => $settings->contact_text3_uz,
                    'ru' => $settings->contact_text3_ru,
                    'en' => $settings->contact_text3_en,
                ],
            ],
        ];
    }
}
