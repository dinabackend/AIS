<?php

namespace App\Filament\Pages;

use App\Settings\HomePageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Support\Htmlable;

class HomePage extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.home_page_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.home_page_settings');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

    protected static string $settings = HomePageSettings::class;

    public function form(Form $form): Form
    {


        $settings = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $settings[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.Title', locale: $lang))->required()->maxLength(255),
                TextInput::make("subtitle_$lang")->label(__('form.Subtitle', locale: $lang))->required()->maxLength(255),
                Repeater::make("info_$lang")->schema([
                    TextInput::make("number")->label('number')->required(),
                    TextInput::make("text")->label(__('form.Text'))->required(),
                ])->label(__('form.Info List', locale: $lang))->columns(),
            ]);
        }

        return $form->schema([
            Section::make(__('form.Banner'))->schema([
                Repeater::make('banner')->schema([
                    Tabs::make()->schema($settings)->columnSpanFull(),
                    FileUpload::make('banner')->disk('public')->directory('banner')->required()
                ])->defaultItems(1)->columnSpanFull(),
            ])->collapsed(),
        ]);
    }
}
