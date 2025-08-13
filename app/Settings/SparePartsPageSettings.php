<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SparePartsPageSettings extends Settings
{
    // main_title
    public string $main_title_ru;
    public string $main_title_uz;
    public string $main_title_en;
    // catalog
    public string $SparePartsCatalog_ru;
    public string $SparePartsCatalog_uz;
    public string $SparePartsCatalog_en;
    public string $text_ru;
    public string $text_uz;
    public string $text_en;
    // PM_Series
    public string $PM_Series_ru;
    public string $PM_Series_uz;
    public string $PM_Series_en;
    public string $text2_ru;
    public string $text2_uz;
    public string $text2_en;
    public array $DALGAKIRAN_ru;
    public array $DALGAKIRAN_uz;
    public array $DALGAKIRAN_en;
    // query
    public string $query_ru;
    public string $query_uz;
    public string $query_en;
    public string $answer_ru;
    public string $answer_uz;
    public string $answer_en;

    public static function group(): string
    {
        return 'spare_parts';
    }
}
