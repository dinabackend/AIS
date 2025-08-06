<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        //Banner
        $this->migrator->add('home.banner', []);
    }
};
