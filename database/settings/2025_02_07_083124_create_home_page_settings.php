<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        //Banner
        $this->migrator->add('home.banner', []);

        //Info
        $this->migrator->add('home.title2_ru', "null");
        $this->migrator->add('home.title2_uz', "null");
        $this->migrator->add('home.title2_en', "null");
        $this->migrator->add('home.subtitle2_ru', "null");
        $this->migrator->add('home.subtitle2_uz', "null");
        $this->migrator->add('home.subtitle2_en', "null");
        $this->migrator->add('home.text1_ru', "null");
        $this->migrator->add('home.text1_uz', "null");
        $this->migrator->add('home.text1_en', "null");
        $this->migrator->add('home.text2_ru', "null");
        $this->migrator->add('home.text2_uz', "null");
        $this->migrator->add('home.text2_en', "null");
        $this->migrator->add('home.text3_ru', "null");
        $this->migrator->add('home.text3_uz', "null");
        $this->migrator->add('home.text3_en', "null");
        $this->migrator->add('home.info2_ru', []);
        $this->migrator->add('home.info2_uz', []);
        $this->migrator->add('home.info2_en', []);
        $this->migrator->add('home.img', '');
        $this->migrator->add('home.img2', '');


        //Advantages


        //Companies
        $this->migrator->add('home.title3_ru', 'null');
        $this->migrator->add('home.title3_uz', 'null');
        $this->migrator->add('home.title3_en', 'null');
        $this->migrator->add('home.name1_ru', 'null');
        $this->migrator->add('home.name1_uz', 'null');
        $this->migrator->add('home.name1_en', 'null');
        $this->migrator->add('home.name2_ru', 'null');
        $this->migrator->add('home.name2_uz', 'null');
        $this->migrator->add('home.name2_en', 'null');
        $this->migrator->add('home.text5_ru', 'null');
        $this->migrator->add('home.text5_uz', 'null');
        $this->migrator->add('home.text5_en', 'null');
        $this->migrator->add('home.text6_ru', 'null');
        $this->migrator->add('home.text6_uz', 'null');
        $this->migrator->add('home.text6_en', 'null');
        $this->migrator->add('home.imagess', []);

        //cooperation
        $this->migrator->add('home.titleb_ru', 'null');
        $this->migrator->add('home.titleb_uz', 'null');
        $this->migrator->add('home.titleb_en', 'null');
        $this->migrator->add('home.images', []);
    }
};
