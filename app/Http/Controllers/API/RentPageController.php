<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Settings\RentPageSettings;
use Illuminate\Http\Request;

class RentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $rent = app(RentPageSettings::class);

        $rents = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $rents['main_title'][$lang] = $rent->{'main_title_' . $lang} ?? '';
            $rents['title'][$lang] = $rent->{'title_' . $lang} ?? '';
            $rents['text'][$lang] = $rent->{'text_' . $lang} ?? '';
            $rents['category_text'][$lang] = $rent->{'category_text_' . $lang} ?? '';
            $rents['image'] = $rent->img ?? '';
            $rents['reviews_title'][$lang] = $rent->{'reviews_title_' . $lang} ?? '';
        }

        return response()->json([
            'rents' => $rents
        ]);
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
