<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutSettings extends Settings
{
    public string $main_title_ru;
    public string $main_title_uz;
    public string $main_title_en;
    public string $title0_ru;
    public string $title0_uz;
    public string $title0_en;
    public string $text0_ru;
    public string $text0_uz;
    public string $text0_en;
    public string $banner;
    public string $question0_ru;
    public string $question0_uz;
    public string $question0_en;
    public string $title2_ru;
    public string $title2_uz;
    public string $title2_en;
    public string $name1_ru;
    public string $name1_uz;
    public string $name1_en;
    public string $text1_ru;
    public string $text1_uz;
    public string $text1_en;
    public string $name2_ru;
    public string $name2_uz;
    public string $name2_en;
    public string $text2_ru;
    public string $text2_uz;
    public string $text2_en;
    public string $img;
    public string $title3_ru;
    public string $title3_uz;
    public string $title3_en;
    public string $text3_ru;
    public string $text3_uz;
    public string $text3_en;


    public static function group(): string
    {
        return 'about';
    }
}
