<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class B2BPageSettings extends Settings
{
    public ?string $banner;

    public ?string $title_uz;
    public ?string $title_ru;
    public ?string $title_en;

    public ?string $subtitle_uz;
    public ?string $subtitle_ru;
    public ?string $subtitle_en;

    public ?array $text_uz;
    public ?array $text_ru;
    public ?array $text_en;

    public ?array $images;

    public ?string $our_title_uz;
    public ?string $our_title_ru;
    public ?string $our_title_en;

    public ?string $our_text_uz;
    public ?string $our_text_ru;
    public ?string $our_text_en;

    public ?string $info_name_uz;
    public ?string $info_name_ru;
    public ?string $info_name_en;

    public ?string $info_title_uz;
    public ?string $info_title_ru;
    public ?string $info_title_en;

    public ?array $info_list_en;
    public ?array $info_list_uz;
    public ?array $info_list_ru;

    public static function group(): string
    {
        return 'b2b';
    }

    protected $casts = [
        'meta' => 'array',
    ];
}
