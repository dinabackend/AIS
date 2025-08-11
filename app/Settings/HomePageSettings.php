<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class HomePageSettings extends Settings
{
    public array $banner;
    public array $info;
    public array $advantages;
    public array $company;

    public static function group(): string
    {
        return 'home';
    }

}
