<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class FooterSettings extends Settings
{
    public string $footer_title_uz;
    public string $footer_title_ru;
    public string $footer_title_en;

    public string $address_uz;
    public string $address_ru;
    public string $address_en;

    public string $telegram;
    public string $instagram;
    public string $whatsapp;

    public string $mail;

    public string $phone_top_1;
    public string $phone_top_2;
    public string $phone_footer;


    public static function group(): string
    {
        return 'general';
    }
}
