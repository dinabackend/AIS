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

        $data = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['main_title'][$lang] = $about->{'main_title_' . $lang} ?? '';
            $data['about'][$lang] = $about->{'about_' . $lang} ?? '';
            $data['text'][$lang] = $about->{'text_' . $lang} ?? '';
            $data['image'] = $about->banner ?? '';
            $data['question'][$lang] = $about->{'question_' . $lang} ?? '';
            $data['dalgakiran_title'][$lang] = $about->{'dalgakiran_' . $lang} ?? '';
            $data['Our_goal'][$lang] = $about->{'Our_goal_' . $lang} ?? '';
            $data['text1'][$lang] = $about->{'text1_' . $lang} ?? '';
            $data['We_offer'][$lang] = $about->{'We_offer_' . $lang} ?? '';
            $data['text2'][$lang] = $about->{'text2_' . $lang} ?? '';
            $data['img'] = $about->img ?? '';
            $data['ourPartners'][$lang] = $about->{'ourPartners_' . $lang} ?? '';
            $data['text3'][$lang] = $about->{'text3_' . $lang} ?? '';
        }

        return response()->json([
            'data' => $data
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
