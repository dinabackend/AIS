<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $buttons = [
            'nav_form',
            'about_link',
            'info_link',
            'info_contact',
            'company_link',
            'catalog_link',
            'collection_link',
            'news_link',
            'contacts_link',
            'privacy_link',
            'footer_form_link',
            'footer_catalog_link',
            'telegram'
        ];
        foreach ($buttons as $button) {
            $this->migrator->add("button.{$button}_text_ru", "null");
            $this->migrator->add("button.{$button}_text_uz", "null");
            $this->migrator->add("button.{$button}_text_en", "null");
            $this->migrator->add("button.{$button}_link", "null");
        }
    }
};
