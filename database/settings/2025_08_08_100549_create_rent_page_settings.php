<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{

    public function up(): void
    {
        $this->migrator->add('rent.main_title_ru', 'Аренда оборудования');
        $this->migrator->add('rent.main_title_uz', 'Uskunani ijaraga olish');
        $this->migrator->add('rent.main_title_en', 'Equipment rental');

        $this->migrator->add('rent.rents', [
            'ru' => [
                    'title' => '',
                    'text' => '',
                    'category_text' => '',
                    'image' => '',
            ],
            'uz' => [
                    'title' => '',
                    'text' => '',
                    'category_text' => '',
                    'image' => '',
            ],
            'en' => [
                    'title' => '',
                    'text' => '',
                    'category_text' => '',
                    'image' => '',
            ],
        ]);

        $this->migrator->add('rent.reviews_title_ru', 'Отзывы');
        $this->migrator->add('rent.reviews_title_uz', 'Sharhlar');
        $this->migrator->add('rent.reviews_title_en', 'Reviews');
    }
};
