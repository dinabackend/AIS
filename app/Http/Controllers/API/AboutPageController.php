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
            $aboutUs['about'][$lang] = $about->{'about_' . $lang} ?? '';
            $aboutUs['text'][$lang] = $about->{'text_' . $lang} ?? '';
            $aboutUs['banner'] = $about->banner ?? '';
            $aboutUs['question'][$lang] = $about->{'question_' . $lang} ?? '';
            $aboutUs['dalgakiran'][$lang] = $about->{'dalgakiran_' . $lang} ?? '';
            $aboutUs['Our_goal'][$lang] = $about->{'Our_goal_' . $lang} ?? '';
            $aboutUs['text1'][$lang] = $about->{'text1_' . $lang} ?? '';
            $aboutUs['We_offer'][$lang] = $about->{'We_offer_' . $lang} ?? '';
            $aboutUs['text2'][$lang] = $about->{'text2_' . $lang} ?? '';
            $aboutUs['img'] = $about->img ?? '';
            $aboutUs['ourPartners'][$lang] = $about->{'ourPartners_' . $lang} ?? '';
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
