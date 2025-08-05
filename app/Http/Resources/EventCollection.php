<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EventCollection extends ResourceCollection
{
    public function toArray(Request $request)
    {
        return $this->collection->transform(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->title];
                }),
                'category' => $event->category,
                'category_title' => [
                    'en' => __("categories.$event->category", locale: 'en'),
                    'ru' => __("categories.$event->category", locale: 'ru'),
                    'uz' => __("categories.$event->category", locale: 'uz'),
                ],
                'image' => $event->getFirstMediaUrl('events_img'),
                'time' => $event->time
            ];
        });
    }
}
