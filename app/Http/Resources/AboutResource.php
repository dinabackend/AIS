<?php

namespace App\Http\Resources;

use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin About */
class AboutResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->title];
            }),
            'subtitle' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->subtitle];
            }),
            'description' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->description];
            }),
            'image' => $this->getFirstMediaUrl('about_image')
        ];
    }
}
