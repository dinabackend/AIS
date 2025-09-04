<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\Review;
use App\Settings\ButtonsSettings;
use App\Settings\RentPageSettings;
use Illuminate\Http\Request;

class RentPageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = app(RentPageSettings::class);
        $buttons = app(ButtonsSettings::class);
        $rents = Review::query()->where('status', 1)->take(20)->orderBy('date')->get();
        $recommended_products = Product::query()->take(10)->where('type', 'product')->get();

        $rents_data = [];
        foreach ($settings->rents ?? [] as $rent) {
            $item = [
                'ru' => [
                    'title' => $rent['title_ru'] ?? '',
                    'text' => $rent['text_ru'] ?? '',
                    'category_text' => $rent['category_text_ru'] ?? '',
                ],
                'uz' => [
                    'title' => $rent['title_uz'] ?? '',
                    'text' => $rent['text_uz'] ?? '',
                    'category_text' => $rent['category_text_uz'] ?? '',
                ],
                'en' => [
                    'title' => $rent['title_en'] ?? '',
                    'text' => $rent['text_en'] ?? '',
                    'category_text' => $rent['category_text_en'] ?? '',
                ],
                'image' => $rent['img'] ? asset('storage/' . $rent['img']) : '',
            ];
            $item['button'] = [
                'ru' => [
                    'text' => $buttons->privacy_link_text_ru ?? '',
                ],
                'uz' => [
                    'text' => $buttons->privacy_link_text_uz ?? '',
                ],
                'en' => [
                    'text' => $buttons->privacy_link_text_en ?? '',
                ],
                'link' => $buttons->privacy_link_link ?? '',
            ];
            $rents_data[] = $item;
        }


        $data = [
            'main_title' => [
                'ru' => $settings->main_title_ru ?? '',
                'uz' => $settings->main_title_uz ?? '',
                'en' => $settings->main_title_en ?? '',
            ],
            'rents' => $rents_data,
            'reviews' => [
                'title' => [
                    'ru' => $settings->reviews_title_ru ?? '',
                    'uz' => $settings->reviews_title_uz ?? '',
                    'en' => $settings->reviews_title_en ?? '',
                ],
                'review' => $rents->map(function ($review) {
                    return [
                        'id' => $review->id,
                        'name' => $review->translations->mapWithKeys(function ($item) {
                            return [$item->locale => $item->name];
                        }),
                        'text' => $review->translations->mapWithKeys(function ($item) {
                            return [$item->locale => $item->text];
                        }),
                        'created_at' => $review->date,
                        'rating' => $review->rating,
                        'status' => $review->status,
                    ];
                }),
            ],
            'recommended_products' => [
                'title' => [
                    'ru' => $settings->products_title_ru ?? '',
                    'uz' => $settings->products_title_uz ?? '',
                    'en' => $settings->products_title_en ?? '',
                ],
                'text' => [
                    'ru' => $settings->products_text_ru ?? '',
                    'uz' => $settings->products_text_uz ?? '',
                    'en' => $settings->products_text_en ?? '',
                ],
                'items' => ProductCollection::make($recommended_products)->additional([
                    'meta' => [
                        'total' => $recommended_products->count(),
                        'per_page' => 10,
                        'current_page' => 1,
                    ],
                ]),
            ],
        ];

        return response()->json([
            'data' => $data,
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
