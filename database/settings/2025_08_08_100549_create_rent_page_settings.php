<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {

    public function up(): void
    {
        $this->migrator->add('rent.main_title_ru', 'Аренда оборудования');
        $this->migrator->add('rent.main_title_uz', 'Uskunani ijaraga olish');
        $this->migrator->add('rent.main_title_en', 'Equipment rental');

        $this->migrator->add('rent.rents', [
            [
                'image' => '',
                'ru' => [
                    'title' => 'null',
                    'text' => 'null',
                    'category_text' => 'null',
                ],
                'uz' => [
                    'title' => 'null',
                    'text' => 'null',
                    'category_text' => 'null',
                ],
                'en' => [
                    'title' => 'null',
                    'text' => 'null',
                    'category_text' => 'null',
                ],
            ],
        ]);

        $this->migrator->add('rent.reviews_title_ru', 'Отзывы');
        $this->migrator->add('rent.reviews_title_uz', 'Sharhlar');
        $this->migrator->add('rent.reviews_title_en', 'Reviews');
    }
};
