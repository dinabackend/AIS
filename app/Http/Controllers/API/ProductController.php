<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\ProductResource;
use App\Http\Resources\TypeResource;
use App\Models\Category;
use App\Models\CategoryTranslation;
use App\Models\Product;
use App\Models\Type;
use App\Models\TypeTranslation;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->get('search', false);
        $per_page = $request->get('per_page', 5000);

        $categories = [];
        if ($request->has('categories') && (Str::length($request->get('categories')) > 0)) {
            $categories = CategoryTranslation::query()->whereIn('name',
                Str::of($request->get('categories'))->explode(',')
            )->pluck('category_id');
        }

        $filters = [];
        if ($request->has('filters') && (Str::length($request->get('filters')) > 0)) {
            $filters = TypeTranslation::query()->whereIn('name',
                Str::of($request->get('filters'))->explode(',')
            )->pluck('type_id');
        }

        $products = Product::WithFilters($categories, $filters, $search)
            ->orderBy('order')
            ->paginate($per_page)->withQueryString();

        return [
            'pages_count' => ceil($products->total() / $products->perPage()),
            'count' => $products->total(),
            'next' => $products->nextPageUrl(),
            'prev' => $products->previousPageUrl(),
            'from' => $products->firstItem(),
            'to' => $products->lastItem(),
            'page' => $request->has('page') ? $request->get('page') : 1,
            'data' => new ProductCollection($products),
        ];
    }

    /**
     * Display a listing of the resource.
     */
    public function collection(Request $request)
    {
        $search = $request->get('search', false);
        $per_page = $request->get('per_page', 5000);

        $categories = [];
        if ($request->has('categories') && (Str::length($request->get('categories')) > 0)) {
            $categories = CategoryTranslation::query()->whereIn('name',
                Str::of($request->get('categories'))->explode(',')
            )->pluck('category_id');
        }

        $filters = [];
        if ($request->has('filters') && (Str::length($request->get('filters')) > 0)) {
            $filters = TypeTranslation::query()->whereIn('name',
                Str::of($request->get('filters'))->explode(',')
            )->pluck('type_id');
        }

        $products = Product::WithFilters($categories, $filters, $search)
            ->where('collection_visibility', 1)
            ->orderBy('order')
            ->paginate($per_page)->withQueryString();

        return [
            'pages_count' => ceil($products->total() / $products->perPage()),
            'count' => $products->total(),
            'next' => $products->nextPageUrl(),
            'prev' => $products->previousPageUrl(),
            'from' => $products->firstItem(),
            'to' => $products->lastItem(),
            'page' => $request->has('page') ? $request->get('page') : 1,
            'data' => new ProductCollection($products),
        ];
    }

    public function filter()
    {

        return [
            'data' => [
                'categories' => CategoryResource::collection(
                    Category::query()->with('children')
                        ->whereNull('parent_id')->orderBy('order')->get()
                ),
                'filters' => TypeResource::collection(Type::get()),
            ]
        ];
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
        $product = Product::query()->with('categories')->where('slug', $slug)->firstOrFail();

        return [
            'data' => [
                'products' => new ProductResource($product),
                'recommended_products' => ProductCollection::make(
                    Product::query()
                        ->whereHas('categories', function ($query) use ($product) {
                            $query->whereIn('categories.id', $product->categories->pluck('id'));
                        })
                        ->where('id', '!=', $product->id)
                        ->inRandomOrder()
                        ->limit(10)
                        ->get()
                )
            ]
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

    public function category()
    {
        $categories = Category::query()->with('children')->get();

        return [
            'data' => CategoryResource::collection($categories)
        ];
    }

    public function sheet(string $slug, string $lang)
    {
        $product = Product::query()->where('slug', $slug)->firstOrFail();
        if (!in_array($lang, ['ru', 'uz', 'en'])) {
            return response()->json(['message' => 'Invalid language'], 400);
        }
        $media = $product->getFirstMedia('product_sheet_' . $lang);
        $headerRows = $media->getCustomProperty('header_rows', 1);

        if (!$media) {
            return response()->json(['message' => 'File not found'], 404);
        }

        return view('table', ['file' => $media->getPath(), 'headerRows' => $headerRows]);
    }
}
