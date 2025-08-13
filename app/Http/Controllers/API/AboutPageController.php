<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Settings\AboutSettings;
use Illuminate\Http\Request;

class AboutPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $about = app(AboutSettings::class);

        $aboutUs = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $aboutUs['main_title'][$lang] = $about->{'main_title_' . $lang} ?? '';
            $aboutUs['title0'][$lang] = $about->{'title0_' . $lang} ?? '';
            $aboutUs['text0'][$lang] = $about->{'text0_' . $lang} ?? '';
            $aboutUs['banner'] = $about->banner ?? '';
            $aboutUs['question0'][$lang] = $about->{'question0_' . $lang} ?? '';
            $aboutUs['title2'][$lang] = $about->{'title2_' . $lang} ?? '';
            $aboutUs['name1'][$lang] = $about->{'name1_' . $lang} ?? '';
            $aboutUs['text1'][$lang] = $about->{'text1_' . $lang} ?? '';
            $aboutUs['name2'][$lang] = $about->{'name2_' . $lang} ?? '';
            $aboutUs['text2'][$lang] = $about->{'text2_' . $lang} ?? '';
            $aboutUs['img'] = $about->img ?? '';
            $aboutUs['title3'][$lang] = $about->{'title3_' . $lang} ?? '';
            $aboutUs['text3'][$lang] = $about->{'text3_' . $lang} ?? '';
        }

        return response()->json([
            'aboutUs' => $aboutUs
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
