<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
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

        $data = [
            'main_title' => [
                'ru' => $settings->main_title_ru ?? '',
                'uz' => $settings->main_title_uz ?? '',
                'en' => $settings->main_title_en ?? '',
            ],
            'Catalog_SpareParts' => [
                'ru' => $settings->SparePartsCatalog_ru ?? '',
                'uz' => $settings->SparePartsCatalog_uz ?? '',
                'en' => $settings->SparePartsCatalog_en ?? '',
            ],
            'Catalog_text' => [
                'ru' => $settings->text_ru ?? '',
                'uz' => $settings->text_uz ?? '',
                'en' => $settings->text_en ?? '',
            ],
            'PM_Series' => [
                'ru' => $settings->PM_Series_ru ?? '',
                'uz' => $settings->PM_Series_uz ?? '',
                'en' => $settings->PM_Series_en ?? '',
            ],
            'PM_Series_text2' => [
                'ru' => $settings->text2_ru ?? '',
                'uz' => $settings->text2_uz ?? '',
                'en' => $settings->text2_en ?? '',
            ],
            'PM_SeriesDALGAKIRAN' => [
                'ru' => $settings->DALGAKIRAN_ru ?? [],
                'uz' => $settings->DALGAKIRAN_uz ?? [],
                'en' => $settings->DALGAKIRAN_en ?? [],
            ],
            'query' => [
                'ru' => $settings->query_ru ?? '',
                'uz' => $settings->query_uz ?? '',
                'en' => $settings->query_en ?? '',
            ],
            'answer' => [
                'ru' => $settings->answer_ru ?? '',
                'uz' => $settings->answer_uz ?? '',
                'en' => $settings->answer_en ?? '',
            ],
        ];

        return response()->json($data);
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
