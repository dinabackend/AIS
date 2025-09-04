<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\VariantResource;
use App\Models\Product;
use App\Models\Variant;
use App\Settings\AboutSettings;
use App\Settings\ButtonsSettings;
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
        $about = app(AboutSettings::class);
        $buttons = app(ButtonsSettings::class);
        $recommended = Product::query()->with('categories')
            ->where('slug','!=', $slug)->inRandomOrder()->limit(6)->get();

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
        if (is_array($about->images)) {
            foreach ($about->images as $img) {
                $data['our_partners']['images'][] = asset('storage/' . $img);
            }
        }

        if ($id === '0') {
            $product = Product::where('slug', $slug)->firstOrFail();
            $response = new ProductResource($product);
        } else {
            $variant = Variant::with(['translations', 'product.translations', 'characteristics'])->findOrFail($id);
            $response = new VariantResource($variant);
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
                'products' => $response,
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
                    'items' => ProductResource::collection($recommended)
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
}
