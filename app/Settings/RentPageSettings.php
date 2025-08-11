<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class RentPageSettings extends Settings
{

    public static function group(): string
    {
        return 'rent';
    }
}
