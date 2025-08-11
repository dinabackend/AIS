<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{

    public function up(): void
    {
        // Main title
        $this->migrator->add('guarantee.main_ru', "Гарантия");
        $this->migrator->add('guarantee.main_uz', "Kafolat");
        $this->migrator->add('guarantee.main_en', "Guarantee");

        // Guarantee
        $this->migrator->add('guarantee.title_ru', "null");
        $this->migrator->add('guarantee.subtitle_ru', "null");
        $this->migrator->add('guarantee.title_uz', "null");
        $this->migrator->add('guarantee.subtitle_uz', "null");
        $this->migrator->add('guarantee.title_en', "null");
        $this->migrator->add('guarantee.subtitle_en', "null");
        $this->migrator->add('guarantee.repeater_ru', []);
        $this->migrator->add('guarantee.repeater_uz', []);
        $this->migrator->add('guarantee.repeater_en', []);
        $this->migrator->add('guarantee.banner', "");


        $this->migrator->add('guarantee.question_ru', "null");
        $this->migrator->add('guarantee.question_list_ru', []);
        $this->migrator->add('guarantee.question_uz', "null");
        $this->migrator->add('guarantee.question_list_uz', []);
        $this->migrator->add('guarantee.question_en', "null");
        $this->migrator->add('guarantee.question_list_en', []);

        $this->migrator->add('guarantee.defect_title_ru', "null");
        $this->migrator->add('guarantee.defect_list_ru', []);
        $this->migrator->add('guarantee.defect_question_ru', "null");
        $this->migrator->add('guarantee.defect_title_uz', "null");
        $this->migrator->add('guarantee.defect_list_uz', []);
        $this->migrator->add('guarantee.defect_question_uz', "null");
        $this->migrator->add('guarantee.defect_title_en', "null");
        $this->migrator->add('guarantee.defect_list_en', []);
        $this->migrator->add('guarantee.defect_question_en', "null");

    }
};
