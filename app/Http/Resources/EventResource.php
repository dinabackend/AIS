<?php

namespace App\Http\Resources;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Event */
class EventResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->title];
            }),
            'date' => $this->time,
            'banner' => $this->getFirstMEdiaUrl('events_image'),
            'infoText' => $this->translations->mapWithKeys(function ($item) {
                return [$item->locale => $item->description];
            }),
            'category' => $this->category,
            'category_title' => [
                'en' => __("categories.$this->category", locale: 'en'),
                'ru' => __("categories.$this->category", locale: 'ru'),
                'uz' => __("categories.$this->category", locale: 'uz'),
            ]
        ];
    }
}
