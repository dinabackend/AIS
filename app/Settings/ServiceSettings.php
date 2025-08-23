<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ServiceSettings extends Settings
{
    public string $main_title_ru;
    public string $main_title_uz;
    public string $main_title_en;
    public string $title_ru;
    public string $title_uz;
    public string $title_en;
    public string $subtitle_ru;
    public string $subtitle_uz;
    public string $subtitle_en;
    public string $banner;
    public string $service_title_ru;
    public string $service_title_uz;
    public string $service_title_en;
    public string $service_subtitle_ru;
    public string $service_subtitle_uz;
    public string $service_subtitle_en;
    public array $repair;

    public static function group(): string
    {
        return 'service';
    }
}
