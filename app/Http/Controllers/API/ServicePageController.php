<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Settings\ServiceSettings;

class ServicePageController extends Controller
{
    public function index()
    {
        $settings = app(ServiceSettings::class);
        $services = Service::query()->take(10)->get();
        $repair = [];
        foreach ($settings->repair ?? [] as $i => $item) {
            foreach (['ru', 'uz', 'en'] as $lang) {
                $repair[$i]['title'][$lang] = $item["repair_title_$lang"];
                $repair[$i]['description'][$lang] = $item["description_$lang"];
            }
            $repair[$i]['image'] = !empty($item['img']) ? asset('storage/' . $item['img']) : '';
        }

        $card = [];
        foreach ($settings->card ?? [] as $i => $item) {
            foreach (['ru', 'uz', 'en'] as $lang) {
                $card[$i]['title'][$lang] = $item["card_title_$lang"];
                $card[$i]['description'][$lang] = $item["card_text_$lang"];
            }
        }

        $data = [
            'main_title' => [
                'ru' => $settings->main_title_ru ?? '',
                'uz' => $settings->main_title_uz ?? '',
                'en' => $settings->main_title_en ?? '',
            ],
            'engineers' => [
                'title' => [
                    'ru' => $settings->title_ru ?? '',
                    'uz' => $settings->title_uz ?? '',
                    'en' => $settings->title_en ?? '',
                ],
                'subtitle' => [
                    'ru' => $settings->subtitle_ru ?? '',
                    'uz' => $settings->subtitle_uz ?? '',
                    'en' => $settings->subtitle_en ?? '',
                ],
                'banner' => $settings->banner ? asset('storage/' . $settings->banner) : '',
            ],
            'repair' => $repair,
            'our_service' => [
                'title' => [
                    'ru' => $settings->service_title_ru ?? '',
                    'uz' => $settings->service_title_uz ?? '',
                    'en' => $settings->service_title_en ?? '',
                ],
                'subtitle' => [
                    'ru' => $settings->service_subtitle_ru ?? '',
                    'uz' => $settings->service_subtitle_uz ?? '',
                    'en' => $settings->service_subtitle_en ?? '',
                ],
                'services' => $services->map(function ($service) {
                    return [
                        'id' => $service->id,
                        'title' => $service->translations->mapWithKeys(function ($item) {
                            return [$item->locale => $item->title];
                        }),
                        'description' => $service->translations->mapWithKeys(function ($item) {
                            return [$item->locale => $item->description];
                        }),
                        'img' => $service->getFirstMediaUrl('service_image')
                    ];
                }),
            ],
            'application' => [
                'title' => [
                    'ru' => $settings->nearby_title_ru ?? '',
                    'uz' => $settings->nearby_title_uz ?? '',
                    'en' => $settings->nearby_title_en ?? '',
                ],
                'subtitle' => [
                    'ru' => $settings->subtitle2_ru ?? '',
                    'uz' => $settings->subtitle2_uz ?? '',
                    'en' => $settings->subtitle2_en ?? '',
                ],
            ],
            'advantages' => $card
        ];
        return response()->json([
            'data' => $data
        ]);
    }
}
