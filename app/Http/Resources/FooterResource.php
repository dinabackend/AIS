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
        ];
    }
}
