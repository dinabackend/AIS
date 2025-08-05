<?php

namespace App\Filament\Pages;

use App\Settings\HomePageSettings;
use App\Settings\PolicySettings;
use App\Settings\SeoPageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Support\Htmlable;

class Policy extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.policy');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.policy');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-shield-exclamation';

    protected static string $settings = PolicySettings::class;

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make()->schema([
                Tabs\Tab::make("O'zbekcha")->schema([
                    RichEditor::make('content_uz')->required()
                ]),
                Tabs\Tab::make("Русский")->schema([
                    RichEditor::make('content_ru')->required()
                ]),
                Tabs\Tab::make("English")->schema([
                    RichEditor::make('content_en')->required()
                ]),
            ])->columnSpanFull(),
        ]);
    }
}
