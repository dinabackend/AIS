<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class ButtonsSettings extends Settings
{
    public string $nav_form_text_ru;
    public string $nav_form_text_uz;
    public string $nav_form_text_en;
    public string $nav_form_link;
    public string $about_link_text_ru;
    public string $about_link_text_uz;
    public string $about_link_text_en;
    public string $about_link_link;
    public string $info_link_text_ru;
    public string $info_link_text_uz;
    public string $info_link_text_en;
    public string $info_link_link;
    public string $info_contact_text_ru;
    public string $info_contact_text_uz;
    public string $info_contact_text_en;
    public string $info_contact_link;
    public string $company_link_text_ru;
    public string $company_link_text_uz;
    public string $company_link_text_en;
    public string $company_link_link;
    public string $catalog_link_text_ru;
    public string $catalog_link_text_uz;
    public string $catalog_link_text_en;
    public string $catalog_link_link;
    public string $collection_link_text_ru;
    public string $collection_link_text_uz;
    public string $collection_link_text_en;
    public string $collection_link_link;
    public string $news_link_text_ru;
    public string $news_link_text_uz;
    public string $news_link_text_en;
    public string $news_link_link;

    public string $telegram_text_ru;
    public string $telegram_text_uz;
    public string $telegram_text_en;
    public string $telegram_link;
    public string $contacts_link_text_ru;
    public string $contacts_link_text_uz;
    public string $contacts_link_text_en;
    public string $contacts_link_link;
    public string $privacy_link_text_ru;
    public string $privacy_link_text_uz;
    public string $privacy_link_text_en;
    public string $privacy_link_link;
    public string $footer_form_link_text_ru;
    public string $footer_form_link_text_uz;
    public string $footer_form_link_text_en;
    public string $footer_form_link_link;
    public string $footer_catalog_link_text_ru;
    public string $footer_catalog_link_text_uz;
    public string $footer_catalog_link_text_en;
    public string $footer_catalog_link_link;

    public static function group(): string
    {
        return 'button';
    }

}
