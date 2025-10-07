<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $settings = ['home', 'about', 'catalog', 'category', 'product', 'events', 'contacts', 'privacy', 'guaranty', 'parts', 'rent', 'engineering'];
        foreach ($settings as $setting) {
            foreach (['uz', 'ru', 'en'] as $lang) {
                $this->migrator->add("seo.{$setting}_title_$lang", "null");
                $this->migrator->add("seo.{$setting}_description_$lang", "null");
            }
            $this->migrator->add("seo.{$setting}_img", "");
        }
    }
};
