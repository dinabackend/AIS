<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomePageSettings extends Settings
{

    public string $title_uz;
    public string $title_ru;
    public string $title_en;

    public string $about_title_uz;
    public string $about_title_ru;
    public string $about_title_en;

    public string $about_text_uz;
    public string $about_text_ru;
    public string $about_text_en;

    public array $about_numbers_uz;
    public array $about_numbers_ru;
    public array $about_numbers_en;

    public string $team_title_uz;
    public string $team_title_ru;
    public string $team_title_en;

    public string $collection_title_uz;
    public string $collection_title_ru;
    public string $collection_title_en;

    public string $collection_text_uz;
    public string $collection_text_ru;
    public string $collection_text_en;

    public array $collection_images;

    public array $upcoming_banner;

    public $events_title_uz;
    public $events_title_ru;
    public $events_title_en;

    public $preorder_uz;
    public $preorder_ru;
    public $preorder_en;

    public static function group(): string
    {
        return 'home';
    }

}
