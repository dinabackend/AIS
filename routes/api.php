<?php

use App\Http\Controllers\API\AboutController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\FooterController;
use App\Http\Controllers\API\GuaranteeController;
use App\Http\Controllers\API\HomePageController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\RentPageController;
use App\Http\Controllers\API\SEOController;
use App\Http\Controllers\API\ServicePageController;
use App\Http\Controllers\API\SparePartsPageController;
use App\Http\Controllers\API\VariantController;
use Illuminate\Support\Facades\Route;

/*Route::get('/{locale}/products/filter', [ProductController::class, 'filter']);
Route::get('/{locale}/products/{id}', [ProductController::class, 'show']);
Route::get('/{locale}/home', [HomePageController::class, 'index']);
Route::get('/{locale}/footer', [FooterController::class, 'index']);
Route::get('/{locale}/about', [AboutController::class, 'index']);
Route::get('/{locale}/teams', [UserController::class, 'index']);
Route::get('/{locale}/teams/{id}', [UserController::class, 'show']);*/

// AIS API
Route::get('/seo', [SEOController::class, 'index']);
Route::get('/policy', [HomePageController::class, 'policy']);
Route::get('/home', [HomePageController::class, 'index']);
Route::get('/footer', [FooterController::class, 'index']);
Route::get('/guarantee', [GuaranteeController::class, 'index']);
Route::get('/rent', [RentPageController::class, 'index']);
Route::get('/spare-parts', [SparePartsPageController::class, 'index']);
Route::get('/service', [ServicePageController::class, 'index']);

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{slug}', [ProductController::class, 'show']);
//Route::get('/products/filters', [ProductController::class, 'filter']);

Route::get('/variants', [VariantController::class, 'index']);
Route::get('/variants/{slug}', [VariantController::class, 'show']);

Route::get('/events', [EventController::class, 'index']); // ✅
Route::get('/events/{id}', [EventController::class, 'show']); // ✅
Route::get('/about', [AboutController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/tree', [CategoryController::class, 'tree']);
Route::get('/categories/{id}/children', [CategoryController::class, 'children']);
Route::get('/categories/{slug}', [CategoryController::class, 'show']);
Route::get('/catalog/{category}', [CategoryController::class, 'catalog']);
