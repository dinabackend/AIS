<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Settings\GuaranteePageSettings;
use Illuminate\Http\Request;

class GuaranteeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $guarantees = app(GuaranteePageSettings::class);

        $data = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $data['main_title'][$lang] = $guarantees->{'main_title_' . $lang} ?? '';
            $data['title'][$lang] = $guarantees->{'title_' . $lang} ?? '';
            $data['5 -year guarantee'][$lang] = $guarantees->{'subtitle_' . $lang} ?? '';
            $data['repeater'][$lang] = collect($guarantees->{'repeater_' . $lang} ?? [])
                ->map(function ($item) {
                    return [
                        'name' => $item['name'] ?? '',
                        'text' => $item['text'] ?? '',
                    ];
                })->toArray();
            $data['image'] = $guarantees->banner ?? '';
            $data['questions']['title'][$lang] = $guarantees->{'question_' . $lang} ?? '';
            $data['questions']['list'][$lang] = collect($guarantees->{'question_list_' . $lang} ?? [])
                ->map(function ($item) {
                    return $item['answer'] ?? '';
                })->toArray();
            $data['defect']['title'][$lang] = $guarantees->{'defect_title_' . $lang} ?? '';
            $data['defect']['list'][$lang] = collect($guarantees->{'defect_list_' . $lang} ?? [])
                ->map(function ($item) {
                    return $item['text'] ?? '';
                })->toArray();
            $data['consultation']['query'][$lang] = $guarantees->{'query_' . $lang} ?? '';
            $data['consultation']['tell'][$lang] = $guarantees->{'tell_' . $lang} ?? '';
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
