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

class ManageFooter extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.footer_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.footer_settings');
    }

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = FooterSettings::class;

    public static function getNavigationGroup(): ?string
    {
        return __('panel.settings');
    }
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Footer
                Tabs::make()->tabs([
                    Tabs\Tab::make("Русский")
                        ->schema([
                            TextInput::make('title_ru')->label('Title ru')->required()->columnSpanFull(),
                            Textarea::make('text_ru')->label('Text ru')->required()->columnSpanFull(),
                            TextInput::make('address_ru')->label('Адрес')->required(),
                            TextInput::make('left_text_ru')->label('Left text ru')->required()->columnSpanFull(),
                            TextInput::make('right_text_ru')->label('Right text ru')->required()->columnSpanFull(),
                        ]),
                    Tabs\Tab::make("O'zbekcha")
                        ->schema([
                            TextInput::make('title_uz')->label('Title uz')->required()->columnSpanFull(),
                            Textarea::make('text_uz')->label('Text uz')->required()->columnSpanFull(),
                            TextInput::make('address_uz')->label('Manzil')->required(),
                            TextInput::make('left_text_uz')->label('Left text uz')->required()->columnSpanFull(),
                            TextInput::make('right_text_uz')->label('Right text uz')->required()->columnSpanFull(),
                        ]),
                    Tabs\Tab::make("English")
                        ->schema([
                            TextInput::make('title_en')->label('Title en')->required()->columnSpanFull(),
                            Textarea::make('text_en')->label('Text en')->required()->columnSpanFull(),
                            TextInput::make('address_en')->label('Address')->required(),
                            TextInput::make('left_text_en')->label('Left text en')->required()->columnSpanFull(),
                            TextInput::make('right_text_en')->label('Right text en')->required()->columnSpanFull(),
                        ]),
                ])->columnSpanFull(),

                Section::make('Socials')->schema([
                    TextInput::make('telegram')->label('Telegram Link')->required(),
                    TextInput::make('instagram')->label('Instagram Link')->required(),
                    TextInput::make('linkedin')->label('LinkedIn Link')->required(),
                    TextInput::make('facebook')->label('Facebook Link')->required(),
                ])->collapsed()->columns(2),

                Section::make('Contacts')->schema([
                    TextInput::make('mail1')->label('Mail Address')->required(),
                    TextInput::make('mail2')->label('Mail Address')->required(),
                    TextInput::make('phone')->label('Phone')->required(),
                ])->collapsed(),
            ]);
    }
}
