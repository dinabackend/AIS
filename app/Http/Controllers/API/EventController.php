<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventCollection;
use App\Http\Resources\EventResource;
use App\Models\Event;
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

        return [
            'pages_count' => ceil($events->total() / $events->perPage()),
            'count' => $events->total(),
            'next' => $events->nextPageUrl(),
            'prev' => $events->previousPageUrl(),
            'from' => $events->firstItem(),
            'to' => $events->lastItem(),
            'page' => $request->has('page') ? $request->get('page') : 1,
            'data' => new EventCollection($events)
        ];
    }

    public function show($id) {

        $event = Event::query()->findOrFail($id);
        $read_also = Event::query()->where('id', '!=', $id)->where('status', true)
            ->take(4)->get();

        return [
            'data' => new EventResource($event),
            'read_also' => new EventCollection($read_also)
        ];
    }
}
