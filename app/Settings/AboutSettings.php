<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class AboutSettings extends Settings
{

    public string $title_uz;
    public string $title_ru;
    public string $title_en;

    public string $text_uz;
    public string $text_ru;
    public string $text_en;

    public string $advantages_title_uz;
    public string $advantages_title_ru;
    public string $advantages_title_en;

    public array $advantages_text_uz;
    public array $advantages_text_ru;
    public array $advantages_text_en;

    public string $subtext_uz;
    public string $subtext_ru;
    public string $subtext_en;

    public string $company_numbers_title_uz;
    public string $company_numbers_title_ru;
    public string $company_numbers_title_en;

    public array $company_numbers_text_uz;
    public array $company_numbers_text_ru;
    public array $company_numbers_text_en;


    public static function group(): string
    {
        return 'about';
    }
}
