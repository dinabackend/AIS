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
        $this->migrator->add('spare_parts.SparePartsCatalog_ru', 'null');
        $this->migrator->add('spare_parts.SparePartsCatalog_uz', 'null');
        $this->migrator->add('spare_parts.SparePartsCatalog_en', 'null');
        $this->migrator->add('spare_parts.text_ru', 'null');
        $this->migrator->add('spare_parts.text_uz', 'null');
        $this->migrator->add('spare_parts.text_en', 'null');

        // PM_Series
        $this->migrator->add('spare_parts.PM_Series_ru', 'null');
        $this->migrator->add('spare_parts.PM_Series_uz', 'null');
        $this->migrator->add('spare_parts.PM_Series_en', 'null');
        $this->migrator->add('spare_parts.text2_ru', 'null');
        $this->migrator->add('spare_parts.text2_uz', 'null');
        $this->migrator->add('spare_parts.text2_en', 'null');
        $this->migrator->add('spare_parts.DALGAKIRAN_ru', []);
        $this->migrator->add('spare_parts.DALGAKIRAN_uz', []);
        $this->migrator->add('spare_parts.DALGAKIRAN_en', []);

        // query
        $this->migrator->add('spare_parts.query_ru', 'null');
        $this->migrator->add('spare_parts.query_uz', 'null');
        $this->migrator->add('spare_parts.query_en', 'null');
        $this->migrator->add('spare_parts.answer_ru', 'null');
        $this->migrator->add('spare_parts.answer_uz', 'null');
        $this->migrator->add('spare_parts.answer_en', 'null');
    }
};
