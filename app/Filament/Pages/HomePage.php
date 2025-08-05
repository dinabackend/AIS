<?php

namespace App\Filament\Pages;

use App\Settings\HomePageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Support\Htmlable;

class HomePage extends SettingsPage
{
    public function getTitle(): string | Htmlable
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
        return $form->schema([
            Repeater::make('upcoming_banner')->schema([
                Tabs::make()->schema([
                    Tabs\Tab::make("O'zbekcha")->schema([
                        TextInput::make('title_uz')->required()
                    ]),
                    Tabs\Tab::make("Русский")->schema([
                        TextInput::make('title_ru')->required()
                    ]),
                    Tabs\Tab::make("English")->schema([
                        TextInput::make('title_en')->required()
                    ]),
                ])->columnSpanFull(),
                FileUpload::make('banner')
                    ->disk('public')
                    ->directory('banner')
                    ->required()
            ])->columnSpanFull(),

            Tabs::make('preorder')->schema([
                Tabs\Tab::make("O'zbekcha")->schema([
                    TextInput::make('preorder_uz')->required()
                ]),
                Tabs\Tab::make("Русский")->schema([
                    TextInput::make('preorder_ru')->required()
                ]),
                Tabs\Tab::make("English")->schema([
                    TextInput::make('preorder_en')->required()
                ]),
            ])->columnSpanFull(),
        ]);
    }
}
