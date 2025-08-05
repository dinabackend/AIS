<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class PolicySettings extends Settings
{
    public ?string $content_uz;
    public ?string $content_ru;
    public ?string $content_en;

    public static function group(): string
    {
        return 'policy';
    }

}
