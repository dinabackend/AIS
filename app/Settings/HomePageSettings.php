<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomePageSettings extends Settings
{
    // Banner
    public array $banner;

    // Info
    public string $title2_ru;
    public string $title2_uz;
    public string $title2_en;
    public string $subtitle2_ru;
    public string $subtitle2_uz;
    public string $subtitle2_en;
    public string $text1_ru;
    public string $text1_uz;
    public string $text1_en;
    public string $text2_ru;
    public string $text2_uz;
    public string $text2_en;
    public string $text3_ru;
    public string $text3_uz;
    public string $text3_en;
    public array $info2_ru;
    public array $info2_uz;
    public array $info2_en;
    public string $img;
    public string $img2;

    // company
    public string $background_img;
    public string $title3_ru;
    public string $title3_uz;
    public string $title3_en;
    public string $name1_ru;
    public string $name1_uz;
    public string $name1_en;
    public string $name2_ru;
    public string $name2_uz;
    public string $name2_en;
    public string $text5_ru;
    public string $text5_uz;
    public string $text5_en;
    public string $text6_ru;
    public string $text6_uz;
    public string $text6_en;
    public array $imagess;

    // cooperation
    public string $titleb_ru;
    public string $titleb_uz;
    public string $titleb_en;
    public array $images;
    // event
    public string $event_title_ru;
    public string $event_title_uz;
    public string $event_title_en;
    public static function group(): string
    {
        return 'home';
    }

}
