<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
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
        $rents = Review::take(20)->get();

        $data = [
            'main_title' => [
                'ru' => $settings->main_title_ru ?? '',
                'uz' => $settings->main_title_uz ?? '',
                'en' => $settings->main_title_en ?? '',
            ],
            'rents' => [],
            'reviews_title' => [
                'ru' => $settings->reviews_title_ru ?? '',
                'uz' => $settings->reviews_title_uz ?? '',
                'en' => $settings->reviews_title_en ?? '',
            ],
            'reviews' => $rents->map(function ($review) {
                return [
                    'id' => $review->id,
                    'name' => $review->translations->mapWithKeys(function ($item) {
                        return [$item->locale => $item->name];
                    }),
                    'text' => $review->translations->mapWithKeys(function ($item) {
                        return [$item->locale => $item->text];
                    }),
                    'created_at' => $review->created_at->format('Y-m-d H:i:s'),
                ];
            }),
        ];

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
                'image' => $rent['image'] ?? '',
            ];
            $data['rents'][] = $item;
        }



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
