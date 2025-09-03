<?php

namespace App\Filament\Pages;

use App\Settings\SparePartsPageSettings;
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

class SparePartsPage extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.SparePartsPage');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.SparePartsPage');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('panel.settings');
    }
    protected static ?string $navigationIcon = 'heroicon-o-cog';

    protected static string $settings = SparePartsPageSettings::class;

    public function form(Form $form): Form
    {
        $main_titles = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $main_titles[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("main_title_$lang")->label(__('form.main', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $catalog = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $catalog[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("SparePartsCatalog_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                Textarea::make("text_$lang")->label(__('form.text', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $PM_Series = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $PM_Series[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("PM_Series_$lang")->label(__('form.title2', locale: $lang))->required()->maxLength(255),
                Textarea::make("text2_$lang")->label(__('form.text2', locale: $lang))->required(),
                Repeater::make("DALGAKIRAN_$lang")->schema([
                    TextInput::make("title")->label(__('form.number'))->required(),
                    TextInput::make("text")->label(__('form.text'))->required(),
                ])->label(__('form.items'))->columns(),
            ]);
        }

        $query = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $query[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("query_$lang")->label(__('form.query', locale: $lang))->required()->maxLength(255),
                TextInput::make("answer_$lang")->label(__('form.answer', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $recommended_products = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $recommended_products[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("text4_$lang")->label(__('form.text', locale: $lang))->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Section::make(__('form.main'))->schema([
                    Tabs::make()->schema($main_titles)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.SparePartsCatalog'))->schema([
                    Tabs::make()->schema($catalog)->columnSpanFull(),
            ])->collapsed(),

            Section::make('PM_Series')->schema([
                    Tabs::make()->schema($PM_Series)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.query'))->schema([
                Tabs::make()->schema($query)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.recommended_products'))->schema([
                Tabs::make()->schema($recommended_products)->columnSpanFull(),
            ])->collapsed(),
        ]);
    }
}
