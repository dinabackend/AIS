<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{
    public string $img;
    public string $footer_title_uz;
    public string $footer_title_ru;
    public string $footer_title_en;

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

    public static function group(): string
    {
        return 'general';
    }
}
