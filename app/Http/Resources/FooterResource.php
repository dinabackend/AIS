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
            'whatsapp' => $settings->whatsapp,
            'mail' => $settings->mail,
            'phone_top_1' => $settings->phone_top_1,
            'phone_top_2' => $settings->phone_top_2,
            'phone_footer' => $settings->phone_footer,
        ];
    }
}
