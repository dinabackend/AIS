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
        $this->migrator->add('about.about_ru', "test");
        $this->migrator->add('about.about_uz', "test");
        $this->migrator->add('about.about_en', "test");
        $this->migrator->add('about.text_ru', "test");
        $this->migrator->add('about.text_uz', "test");
        $this->migrator->add('about.text_en', "test");
        $this->migrator->add('about.banner_ru', "");
        $this->migrator->add('about.banner_uz', "");
        $this->migrator->add('about.banner_en', "");

        // Question
        $this->migrator->add('about.question_ru', "test");
        $this->migrator->add('about.question_uz', "test");
        $this->migrator->add('about.question_en', "test");

        // Information
        $this->migrator->add('about.information', []);

        // AisTechnoGroup
        $this->migrator->add('about.dalgakiran_ru', "test");
        $this->migrator->add('about.dalgakiran_uz', "test");
        $this->migrator->add('about.dalgakiran_en', "test");
        $this->migrator->add('about.Our_goal_ru', "test");
        $this->migrator->add('about.Our_goal_uz', "test");
        $this->migrator->add('about.Our_goal_en', "test");
        $this->migrator->add('about.text1_ru', "test");
        $this->migrator->add('about.text1_uz', "test");
        $this->migrator->add('about.text1_en', "test");
        $this->migrator->add('about.We_offer_ru', "test");
        $this->migrator->add('about.We_offer_uz', "test");
        $this->migrator->add('about.We_offer_en', "test");
        $this->migrator->add('about.text2_ru', "test");
        $this->migrator->add('about.text2_uz', "test");
        $this->migrator->add('about.text2_en', "test");
        $this->migrator->add('about.img', "");

        // OurPartners
        $this->migrator->add('about.ourPartners_ru', "test");
        $this->migrator->add('about.ourPartners_uz', "test");
        $this->migrator->add('about.ourPartners_en', "test");
        $this->migrator->add('about.text3_ru', "test");
        $this->migrator->add('about.text3_uz', "test");
        $this->migrator->add('about.text3_en', "test");
        $this->migrator->add('about.images', []);
    }
};
