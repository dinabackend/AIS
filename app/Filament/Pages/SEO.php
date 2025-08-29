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
        $pages = ['home', 'about', 'catalog', 'category', 'product', 'events', 'contacts', 'privacy'];
        $schema = [];
        foreach ($pages as $page) {
            $schema[] = Tabs\Tab::make(__("form.$page"))->schema([
                TextInput::make("{$page}_title_uz")->label("{$page} Title uz"),
                Textarea::make("{$page}_description_uz")->label("{$page} Description uz"),
                TextInput::make("{$page}_title_ru")->label("{$page} Title ru"),
                Textarea::make("{$page}_description_ru")->label("{$page} Description ru"),
                TextInput::make("{$page}_title_en")->label("{$page} Title en"),
                Textarea::make("{$page}_description_en")->label("{$page} Description en"),
                FileUpload::make("{$page}_img")->label(__('form.image'))->default("/img/default.img")
            ]);
        }

        return $form->schema([

            Tabs::make()->schema($schema)->columnSpanFull(),
        ]);
    }
}
