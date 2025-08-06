<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $settings = ['home', 'about', 'catalog', 'collection', 'b2b', 'creations', 'news', 'contacts', 'privacy'];
        foreach ($settings as $setting) {
            foreach (['uz', 'ru', 'en'] as $lang) {
                $this->migrator->add("seo.{$setting}_title_$lang", "null");
                $this->migrator->add("seo.{$setting}_description_$lang", "null");
            }
            $this->migrator->add("seo.{$setting}_img", "");
        }
    }
};
