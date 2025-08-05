<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{

    public function up(): void
    {
        // Footer title

        $this->migrator->add('general.footer_title_uz', "Biz g'oyalarni haqiqatga qo'shamiz!");
        $this->migrator->add('general.footer_title_ru', "Воплощаем идеи в реальность!");
        $this->migrator->add('general.footer_title_en', "We bring ideas to life!");

        // Mail and Phone
        $this->migrator->add('general.mail', 'info@qand.uz');
        $this->migrator->add('general.phone_top_1', '+998 97 202-20-17');
        $this->migrator->add('general.phone_top_2', '+998 88 202-20-17');
        $this->migrator->add('general.phone_footer', '+998 88 202-20-17');

        // Address
        $this->migrator->add('general.address_ru', '27, проспект Бунедкор, Чиланзарский район, Ташкент, Узбекистан');
        $this->migrator->add('general.address_en', '27, Bundekor street, Chilanzar district, Tashkent, Uzbekistan');
        $this->migrator->add('general.address_uz', "27, Bunedkor shoh ko'chasi, Chilonzor tumani, Toshkent, O'zbekiston");

        // Social Media
        $this->migrator->add('general.telegram', '');
        $this->migrator->add('general.instagram', '');
        $this->migrator->add('general.whatsapp', '');
    }
};
