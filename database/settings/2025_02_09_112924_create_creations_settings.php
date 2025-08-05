<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('creations.banner', "null");

        $this->migrator->add('creations.title_uz', "null");
        $this->migrator->add('creations.title_ru', "null");
        $this->migrator->add('creations.title_en', "null");

        $this->migrator->add('creations.subtitle_uz', "null");
        $this->migrator->add('creations.subtitle_ru', "null");
        $this->migrator->add('creations.subtitle_en', "null");

        $this->migrator->add('creations.text_uz', []);
        $this->migrator->add('creations.text_ru', []);
        $this->migrator->add('creations.text_en', []);

        $this->migrator->add('creations.images', []);

        $this->migrator->add('creations.our_title_uz', "null");
        $this->migrator->add('creations.our_title_ru', "null");
        $this->migrator->add('creations.our_title_en', "null");

        $this->migrator->add('creations.our_text_uz', "null");
        $this->migrator->add('creations.our_text_ru', "null");
        $this->migrator->add('creations.our_text_en', "null");

        $this->migrator->add('creations.info_name_uz', "null");
        $this->migrator->add('creations.info_name_ru', "null");
        $this->migrator->add('creations.info_name_en', "null");

        $this->migrator->add('creations.info_title_uz', "null");
        $this->migrator->add('creations.info_title_ru', "null");
        $this->migrator->add('creations.info_title_en', "null");

        $this->migrator->add('creations.info_list_uz', []);
        $this->migrator->add('creations.info_list_ru', []);
        $this->migrator->add('creations.info_list_en', []);
    }
};
