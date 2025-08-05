<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('b2b.banner', "null");

        $this->migrator->add('b2b.title_uz', "null");
        $this->migrator->add('b2b.title_ru', "null");
        $this->migrator->add('b2b.title_en', "null");

        $this->migrator->add('b2b.subtitle_uz', "null");
        $this->migrator->add('b2b.subtitle_ru', "null");
        $this->migrator->add('b2b.subtitle_en', "null");

        $this->migrator->add('b2b.text_uz', []);
        $this->migrator->add('b2b.text_ru', []);
        $this->migrator->add('b2b.text_en', []);

        $this->migrator->add('b2b.images', []);

        $this->migrator->add('b2b.our_title_uz', "null");
        $this->migrator->add('b2b.our_title_ru', "null");
        $this->migrator->add('b2b.our_title_en', "null");

        $this->migrator->add('b2b.our_text_uz', "null");
        $this->migrator->add('b2b.our_text_ru', "null");
        $this->migrator->add('b2b.our_text_en', "null");

        $this->migrator->add('b2b.info_name_uz', "null");
        $this->migrator->add('b2b.info_name_ru', "null");
        $this->migrator->add('b2b.info_name_en', "null");

        $this->migrator->add('b2b.info_title_uz', "null");
        $this->migrator->add('b2b.info_title_ru', "null");
        $this->migrator->add('b2b.info_title_en', "null");

        $this->migrator->add('b2b.info_list_uz', []);
        $this->migrator->add('b2b.info_list_ru', []);
        $this->migrator->add('b2b.info_list_en', []);
    }
};
