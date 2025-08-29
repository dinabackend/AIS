<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeResource;
use App\Settings\FooterSettings;
use App\Settings\PolicySettings;
use Illuminate\Http\JsonResponse;

class HomePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(['data' => new HomeResource([])]);
    }

    public function policy(): JsonResponse
    {
        $policy = app(PolicySettings::class);

        return response()->json($policy->toArray());
    }

    public function contact(): JsonResponse
    {
        $settings = app(FooterSettings::class);

        $text = [];

        foreach (range(1, 3) as $i) {
            foreach (['uz', 'ru', 'en'] as $lang) {
                $text[$i - 1][$lang] = $settings->{"contact_text{$i}_$lang"};
            }
            $text[$i - 1]['icon'] = asset("img/contact$i.svg");
        }

        return response()->json(['data' => [
            'main_title' => [
                'uz' => $settings->contact_main_title_uz,
                'ru' => $settings->contact_main_title_ru,
                'en' => $settings->contact_main_title_en,
            ],
            'title' => [
                'uz' => $settings->contact_title_uz,
                'ru' => $settings->contact_title_ru,
                'en' => $settings->contact_title_en,
            ],
            'subtitle' => [
                'uz' => $settings->contact_subtitle_uz,
                'ru' => $settings->contact_subtitle_ru,
                'en' => $settings->contact_subtitle_en,
            ],
            'text' => $text,
        ]]);
    }
}
