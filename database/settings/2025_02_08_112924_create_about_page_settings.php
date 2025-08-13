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
        $this->migrator->add('about.about_ru', "null");
        $this->migrator->add('about.about_uz', "null");
        $this->migrator->add('about.about_en', "null");
        $this->migrator->add('about.text_ru', "null");
        $this->migrator->add('about.text_uz', "null");
        $this->migrator->add('about.text_en', "null");
        $this->migrator->add('about.banner', "");

        // Question
        $this->migrator->add('about.question_ru', "null");
        $this->migrator->add('about.question_uz', "null");
        $this->migrator->add('about.question_en', "null");

        // AisTechnoGroup
        $this->migrator->add('about.dalgakiran_ru', "null");
        $this->migrator->add('about.dalgakiran_uz', "null");
        $this->migrator->add('about.dalgakiran_en', "null");
        $this->migrator->add('about.Our_goal_ru', "null");
        $this->migrator->add('about.Our_goal_uz', "null");
        $this->migrator->add('about.Our_goal_en', "null");
        $this->migrator->add('about.text1_ru', "null");
        $this->migrator->add('about.text1_uz', "null");
        $this->migrator->add('about.text1_en', "null");
        $this->migrator->add('about.We_offer_ru', "null");
        $this->migrator->add('about.We_offer_uz', "null");
        $this->migrator->add('about.We_offer_en', "null");
        $this->migrator->add('about.text2_ru', "null");
        $this->migrator->add('about.text2_uz', "null");
        $this->migrator->add('about.text2_en', "null");
        $this->migrator->add('about.img', "");

        // OurPartners
        $this->migrator->add('about.ourPartners_ru', "null");
        $this->migrator->add('about.ourPartners_uz', "null");
        $this->migrator->add('about.ourPartners_en', "null");
        $this->migrator->add('about.text3_ru', "null");
        $this->migrator->add('about.text3_uz', "null");
        $this->migrator->add('about.text3_en', "null");
    }
};
