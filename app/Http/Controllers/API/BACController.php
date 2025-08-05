<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\BAC;
use App\Settings\B2BPageSettings;
use App\Settings\CreationsPageSettings;

class BACController extends Controller
{
    public function b2b()
    {
        $pageSettings = app(B2BPageSettings::class);
        $data = BAC::where('type', 'b2b')->orderBy('order_column')->get();

        $b2b= [];
        foreach ($data as $item) {
            $b2b[] = [
                'id' => $item->id,
                'title' => $item->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->title];
                }),
                'description' => $item->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->description];
                }),
                'image' => $item->getFirstMediaUrl('bac_img'),
                'images' => $item->getMedia('bac_image')->pluck('original_url'),
            ];
        }

        $images = [];
        foreach ($pageSettings->images as $item) {
            $images[] = asset('storage/'.$item);
        }

        return response()->json([
            'banner' => asset('storage/'.$pageSettings->banner),
            'title' => [
                'uz' => $pageSettings->title_uz,
                'ru' => $pageSettings->title_ru,
                'en' => $pageSettings->title_en,
            ],
            'subtitle' => [
                'uz' => $pageSettings->subtitle_uz,
                'ru' => $pageSettings->subtitle_ru,
                'en' => $pageSettings->subtitle_en,
            ],
            'text' => [
                'uz' => $pageSettings->text_uz,
                'ru' => $pageSettings->text_ru,
                'en' => $pageSettings->text_en,
            ],
            'collage' => $images,
            'our_title' => [
                'uz' => $pageSettings->our_title_uz,
                'ru' => $pageSettings->our_title_ru,
                'en' => $pageSettings->our_title_en,
            ],
            'our_text' => [
                'uz' => $pageSettings->our_text_uz,
                'ru' => $pageSettings->our_text_ru,
                'en' => $pageSettings->our_text_en,
            ],
            'b2b' => $b2b,
            'info_name' => [
                'uz' => $pageSettings->info_name_uz,
                'ru' => $pageSettings->info_name_ru,
                'en' => $pageSettings->info_name_en,
            ],
            'info_title' => [
                'uz' => $pageSettings->info_title_uz,
                'ru' => $pageSettings->info_title_ru,
                'en' => $pageSettings->info_title_en,
            ],
            'info_list' => [
                'uz' => $pageSettings->info_list_uz,
                'ru' => $pageSettings->info_list_ru,
                'en' => $pageSettings->info_list_en,
            ],
        ]);
    }

    public function creations()
    {

        $pageSettings = app(CreationsPageSettings::class);
        $data = BAC::where('type', 'creation')->orderBy('order_column')->get();

        $creations = [];
        foreach ($data as $item) {
            $creations[] = [
                'id' => $item->id,
                'title' => $item->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->title];
                }),
                'description' => $item->translations->mapWithKeys(function ($item) {
                    return [$item->locale => $item->description];
                }),
                'image' => $item->getFirstMediaUrl('bac_img'),
                'images' => $item->getMedia('bac_image')->pluck('original_url'),
            ];
        }

        $images = [];
        foreach ($pageSettings->images as $item) {
            $images[] = asset('storage/'.$item);
        }

        return response()->json([
            'banner' => asset('storage/'.$pageSettings->banner),
            'title' => [
                'uz' => $pageSettings->title_uz,
                'ru' => $pageSettings->title_ru,
                'en' => $pageSettings->title_en,
            ],
            'subtitle' => [
                'uz' => $pageSettings->subtitle_uz,
                'ru' => $pageSettings->subtitle_ru,
                'en' => $pageSettings->subtitle_en,
            ],
            'text' => [
                'uz' => $pageSettings->text_uz,
                'ru' => $pageSettings->text_ru,
                'en' => $pageSettings->text_en,
            ],
            'collage' => $images,
            'our_title' => [
                'uz' => $pageSettings->our_title_uz,
                'ru' => $pageSettings->our_title_ru,
                'en' => $pageSettings->our_title_en,
            ],
            'our_text' => [
                'uz' => $pageSettings->our_text_uz,
                'ru' => $pageSettings->our_text_ru,
                'en' => $pageSettings->our_text_en,
            ],
            'creations' => $creations,
            'info_name' => [
                'uz' => $pageSettings->info_name_uz,
                'ru' => $pageSettings->info_name_ru,
                'en' => $pageSettings->info_name_en,
            ],
            'info_title' => [
                'uz' => $pageSettings->info_title_uz,
                'ru' => $pageSettings->info_title_ru,
                'en' => $pageSettings->info_title_en,
            ],
            'info_list' => [
                'uz' => $pageSettings->info_list_uz,
                'ru' => $pageSettings->info_list_ru,
                'en' => $pageSettings->info_list_en,
            ],
        ]);

    }
}
