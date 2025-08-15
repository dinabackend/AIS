<?php

namespace App\Filament\Pages;

use App\Settings\RentPageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Support\Htmlable;

class RentPage extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.rent_page_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.rent_page_settings');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static string $settings = RentPageSettings::class;

    public function form(Form $form): Form
    {
        $main_titles = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $main_titles[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("main_title_$lang")->label(__('form.main', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $rents = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $rents[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                Textarea::make("text_$lang")->label(__('form.text', locale: $lang))->required()->maxLength(255),
                TextInput::make("category_text_$lang")->label(__('form.category_text', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $reviews = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $reviews[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("reviews_title_$lang")->label(__('form.reviews_title', locale: $lang))->required()->maxLength(255),
            ]);
        }
        $recommended_products = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $recommended_products[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("products_title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("products_text_$lang")->label(__('form.text', locale: $lang))->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Section::make(__('form.main'))->schema([
                    Tabs::make()->schema($main_titles)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.rents'))->schema([
                Repeater::make('rents')->schema([
                    Tabs::make()->schema($rents)->columnSpanFull(),
                    FileUpload::make('img')->label(__('form.img'))->disk('public')->directory('banner')->required()
                ])->defaultItems(1)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.reviews_title'))->schema([
                    Tabs::make()->schema($reviews)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.recommended_products'))->schema([
                    Tabs::make()->schema($recommended_products)->columnSpanFull(),
            ])->collapsed(),
        ]);
    }
}
