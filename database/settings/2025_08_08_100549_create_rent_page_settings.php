<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {

    public function up(): void
    {
        $this->migrator->add('rent.main_title_ru', 'Аренда оборудования');
        $this->migrator->add('rent.main_title_uz', 'Uskunani ijaraga olish');
        $this->migrator->add('rent.main_title_en', 'Equipment rental');

        $this->migrator->add('rent.rents', []);

        $this->migrator->add('rent.reviews_title_ru', 'Отзывы');
        $this->migrator->add('rent.reviews_title_uz', 'Sharhlar');
        $this->migrator->add('rent.reviews_title_en', 'Reviews');

        $this->migrator->add('rent.products_title_ru', 'test');
        $this->migrator->add('rent.products_title_uz', 'test');
        $this->migrator->add('rent.products_title_en', 'test');
        $this->migrator->add('rent.products_text_ru', 'test');
        $this->migrator->add('rent.products_text_uz', 'test');
        $this->migrator->add('rent.products_text_en', 'test');
    }
};
