<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration {

    public function up(): void
    {
        // main_title
        $this->migrator->add('spare_parts.main_title_ru', 'Запчасти');
        $this->migrator->add('spare_parts.main_title_uz', 'Ehtiyot qismlar');
        $this->migrator->add('spare_parts.main_title_en', 'Spare Parts');

        // catalog
        $this->migrator->add('spare_parts.SparePartsCatalog_ru', 'text');
        $this->migrator->add('spare_parts.SparePartsCatalog_uz', 'text');
        $this->migrator->add('spare_parts.SparePartsCatalog_en', 'text');
        $this->migrator->add('spare_parts.text_ru', 'text');
        $this->migrator->add('spare_parts.text_uz', 'text');
        $this->migrator->add('spare_parts.text_en', 'text');

        // PM_Series
        $this->migrator->add('spare_parts.PM_Series_ru', 'text');
        $this->migrator->add('spare_parts.PM_Series_uz', 'text');
        $this->migrator->add('spare_parts.PM_Series_en', 'text');
        $this->migrator->add('spare_parts.text2_ru', 'text');
        $this->migrator->add('spare_parts.text2_uz', 'text');
        $this->migrator->add('spare_parts.text2_en', 'text');
        $this->migrator->add('spare_parts.DALGAKIRAN_ru', []);
        $this->migrator->add('spare_parts.DALGAKIRAN_uz', []);
        $this->migrator->add('spare_parts.DALGAKIRAN_en', []);

        // query
        $this->migrator->add('spare_parts.query_ru', 'text');
        $this->migrator->add('spare_parts.query_uz', 'text');
        $this->migrator->add('spare_parts.query_en', 'text');
        $this->migrator->add('spare_parts.answer_ru', 'test');
        $this->migrator->add('spare_parts.answer_uz', 'test');
        $this->migrator->add('spare_parts.answer_en', 'test');

        // recommended_products
        $this->migrator->add('spare_parts.title_ru', 'test');
        $this->migrator->add('spare_parts.title_uz', 'test');
        $this->migrator->add('spare_parts.title_en', 'test');
        $this->migrator->add('spare_parts.text4_ru', 'test');
        $this->migrator->add('spare_parts.text4_uz', 'test');
        $this->migrator->add('spare_parts.text4_en', 'test');

        //Product card
        $this->migrator->add('spare_parts.card_title_ru', 'test');
        $this->migrator->add('spare_parts.card_title_uz', 'test');
        $this->migrator->add('spare_parts.card_title_en', 'test');
        $this->migrator->add('spare_parts.card_text_ru', 'test');
        $this->migrator->add('spare_parts.card_text_uz', 'test');
        $this->migrator->add('spare_parts.card_text_en', 'test');
    }
};
