<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use App\Settings\SeoPageSettings;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::with(['translation', 'parent.translation'])->get();

        return CategoryResource::collection($categories);
    }

    public function tree()
    {
        $seo = app(SeoPageSettings::class);
        $categories = Category::tree()
            ->with(['translation', 'children' => function($query) {
                $query->with(['translation', 'children' => function($subQuery) {
                    $subQuery->with('translation');
                }]);
            }])
            ->get();

        return [
            'data' => [
                'main_title' => [
                    'ru' => $seo->catalog_title_ru,
                    'uz' => $seo->catalog_title_uz,
                    'en' => $seo->catalog_title_en,
                ],
                'categories' => CategoryResource::collection($categories),
            ]
        ];
    }

    /**
     * Muayyan kategoriyaning barcha subcategorylarini olish
     */
    public function children($id)
    {
        $category = Category::with(['children.translation'])->findOrFail($id);

        return CategoryResource::collection($category->children);
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
    public function show(string $slug)
    {
        $category = Category::with(['translation', 'parent.translation', 'children.translation'])
            ->where('slug', $slug)
            ->firstOrFail();

        return new CategoryResource($category);
    }

    /**
     * Display products for a specific category (catalog)
     */
    public function catalog(string $category)
    {
        $seo = app(SeoPageSettings::class);
        $categoryModel = Category::with(['translation', 'parent.translation', 'children.translation'])
            ->where('slug', $category)
            ->firstOrFail();

        // Get all products that belong to this category and its children
        $allCategoryIds = collect([$categoryModel->id]);
        $allCategoryIds = $allCategoryIds->merge($categoryModel->getAllChildren()->pluck('id'));

        $products = Product::with(['translations', 'categories.translation'])
            ->whereHas('categories', function($query) use ($allCategoryIds) {
                $query->whereIn('categories.id', $allCategoryIds);
            })
            ->get();

        return [
            'main_title' => [
                'ru' => $seo->category_title_ru,
                'uz' => $seo->category_title_uz,
                'en' => $seo->category_title_en,
            ],
            'category' => new CategoryResource($categoryModel),
            'products' => ProductResource::collection($products),
            'total_products' => $products->count()
        ];
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
