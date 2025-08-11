<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GuaranteePageSettings extends Settings
{
    public array $main;
    public array $guarantee;
    public array $question;
    public array $defect;
    public static function group(): string
    {

        return 'guarantee';
    }
}
