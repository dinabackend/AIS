<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // About Title
        $this->migrator->add('about.title_uz', "");
        $this->migrator->add('about.title_ru', "");
        $this->migrator->add('about.title_en', "");

        // About Text
        $this->migrator->add('about.text_uz', "Biz mukofot mahsulotlari, shu jumladan medallar, kuboklar, rasmlar va chempion kamarlari ishlab chiqarishga ixtisoslashganmiz. Har bir mahsulot eng talabchan mijozlarning ehtiyojlarini qondirib, tafsilotlarga yuqori sifat va e'tiborni o'z ichiga oladi.");
        $this->migrator->add('about.text_ru', "Мы специализируемся на производстве наградной продукции, включая медали, кубки, статуэтки и чемпионские пояса. Каждое изделие воплощает в себе высокое качество и внимание к деталям, удовлетворяя потребности самых требовательных клиентов.");
        $this->migrator->add('about.text_en', "We specialize in the production of award products, including medals, cups, figurines and champion belts. Each product embodies high quality and attention to details, satisfying the needs of the most demanding customers.");

        // About Advantages
        $this->migrator->add('about.advantages_title_uz', "Bizning afzalliklarimiz:");
        $this->migrator->add('about.advantages_title_ru', "Наши преимущества:");
        $this->migrator->add('about.advantages_title_en', "Our advantages:");

        $this->migrator->add('about.advantages_text_uz', []);
        $this->migrator->add('about.advantages_text_ru', []);
        $this->migrator->add('about.advantages_text_en', []);

        // Company Numbers
        $this->migrator->add('about.company_numbers_title_uz', "Kompaniya raqamlarda:");
        $this->migrator->add('about.company_numbers_title_ru', "Компания в цифрах:");
        $this->migrator->add('about.company_numbers_title_en', "The company in numbers:");

        $this->migrator->add('about.company_numbers_text_uz', []);
        $this->migrator->add('about.company_numbers_text_ru', []);
        $this->migrator->add('about.company_numbers_text_en', []);

        // About Subtext
        $this->migrator->add('about.subtext_uz', "Biz tajribamizdan faxrlanamiz va mukammallikka intilyapmiz, mijozlarimizni faqat eng yaxshi deb ta'minlaymiz.");
        $this->migrator->add('about.subtext_ru', "Мы гордимся своим опытом и стремимся к совершенству, предоставляя нашим клиентам только лучшее. ");
        $this->migrator->add('about.subtext_en', "We are proud of our experience and strive to improve, providing our customers with only the best. ");
    }
};
