<?php

namespace App\Http\Controllers\API;

use App\Filament\Pages\Policy;
use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Settings\PolicySettings;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(['data' => new HomeResource([])]);
    }

    public function policy()
    {
        $policy = app(PolicySettings::class);

        return response()->json($policy->toArray());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
