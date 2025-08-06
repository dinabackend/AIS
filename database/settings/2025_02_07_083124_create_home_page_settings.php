<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Home Page Title
        $this->migrator->add('home.title_uz', "");
        $this->migrator->add('home.title_ru', "");
        $this->migrator->add('home.title_en', "");

        // Upcoming Banner
        $this->migrator->add('home.upcoming_banner', []);

        // About Numbers
        $this->migrator->add('home.about_numbers_uz', []);
        $this->migrator->add('home.about_numbers_ru', []);
        $this->migrator->add('home.about_numbers_en', []);

        // About Title
        $this->migrator->add('home.about_title_uz', "Mukofot mahsulotidagi etakchi");
        $this->migrator->add('home.about_title_ru', "Лидер на рынке наградной продукции");
        $this->migrator->add('home.about_title_en', "The leader in the award product");

        // About Text
        $this->migrator->add('home.about_text_ru', "Наша компания была основана в 2017 году и за 8 лет успешной работы мы стали лидерами в СНГ. Мы работаем с индивидуальным подходом к каждому клиенту, предоставляя продукцию высокого качества и сервис на высшем уровне.");
        $this->migrator->add('home.about_text_en', "Our company was founded in 2017 and has been successful in the region for over 8 years. We work with an individual approach to each client, offering high-quality products and excellent service at the highest level.");
        $this->migrator->add('home.about_text_uz', "Bizni 2017 yil va 8 yillik muvaffaqiyatli ishlaganimizda, MDHda etakchi bo'lgan edik. Biz har bir mijozga individual yondoshish bilan ishlaymiz, yuqori sifatli mahsulotlarni etkazib beramiz");

        // Team Title
        $this->migrator->add('home.team_title_ru', "Знакомьтесь с нашей командой");
        $this->migrator->add('home.team_title_en', "Meet our team");
        $this->migrator->add('home.team_title_uz', "Jamoamiz bilan tanishing");

        // Collection Title
        $this->migrator->add('home.collection_title_ru', "Коллекции наград");
        $this->migrator->add('home.collection_title_en', "Awards Collection");
        $this->migrator->add('home.collection_title_uz', "Наград коллекция");

        // Collection Text
        $this->migrator->add('home.collection_text_uz', "");
        $this->migrator->add('home.collection_text_ru', "");
        $this->migrator->add('home.collection_text_en', "");

        // Collection Images
        $this->migrator->add('home.collection_images', []);

        // Events Title
        $this->migrator->add('home.events_title_ru', "Мероприятия с apple Modern Forms");
        $this->migrator->add('home.events_title_en', "Events with Modern Forms");
        $this->migrator->add('home.events_title_uz', "Modern Forms bilan tadbirlar");


        $this->migrator->add('home.preorder_ru', "Мероприятия с apple Modern Forms");
        $this->migrator->add('home.preorder_en', "Events with Modern Forms");
        $this->migrator->add('home.preorder_uz', "Modern Forms bilan tadbirlar");

    }
};
