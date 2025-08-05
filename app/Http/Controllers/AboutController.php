<?php

namespace App\Http\Controllers;

use App\Http\Resources\AboutResource;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
        return AboutResource::collection(About::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([

        ]);

        return new AboutResource(About::create($data));
    }

    public function show(About $about)
    {
        return new AboutResource($about);
    }

    public function update(Request $request, About $about)
    {
        $data = $request->validate([

        ]);

        $about->update($data);

        return new AboutResource($about);
    }

    public function destroy(About $about)
    {
        $about->delete();

        return response()->json();
    }
}
