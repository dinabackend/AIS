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

use App\Settings\AboutSettings;
use App\Settings\ButtonsSettings;
use App\Settings\SparePartsPageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): array
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
            ->where('type', 'product')
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

    public function filter(): array
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
    public function store(Request $request): void
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $slug): array
    {
        $about = app(AboutSettings::class);
        $buttons = app(ButtonsSettings::class);
        $product = Product::query()->with('categories')->where('slug', $slug)->firstOrFail();
        $settings = app(SparePartsPageSettings::class);

        $data['our_partners']['title'] = [
            'ru' => 'Нам доверяют клиенты по всей стране',
            'uz' => 'Butun mamlakat bo\'ylab mijozlar bizga ishonishadi',
            'en' => 'Customers across the country trust us',
        ];
        $data['our_partners']['text'] = [
            'ru' => 'Более 500 компаний и частных клиентов выбрали AIS Techno Group как надёжного партнёра в сфере компрессорного оборудования и сервиса',
            'uz' => '500 dan ortiq kompaniyalar va xususiy mijozlar AIS Techno Group ni ishonchli hamkor sifatida tanladilar',
            'en' => 'More than 500 companies and private clients have chosen AIS Techno Group as a reliable partner in the field of compressor equipment and service',
        ];
        $data['our_partners']['images'] = [];
        foreach ($about->images as $img) {
            $data['our_partners']['images'][] = asset('storage/' . $img);
        }
        return [
            'data' => [
                'product_title' => [
                    'ru' => 'Карточка товара',
                    'uz' => 'Mahsulot kartasi',
                    'en' => 'Product card',
                ],
                'model_title' => [
                    'ru' => 'Модели товара',
                    'uz' => 'Mahsulot modellari',
                    'en' => 'Product models',
                ],
                'products' => new ProductResource($product),
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
                    'items' => ProductResource::collection(Product::query()->with('categories')->where('slug','!=', $slug)
                        ->where('type', 'product')
                        ->inRandomOrder()->limit(6)->get())
                ],
                'aside' => [
                    'title' => [
                        'ru' => 'Получите решение за 30 минут',
                        'uz' => 'Yechimni 30 daqiqada oling',
                        'en' => 'Get a solution in 30 minutes',
                    ],
                    'text' => [
                        'ru' => 'Инженеры AIS бесплатно подберут компрессор DALGAKIRAN под вашу нагрузку, рассчитают экономию энергии и вышлют КП',
                        'uz' => 'AIS muhandislari sizning yukingiz uchun DALGAKIRAN kompressorini bepul tanlaydilar, energiya tejashni hisoblab chiqadilar va sizga taklifnoma yuboradilar.',
                        'en' => 'AIS engineers will select the DALGAKIRAN compressor for your load for free, calculate energy savings, and send you a quotation',
                    ],
                    'button' => [
                        'ru' => $buttons->contacts_link_text_ru ?? '',
                        'uz' => $buttons->contacts_link_text_uz ?? '',
                        'en' => $buttons->contacts_link_text_en ?? '',
                        'link' => $buttons->contacts_link_link ?? '',
                    ],
                ],
                'our_partners' => $data['our_partners']
            ],
        ];
    }

    public function category(): array
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

        if (!$media) {return response()->json(['message' => 'File not found'], 404);}

        $headerRows = $media->getCustomProperty('header_rows', 1);

        return view('table', ['file' => $media->getPath(), 'headerRows' => $headerRows]);
    }

    /**
     * Search products by query (using translations, case-insensitive).
     */
    public function search(Request $request): array
    {
        $search = $request->get('search', false);
        $per_page = $request->get('per_page', 20); // Default smaller page size for search

        $products = Product::query()
            ->where('type', 'product')
            ->when($search, function ($query, $search) {
                $query->whereHas('translations', function ($q) use ($search) {
                    $q->where('name', 'ILIKE', "%{$search}%")
                      ->orWhere('description', 'ILIKE', "%{$search}%");
                });
            })
            ->orderBy('order')
            ->paginate($per_page)
            ->withQueryString();

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
}
