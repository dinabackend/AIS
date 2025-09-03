<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Models\Event;
use App\Settings\HomePageSettings;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $per_page = $request->get('per_page', 500);

        $events = Event::query()
            ->where('status', true)
            ->with('translation')
            ->paginate($per_page)
            ->withQueryString();

        $response = [];
        foreach ($events->where('top' , true) as $event) {
            $response[] = [
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
        }

        $top = [];
        foreach ($events->where('top' , false) as $event) {
            $top[] = [
                'id' => $event->id,
                'title' => $event->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->title];

                }),
                'description' => $event->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->description];
                }),
                'image' => $event->getFirstMediaUrl('events_img'),
                'time' => $event->time
            ];
        }

        return [
            'pages_count' => ceil($events->total() / $events->perPage()),
            'count' => $events->total(),
            'next' => $events->nextPageUrl(),
            'prev' => $events->previousPageUrl(),
            'from' => $events->firstItem(),
            'to' => $events->lastItem(),
            'page' => $request->has('page') ? $request->get('page') : 1,
            'data' => $response,
            'top' => $top,
        ];
    }

    public function show($id) {
        $settings = app(HomePageSettings::class);

        $event = Event::query()->findOrFail($id);
        $read_also = Event::query()->where('id', '!=', $id)->where('status', true)
            ->take(3)->get();

        return [
            'data' => new EventResource($event),
            'event' => [
                'title' => [
                    'ru' => $settings->{'event_title_ru'} ?? '',
                    'uz' => $settings->{'event_title_uz'} ?? '',
                    'en' => $settings->{'event_title_en'} ?? '',
                ],
                'subtitle' => [
                    'ru' => 'Новости',
                    'uz' => 'Yangiliklar',
                    'en' => 'News',
                ],
            ],
            'read_also' => new EventCollection($read_also),
        ];
    }
}
