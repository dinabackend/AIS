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
        $informations = [];
        foreach ($about->information ?? [] as $information) {
            $item = [
                'ru' => [
                    'title' => $information['title_ru'] ?? '',
                    'text' => $information['text_ru'] ?? '',
                ],
                'uz' => [
                    'title' => $information['title_uz'] ?? '',
                    'text' => $information['text_uz'] ?? '',
                ],
                'en' => [
                    'title' => $information['title_en'] ?? '',
                    'text' => $information['text_en'] ?? '',
                ],
                'image' => !empty($information['img']) ? asset('storage/' . $information['img']) : '',
            ];
            $informations[] = $item;
        }

        $data = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['main_title'][$lang] = $about->{'main_title_' . $lang} ?? '';
            $data['about']['title'][$lang] = $about->{'about_' . $lang} ?? '';
            $data['about']['text'][$lang] = $about->{'text_' . $lang} ?? '';
            $data['about']['image'][$lang] = $about->banner ? asset('storage/' . $about->banner) : '';
            $data['information']['question'][$lang] = $about->{'question_' . $lang} ?? '';
        }
        $data['information']['items'] = $informations;
        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['certificate']['title'][$lang] = $about->{'dalgakiran_' . $lang} ?? '';
            $data['certificate']['name1'][$lang] = $about->{'Our_goal_' . $lang} ?? '';
            $data['certificate']['text1'][$lang] = $about->{'text1_' . $lang} ?? '';
            $data['certificate']['name2'][$lang] = $about->{'We_offer_' . $lang} ?? '';
            $data['certificate']['text2'][$lang] = $about->{'text2_' . $lang} ?? '';
        }
        $data['certificate']['img'] = $about->img ? asset('storage/' . $about->img) : '';
        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['our_partners']['title'][$lang] = $about->{'ourPartners_' . $lang} ?? '';
            $data['our_partners']['text'][$lang] = $about->{'text3_' . $lang} ?? '';
        }
        $data['our_partners']['images'] = [];
        if (is_array($about->images)) {
            foreach ($about->images as $img) {
                $data['our_partners']['images'][] = asset('storage/' . $img);
            }
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
