<?php

namespace App\Filament\Pages;

use App\Settings\SeoPageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Support\Htmlable;

class SEO extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.seo_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.seo_settings');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-presentation-chart-bar';

    protected static string $settings = SeoPageSettings::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make()->schema([
                Tabs\Tab::make(__('form.home'))->schema([
                    TextInput::make('home_title_uz'      )->label("Title uz"),
                    Textarea::make( 'home_description_uz')->label("Description uz"),
                    TextInput::make('home_title_ru'      )->label("Title ru"),
                    Textarea::make( 'home_description_ru')->label("Description ru"),
                    TextInput::make('home_title_en'      )->label("Title en"),
                    Textarea::make( 'home_description_en')->label("Description en"),
                    FileUpload::make('home_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.about'))->schema([
                    TextInput::make('about_title_uz'      )->label("Title uz"),
                    Textarea::make( 'about_description_uz')->label("Description uz"),
                    TextInput::make('about_title_ru'      )->label("Title ru"),
                    Textarea::make( 'about_description_ru')->label("Description ru"),
                    TextInput::make('about_title_en'      )->label("Title en"),
                    Textarea::make( 'about_description_en')->label("Description en"),
                    FileUpload::make('about_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.catalog'))->schema([
                    TextInput::make('catalog_title_uz'      )->label("Title uz"),
                    Textarea::make( 'catalog_description_uz')->label("Description uz"),
                    TextInput::make('catalog_title_ru'      )->label("Title ru"),
                    Textarea::make( 'catalog_description_ru')->label("Description ru"),
                    TextInput::make('catalog_title_en'      )->label("Title en"),
                    Textarea::make( 'catalog_description_en')->label("Description en"),
                    FileUpload::make('catalog_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.collections'))->schema([
                    TextInput::make('collection_title_uz'      )->label("Title uz"),
                    Textarea::make( 'collection_description_uz')->label("Description uz"),
                    TextInput::make('collection_title_ru'      )->label("Title ru"),
                    Textarea::make( 'collection_description_ru')->label("Description ru"),
                    TextInput::make('collection_title_en'      )->label("Title en"),
                    Textarea::make( 'collection_description_en')->label("Description en"),
                    FileUpload::make('collection_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.b2b'))->schema([
                    TextInput::make('b2b_title_uz'      )->label("Title uz"),
                    Textarea::make( 'b2b_description_uz')->label("Description uz"),
                    TextInput::make('b2b_title_ru'      )->label("Title ru"),
                    Textarea::make( 'b2b_description_ru')->label("Description ru"),
                    TextInput::make('b2b_title_en'      )->label("Title en"),
                    Textarea::make( 'b2b_description_en')->label("Description en"),
                    FileUpload::make('b2b_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.creations'))->schema([
                    TextInput::make('creations_title_uz'      )->label("Title uz"),
                    Textarea::make( 'creations_description_uz')->label("Description uz"),
                    TextInput::make('creations_title_ru'      )->label("Title ru"),
                    Textarea::make( 'creations_description_ru')->label("Description ru"),
                    TextInput::make('creations_title_en'      )->label("Title en"),
                    Textarea::make( 'creations_description_en')->label("Description en"),
                    FileUpload::make('creations_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.events'))->schema([
                    TextInput::make('news_title_uz'      )->label("Title uz"),
                    Textarea::make( 'news_description_uz')->label("Description uz"),
                    TextInput::make('news_title_ru'      )->label("Title ru"),
                    Textarea::make( 'news_description_ru')->label("Description ru"),
                    TextInput::make('news_title_en'      )->label("Title en"),
                    Textarea::make( 'news_description_en')->label("Description en"),
                    FileUpload::make('news_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.contacts'))->schema([
                    TextInput::make('contacts_title_uz'      )->label("Title uz"),
                    Textarea::make( 'contacts_description_uz')->label("Description uz"),
                    TextInput::make('contacts_title_ru'      )->label("Title ru"),
                    Textarea::make( 'contacts_description_ru')->label("Description ru"),
                    TextInput::make('contacts_title_en'      )->label("Title en"),
                    Textarea::make( 'contacts_description_en')->label("Description en"),
                    FileUpload::make('contacts_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
                Tabs\Tab::make(__('form.privacy'))->schema([
                    TextInput::make('privacy_title_uz'      )->label("Title uz"),
                    Textarea::make( 'privacy_description_uz')->label("Description uz"),
                    TextInput::make('privacy_title_ru'      )->label("Title ru"),
                    Textarea::make( 'privacy_description_ru')->label("Description ru"),
                    TextInput::make('privacy_title_en'      )->label("Title en"),
                    Textarea::make( 'privacy_description_en')->label("Description en"),
                    FileUpload::make('privacy_img')->label(__('form.image'))->default("/img/default.img"),
                ]),
            ])->columnSpanFull(),
        ]);
    }
}
