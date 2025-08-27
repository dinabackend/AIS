<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\FooterResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class FooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json([
            'data' => new FooterResource([])
        ]);
    }

    public function header(): JsonResponse
    {
        $company = [
            'title' => [
                'uz' => 'Kompaniya',
                'ru' => 'Компания',
                'en' => 'Company',
            ],
            'links' => [
                // Блог
                [
                    'title' => [
                        'ru' => 'Блог',
                        'uz' => 'Blog',
                        'en' => 'Blog',
                    ],
                    'url' => '/events',
                ],
                // Гарантия
                [
                    'title' => [
                        'ru' => 'Гарантия',
                        'uz' => 'Kafolat',
                        'en' => 'Warranty',
                    ],
                    'url' => '/guarantee',
                ],
                // О компании
                [
                    'title' => [
                        'ru' => 'О компании',
                        'uz' => 'Kompaniya haqida',
                        'en' => 'About company',
                    ],
                    'url' => '/about',
                ]
            ]
        ];

        $sevice_spare_parts = [
            'title' => [
                'uz' => 'Xizmat va ehtiyot qismlar',
                'ru' => 'Сервис и запчасти',
                'en' => 'Service and spare parts',
            ],
            'links' => [
                [
                    'title' => [
                        'ru' => 'Запчасти',
                        'uz' => 'Ehtiyot qismlar',
                        'en' => 'Spare parts',
                    ],
                    'url' => '/spare-parts',
                ],
                [
                    'title' => [
                        'ru' => 'Инженеры и сервис',
                        'uz' => 'Muhandislar va servis',
                        'en' => 'Engineers and service',
                    ],
                    'url' => '/service',
                ],
                [
                    'title' => [
                        'ru' => 'Аренда оборудования',
                        'uz' => "Uskunalarni ijaraga olish",
                        'en' => 'Equipment rental',
                    ],
                    'url' => '/rental',
                ]
            ]
        ];

        $categries = $categories = Category::tree()
            ->with(['translation', 'children' => function($query) {
                $query->with(['translation', 'children' => function($subQuery) {
                    $subQuery->with('translation');
                }]);
            }])
            ->get();

        return response()->json([
            'data' => [
                'company' => $company,
                'categories' => CategoryResource::collection($categories),
                'service_spare_parts' => $sevice_spare_parts
            ]
        ]);
    }
}
