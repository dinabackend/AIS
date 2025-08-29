<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutSettings extends Settings
{
    public string $main_title_ru;
    public string $main_title_uz;
    public string $main_title_en;
    public string $about_ru;
    public string $about_uz;
    public string $about_en;
    public string $text_ru;
    public string $text_uz;
    public string $text_en;
    public string $banner_ru;
    public string $banner_uz;
    public string $banner_en;
    public string $question_ru;
    public string $question_uz;
    public string $question_en;
    public array $information;
    public string $dalgakiran_ru;
    public string $dalgakiran_uz;
    public string $dalgakiran_en;
    public string $Our_goal_ru;
    public string $Our_goal_uz;
    public string $Our_goal_en;
    public string $text1_ru;
    public string $text1_uz;
    public string $text1_en;
    public string $We_offer_ru;
    public string $We_offer_uz;
    public string $We_offer_en;
    public string $text2_ru;
    public string $text2_uz;
    public string $text2_en;
    public string $img;
    public string $ourPartners_ru;
    public string $ourPartners_uz;
    public string $ourPartners_en;
    public string $text3_ru;
    public string $text3_uz;
    public string $text3_en;
    public array $images;

    public static function group(): string
    {
        return 'about';
    }
}
