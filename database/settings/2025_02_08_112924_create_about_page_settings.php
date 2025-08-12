<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Main title
        $this->migrator->add('about.main_title_ru', "О нас");
        $this->migrator->add('about.main_title_uz', "Biz haqimizda");
        $this->migrator->add('about.main_title_en', "About us");

        //info
        $this->migrator->add('about.title0_ru', "null");
        $this->migrator->add('about.title0_uz', "null");
        $this->migrator->add('about.title0_en', "null");
        $this->migrator->add('about.text0_ru', "null");
        $this->migrator->add('about.text0_uz', "null");
        $this->migrator->add('about.text0_en', "null");
        $this->migrator->add('about.banner', "");

        // Question
        $this->migrator->add('about.question0_ru', "null");
        $this->migrator->add('about.question0_uz', "null");
        $this->migrator->add('about.question0_en', "null");

        // AisTechnoGroup
        $this->migrator->add('about.title2_ru', "null");
        $this->migrator->add('about.title2_uz', "null");
        $this->migrator->add('about.title2_en', "null");
        $this->migrator->add('about.name1_ru', "null");
        $this->migrator->add('about.name1_uz', "null");
        $this->migrator->add('about.name1_en', "null");
        $this->migrator->add('about.text1_ru', "null");
        $this->migrator->add('about.text1_uz', "null");
        $this->migrator->add('about.text1_en', "null");
        $this->migrator->add('about.name2_ru', "null");
        $this->migrator->add('about.name2_uz', "null");
        $this->migrator->add('about.name2_en', "null");
        $this->migrator->add('about.text2_ru', "null");
        $this->migrator->add('about.text2_uz', "null");
        $this->migrator->add('about.text2_en', "null");
        $this->migrator->add('about.img', "");

        // OurPartners
        $this->migrator->add('about.title3_ru', "null");
        $this->migrator->add('about.title3_uz', "null");
        $this->migrator->add('about.title3_en', "null");
        $this->migrator->add('about.text3_ru', "null");
        $this->migrator->add('about.text3_uz', "null");
        $this->migrator->add('about.text3_en', "null");
    }
};
