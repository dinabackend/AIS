<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        //Banner
        $this->migrator->add('home.banner', []);

        //Info
        $this->migrator->add('home.info', []);

        //Advantages
        $this->migrator->add('home.advantages', []);

        //Companies
        $this->migrator->add('home.companies', []);

    }
};
