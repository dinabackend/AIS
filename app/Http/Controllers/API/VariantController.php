<?php

namespace App\Http\Controllers\API;

use App\Filament\Resources\ProductResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\VariantResource;
use App\Models\Variant;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $variants = Variant::with(['translations', 'product.translations'])->get();

        return VariantResource::collection($variants);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug, string $id)
    {
        if ($id === '0') {
            $product = Product::where('slug', $slug)->firstOrFail();

            return new ProductResource($product);
        }
        $variant = Variant::with(['translations', 'product.translations', 'characteristics'])->findOrFail($id);

        return new VariantResource($variant);
    }
}
