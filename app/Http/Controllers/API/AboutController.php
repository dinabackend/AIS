<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AboutResource;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $abouts = About::all();

        return response()->json(['data' => AboutResource::collection($abouts)]);
    }
}
