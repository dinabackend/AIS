<?php

namespace App\Filament\Pages;

use App\Settings\FooterSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;

class ContactsPage extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.contacts');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.contacts');
    }

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';

    protected static string $settings = FooterSettings::class;

    protected static ?string $navigationGroup = 'Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->tabs([
                    Tabs\Tab::make("ru")
                        ->schema([
                            TextInput::make('contact_main_title_ru')->label('Main title ru')->required(),
                            TextInput::make('contact_title_ru')->label('Title ru')->required(),
                            Textarea::make('contact_subtitle_ru')->label('Subtitle ru')->required(),
                            TextInput::make('contact_text1_ru')->label('Text 1 ru')->required(),
                            TextInput::make('contact_text2_ru')->label('Text 2 ru')->required(),
                            TextInput::make('contact_text3_ru')->label('Text 3 ru')->required(),
                        ])->label('Русский'),
                    Tabs\Tab::make("uz")
                        ->schema([
                            TextInput::make('contact_main_title_uz')->label('Main title uz')->required(),
                            TextInput::make('contact_title_uz')->label('Title uz')->required(),
                            Textarea::make('contact_subtitle_uz')->label('Subtitle uz')->required(),
                            TextInput::make('contact_text1_uz')->label('Text 1 uz')->required(),
                            TextInput::make('contact_text2_uz')->label('Text 2 uz')->required(),
                            TextInput::make('contact_text3_uz')->label('Text 3 uz')->required(),
                        ])->label('O\'zbekcha'),
                    Tabs\Tab::make("en")
                        ->schema([
                            TextInput::make('contact_main_title_en')->label('Main title en')->required(),
                            TextInput::make('contact_title_en')->label('Title en')->required(),
                            Textarea::make('contact_subtitle_en')->label('Subtitle en')->required(),
                            TextInput::make('contact_text1_en')->label('Text 1 en')->required(),
                            TextInput::make('contact_text2_en')->label('Text 2 en')->required(),
                            TextInput::make('contact_text3_en')->label('Text 3 en')->required(),
                        ])->label('English'),
                ])->columnSpanFull(),
            ]);
    }
}
