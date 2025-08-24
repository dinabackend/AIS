<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Settings\ServiceSettings;
use Illuminate\Http\Request;

class ServicePageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = app(ServiceSettings::class);
        $services = Service::query()->take(10)->get();
        $info = [];
        foreach ($settings->repair ?? [] as $repair) {
            $item = [
                'ru' => [
                    'title' => $repair['repair_title_ru'] ?? '',
                    'description' => $repair['description_ru'] ?? '',
                ],
                'uz' => [
                    'title' => $repair['repair_title_uz'] ?? '',
                    'description' => $repair['description_uz'] ?? '',
                ],
                'en' => [
                    'title' => $repair['repair_title_en'] ?? '',
                    'description' => $repair['description_en'] ?? '',
                ],
                'image' => !empty($repair['img']) ? asset('storage/' . $repair['img']) : '',
            ];
            $info[] = $item;
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
            'repair' => $info,
            'our service' => [
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
                        'img' => $service->getFirstMediaUrl('service_img')
                    ];
                }),
            ],
        ];
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
