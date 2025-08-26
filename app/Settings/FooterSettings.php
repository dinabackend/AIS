<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{
    public string $img;
    public string $left_text_uz;
    public string $left_text_ru;
    public string $left_text_en;
    public string $right_text_uz;
    public string $right_text_ru;
    public string $right_text_en;

    public string $address_uz;
    public string $address_ru;
    public string $address_en;

    public string $telegram;
    public string $instagram;
    public string $linkedin;
    public string $facebook;
    public string $mail1;
    public string $mail2;

    public string $phone;

    public string $title_uz;
    public string $title_ru;
    public string $title_en;
    public string $text_uz;
    public string $text_ru;
    public string $text_en;
    public string $contact_main_title_uz;
    public string $contact_main_title_ru;
    public string $contact_main_title_en;
    public string $contact_title_uz;
    public string $contact_title_ru;
    public string $contact_title_en;
    public string $contact_subtitle_uz;
    public string $contact_subtitle_ru;
    public string $contact_subtitle_en;
    public string $contact_text1_uz;
    public string $contact_text1_ru;
    public string $contact_text1_en;
    public string $contact_text2_uz;
    public string $contact_text2_ru;
    public string $contact_text2_en;
    public string $contact_text3_uz;
    public string $contact_text3_ru;
    public string $contact_text3_en;

    public static function group(): string
    {
        return 'general';
    }
}
