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
                'infoText' => $event->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->description];
                }),
                'image' => $event->getFirstMediaUrl('events_img'),
                'time' => $event->time
            ];
        });
    }
}
