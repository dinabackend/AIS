<?php

namespace App\Filament\Pages;

use App\Settings\AboutSettings;
use App\Settings\ServiceSettings;
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

class ServicePage extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.service_page_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.service_page_settings');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-wrench';

    protected static string $settings = ServiceSettings::class;

    public function form(Form $form): Form
    {
        $main_title = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $main_title[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("main_title_$lang")->label(__('form.main', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $engineers = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $engineers[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                Textarea::make("subtitle_$lang")->label(__('form.subtitle', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $service = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $service[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("service_title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("service_subtitle_$lang")->label(__('form.subtitle', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $repair= [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $repair[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("repair_title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("description_$lang")->label(__('form.description', locale: $lang))->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Section::make(__('form.main'))->schema([
                Tabs::make()->schema($main_title)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.engineers'))->schema([
                Tabs::make()->schema($engineers)->columnSpanFull(),
                FileUpload::make('banner')->disk('public')->directory('img')->required()
            ])->collapsed(),

            Section::make(__('form.services'))->schema([
                Tabs::make()->schema($service)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.repair'))->schema([
                Repeater::make('repair')->schema([
                    Tabs::make()->schema($repair)->columnSpanFull(),
                    FileUpload::make('img')->label(__('form.img'))->disk('public')->directory('img')->required()
                ])->defaultItems(1)->columnSpanFull(),
            ])->collapsed(),

        ]);
    }
}
