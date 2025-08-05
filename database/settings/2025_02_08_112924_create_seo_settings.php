<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Home
        $this->migrator->add('seo.home_title_uz', "null");
        $this->migrator->add('seo.home_description_uz', "null");
        $this->migrator->add('seo.home_title_ru', "null");
        $this->migrator->add('seo.home_description_ru', "null");
        $this->migrator->add('seo.home_title_en', "null");
        $this->migrator->add('seo.home_description_en', "null");
        $this->migrator->add('seo.home_img', "");
        // About
        $this->migrator->add('seo.about_title_uz', "null");
        $this->migrator->add('seo.about_description_uz', "null");
        $this->migrator->add('seo.about_title_ru', "null");
        $this->migrator->add('seo.about_description_ru', "null");
        $this->migrator->add('seo.about_title_en', "null");
        $this->migrator->add('seo.about_description_en', "null");
        $this->migrator->add('seo.about_img', "");
        // Catalog
        $this->migrator->add('seo.catalog_title_uz', "null");
        $this->migrator->add('seo.catalog_description_uz', "null");
        $this->migrator->add('seo.catalog_title_ru', "null");
        $this->migrator->add('seo.catalog_description_ru', "null");
        $this->migrator->add('seo.catalog_title_en', "null");
        $this->migrator->add('seo.catalog_description_en', "null");
        $this->migrator->add('seo.catalog_img', "");
        // Collection
        $this->migrator->add('seo.collection_title_uz', "null");
        $this->migrator->add('seo.collection_description_uz', "null");
        $this->migrator->add('seo.collection_title_ru', "null");
        $this->migrator->add('seo.collection_description_ru', "null");
        $this->migrator->add('seo.collection_title_en', "null");
        $this->migrator->add('seo.collection_description_en', "null");
        $this->migrator->add('seo.collection_img', "");
        // B2B
        $this->migrator->add('seo.b2b_title_uz', "null");
        $this->migrator->add('seo.b2b_description_uz', "null");
        $this->migrator->add('seo.b2b_title_ru', "null");
        $this->migrator->add('seo.b2b_description_ru', "null");
        $this->migrator->add('seo.b2b_title_en', "null");
        $this->migrator->add('seo.b2b_description_en', "null");
        $this->migrator->add('seo.b2b_img', "");
        // Creations
        $this->migrator->add('seo.creations_title_uz', "null");
        $this->migrator->add('seo.creations_description_uz', "null");
        $this->migrator->add('seo.creations_title_ru', "null");
        $this->migrator->add('seo.creations_description_ru', "null");
        $this->migrator->add('seo.creations_title_en', "null");
        $this->migrator->add('seo.creations_description_en', "null");
        $this->migrator->add('seo.creations_img', "");
        // Events
        $this->migrator->add('seo.news_title_uz', "null");
        $this->migrator->add('seo.news_description_uz', "null");
        $this->migrator->add('seo.news_title_ru', "null");
        $this->migrator->add('seo.news_description_ru', "null");
        $this->migrator->add('seo.news_title_en', "null");
        $this->migrator->add('seo.news_description_en', "null");
        $this->migrator->add('seo.news_img', "");
        // Contacts
        $this->migrator->add('seo.contacts_title_uz', "null");
        $this->migrator->add('seo.contacts_description_uz', "null");
        $this->migrator->add('seo.contacts_title_ru', "null");
        $this->migrator->add('seo.contacts_description_ru', "null");
        $this->migrator->add('seo.contacts_title_en', "null");
        $this->migrator->add('seo.contacts_description_en', "null");
        $this->migrator->add('seo.contacts_img', "");
        // Privacy
        $this->migrator->add('seo.privacy_title_uz', "null");
        $this->migrator->add('seo.privacy_description_uz', "null");
        $this->migrator->add('seo.privacy_title_ru', "null");
        $this->migrator->add('seo.privacy_description_ru', "null");
        $this->migrator->add('seo.privacy_title_en', "null");
        $this->migrator->add('seo.privacy_description_en', "null");
        $this->migrator->add('seo.privacy_img', "");
    }
};
