<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        //Banner
        $this->migrator->add('home.banner', []);

        //Info
        $this->migrator->add('home.title2_ru', "test");
        $this->migrator->add('home.title2_uz', "test");
        $this->migrator->add('home.title2_en', "test");
        $this->migrator->add('home.subtitle2_ru', "test");
        $this->migrator->add('home.subtitle2_uz', "test");
        $this->migrator->add('home.subtitle2_en', "test");
        $this->migrator->add('home.text1_ru', "test");
        $this->migrator->add('home.text1_uz', "test");
        $this->migrator->add('home.text1_en', "test");
        $this->migrator->add('home.text2_ru', "test");
        $this->migrator->add('home.text2_uz', "test");
        $this->migrator->add('home.text2_en', "test");
        $this->migrator->add('home.text3_ru', "test");
        $this->migrator->add('home.text3_uz', "test");
        $this->migrator->add('home.text3_en', "test");
        $this->migrator->add('home.info2_ru', []);
        $this->migrator->add('home.info2_uz', []);
        $this->migrator->add('home.info2_en', []);
        $this->migrator->add('home.img', '');
        $this->migrator->add('home.img2', '');


        //Advantages


        //Companies
        $this->migrator->add('home.title3_ru', 'test');
        $this->migrator->add('home.title3_uz', 'test');
        $this->migrator->add('home.title3_en', 'test');
        $this->migrator->add('home.name1_ru', 'test');
        $this->migrator->add('home.name1_uz', 'test');
        $this->migrator->add('home.name1_en', 'test');
        $this->migrator->add('home.name2_ru', 'test');
        $this->migrator->add('home.name2_uz', 'test');
        $this->migrator->add('home.name2_en', 'test');
        $this->migrator->add('home.text5_ru', 'test');
        $this->migrator->add('home.text5_uz', 'test');
        $this->migrator->add('home.text5_en', 'test');
        $this->migrator->add('home.text6_ru', 'test');
        $this->migrator->add('home.text6_uz', 'test');
        $this->migrator->add('home.text6_en', 'test');
        $this->migrator->add('home.imagess', []);

        //cooperation
        $this->migrator->add('home.titleb_ru', 'test');
        $this->migrator->add('home.titleb_uz', 'test');
        $this->migrator->add('home.titleb_en', 'test');
        $this->migrator->add('home.images', []);

        // event
        $this->migrator->add('home.event_title_ru', 'test');
        $this->migrator->add('home.event_title_uz', 'test');
        $this->migrator->add('home.event_title_en', 'test');
    }
};
