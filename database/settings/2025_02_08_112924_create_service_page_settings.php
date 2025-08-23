<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Main title
        $this->migrator->add('service.main_title_ru', "Инженеры и сервис");
        $this->migrator->add('service.main_title_uz', "Muhandislar va xizmat");
        $this->migrator->add('service.main_title_en', "Engineers and Service");

        //engineers
        $this->migrator->add('service.title_ru', "test");
        $this->migrator->add('service.title_uz', "test");
        $this->migrator->add('service.title_en', "test");
        $this->migrator->add('service.subtitle_ru', "test");
        $this->migrator->add('service.subtitle_uz', "test");
        $this->migrator->add('service.subtitle_en', "test");
        $this->migrator->add('service.banner', "");

        // service
        $this->migrator->add('service.service_title_ru', "test");
        $this->migrator->add('service.service_title_uz', "test");
        $this->migrator->add('service.service_title_en', "test");
        $this->migrator->add('service.service_subtitle_ru', "test");
        $this->migrator->add('service.service_subtitle_uz', "test");
        $this->migrator->add('service.service_subtitle_en', "test");
        $this->migrator->add('service.repair', []);
    }
};
