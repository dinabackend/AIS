<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomePageSettings extends Settings
{
    public array $banner;

    public static function group(): string
    {
        return 'home';
    }

}
