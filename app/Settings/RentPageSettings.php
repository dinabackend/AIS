<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class RentPageSettings extends Settings
{
    public string $main_title_ru;
    public string $main_title_uz;
    public string $main_title_en;
    public array $rents;
    public string $reviews_title_ru;
    public string $reviews_title_uz;
    public string $reviews_title_en;
    public string $products_title_ru;
    public string $products_title_uz;
    public string $products_title_en;
    public string $products_text_ru;
    public string $products_text_uz;
    public string $products_text_en;

    public static function group(): string
    {
        return 'rent';
    }
}
