<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Variant extends TranslatableModel implements HasMedia
{
    use Translatable, InteractsWithMedia;

    protected $fillable = [
        'name',
        'description',
        'advantages',
        'seo_title',
        'seo_description',
        'product_id',
        'status',
        'img'
    ];

    /** @noinspection PhpUnused */
    public array $translatedAttributes = [
        'name',
        'description',
        'advantages',
        'seo_title',
        'seo_description'
    ];

    public function characteristics()
    {
        return $this->morphMany(Characteristic::class, 'characteristicable');
    }
    public function sections()
    {
        return $this->morphMany(Section::class, 'sectionable');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('product_image')
            ->acceptsMimeTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
            ->singleFile();

        $this->addMediaCollection('product_video')
            ->acceptsMimeTypes(['video/mp4', 'video/avi', 'video/mov'])
            ->singleFile();

        $this->addMediaCollection('product_sheet_ru')
            ->acceptsMimeTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
            ->singleFile();

        $this->addMediaCollection('product_sheet_uz')
            ->acceptsMimeTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
            ->singleFile();

        $this->addMediaCollection('product_sheet_en')
            ->acceptsMimeTypes(['application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.ms-excel'])
            ->singleFile();
    }
}
