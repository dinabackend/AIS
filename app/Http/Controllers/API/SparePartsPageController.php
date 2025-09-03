<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Settings\ButtonsSettings;
use App\Settings\SparePartsPageSettings;
use Illuminate\Http\Request;

class SparePartsPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = app(SparePartsPageSettings::class);
        $recommended_products = Product::query()->take(10)->get();
        $buttons = app(ButtonsSettings::class);

        $spare_parts = Product::query()->where('type', 'spare_part')->orderBy('order')->get();

        $pm_series = [];
        foreach (['ru', 'uz', 'en'] as $i => $lang) {
            $pm_series[$lang] = collect($settings->{'DALGAKIRAN_' . $lang} ?? [])
                ->map(function ($item) use ($i) {
                    return [
                        'title' => $item['title'] ?? '',
                        'text' => $item['text'] ?? '',
                        'image' => asset("img/pm_series$i.svg"),
                    ];
                })->toArray();
        }

        $data = [
            'main_title' => [
                'ru' => $settings->main_title_ru ?? '',
                'uz' => $settings->main_title_uz ?? '',
                'en' => $settings->main_title_en ?? '',
            ],
            'catalog_spare_parts' => [
                'title' => [
                    'ru' => $settings->SparePartsCatalog_ru ?? '',
                    'uz' => $settings->SparePartsCatalog_uz ?? '',
                    'en' => $settings->SparePartsCatalog_en ?? '',
                ],
                'text' => [
                    'ru' => $settings->text_ru ?? '',
                    'uz' => $settings->text_uz ?? '',
                    'en' => $settings->text_en ?? '',
                ],
            ],
            'spare_parts' => ProductResource::collection($spare_parts),
            'pm_series' => [
                'title' => [
                    'ru' => $settings->PM_Series_ru ?? '',
                    'uz' => $settings->PM_Series_uz ?? '',
                    'en' => $settings->PM_Series_en ?? '',
                ],
                'text' => [
                    'ru' => $settings->text2_ru ?? '',
                    'uz' => $settings->text2_uz ?? '',
                    'en' => $settings->text2_en ?? '',
                ],
                'item' => $pm_series,
            ],
            'query' => [
                'title' => [
                    'ru' => $settings->query_ru ?? '',
                    'uz' => $settings->query_uz ?? '',
                    'en' => $settings->query_en ?? '',
                ],
                'text' => [
                    'ru' => $settings->answer_ru ?? '',
                    'uz' => $settings->answer_uz ?? '',
                    'en' => $settings->answer_en ?? '',
                ],
                'button' => [
                    'text' => [
                        'ru' => $buttons->telegram_text_ru,
                        'uz' => $buttons->telegram_text_uz,
                        'en' => $buttons->telegram_text_en,
                    ],
                    'link' => $buttons->telegram_link,
                ],
            ],
            'recommended_products' => [
                'title' => [
                    'ru' => $settings->title_ru ?? '',
                    'uz' => $settings->title_uz ?? '',
                    'en' => $settings->title_en ?? '',
                ],
                'text' => [
                    'ru' => $settings->text4_ru ?? '',
                    'uz' => $settings->text4_uz ?? '',
                    'en' => $settings->text4_en ?? '',
                ],
                'items' => ProductCollection::make($recommended_products)->additional([
                    'meta' => [
                        'total' => $recommended_products->count(),
                        'per_page' => 10,
                        'current_page' => 1,
                    ],
                ]),
            ],
//            'product_card' => [
//                'title' => [
//                    'ru' => $settings->card_title_ru ?? '',
//                    'uz' => $settings->card_title_uz ?? '',
//                    'en' => $settings->card_title_en ?? '',
//                ],
//                'text' => [
//                    'ru' => $settings->card_text_ru ?? '',
//                    'uz' => $settings->card_text_uz ?? '',
//                    'en' => $settings->card_text_en ?? '',
//                ],
//
//            ],
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
