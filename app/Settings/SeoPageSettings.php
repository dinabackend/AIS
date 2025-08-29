<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class SeoPageSettings extends Settings
{

    public string $home_title_uz;
    public string $home_description_uz;
    public ?string $home_img;
    public string $home_title_ru;
    public string $home_description_ru;
    public string $home_title_en;
    public string $home_description_en;

    public string $about_title_uz;
    public string $about_description_uz;
    public ?string $about_img;
    public string $about_title_ru;
    public string $about_description_ru;
    public string $about_title_en;
    public string $about_description_en;

    public string $catalog_title_uz;
    public string $catalog_description_uz;
    public ?string $catalog_img;
    public string $catalog_title_ru;
    public string $catalog_description_ru;
    public string $catalog_title_en;
    public string $catalog_description_en;

    public string $category_title_uz;
    public string $category_description_uz;
    public ?string $category_img;
    public string $category_title_ru;
    public string $category_description_ru;
    public string $category_title_en;
    public string $category_description_en;

    public string $product_title_uz;
    public string $product_description_uz;
    public ?string $product_img;
    public string $product_title_ru;
    public string $product_description_ru;
    public string $product_title_en;
    public string $product_description_en;

    public string $collection_title_uz;
    public string $collection_description_uz;
    public ?string $collection_img;
    public string $collection_title_ru;
    public string $collection_description_ru;
    public string $collection_title_en;
    public string $collection_description_en;

    public string $b2b_title_uz;
    public string $b2b_description_uz;
    public ?string $b2b_img;
    public string $b2b_title_ru;
    public string $b2b_description_ru;
    public string $b2b_title_en;
    public string $b2b_description_en;

    public string $creations_title_uz;
    public string $creations_description_uz;
    public ?string $creations_img;
    public string $creations_title_ru;
    public string $creations_description_ru;
    public string $creations_title_en;
    public string $creations_description_en;

    public string $news_title_uz;
    public string $news_description_uz;
    public ?string $news_img;
    public string $news_title_ru;
    public string $news_description_ru;
    public string $news_title_en;
    public string $news_description_en;

    public string $contacts_title_uz;
    public string $contacts_description_uz;
    public ?string $contacts_img;
    public string $contacts_title_ru;
    public string $contacts_description_ru;
    public string $contacts_title_en;
    public string $contacts_description_en;

    public ?string $privacy_title_uz;
    public ?string $privacy_description_uz;
    public ?string $privacy_img;
    public ?string $privacy_title_ru;
    public ?string $privacy_description_ru;
    public ?string $privacy_title_en;
    public ?string $privacy_description_en;

    public static function group(): string
    {
        return 'seo';
    }

}
