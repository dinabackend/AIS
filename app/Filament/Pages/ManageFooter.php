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

    protected static ?string $navigationGroup = 'Settings';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                //footer img
                FileUpload::make('img')->label('Logo'),
                // Footer
                Tabs::make()->tabs([
                    Tabs\Tab::make("O'zbekcha")
                        ->schema([
                            TextInput::make('title_uz')->label('Title uz')->required()->columnSpanFull(),
                            Textarea::make('text_uz')->label('Text uz')->required()->columnSpanFull(),
                            TextInput::make('address_uz')->label('Manzil')->required(),
                            TextInput::make('left_text_uz')->label('Left text uz')->required()->columnSpanFull(),
                            TextInput::make('right_text_uz')->label('Right text uz')->required()->columnSpanFull(),
                        ]),
                    Tabs\Tab::make("Русский")
                        ->schema([
                            TextInput::make('title_ru')->label('Title ru')->required()->columnSpanFull(),
                            Textarea::make('text_ru')->label('Text ru')->required()->columnSpanFull(),
                            TextInput::make('address_ru')->label('Адрес')->required(),
                            TextInput::make('left_text_ru')->label('Left text ru')->required()->columnSpanFull(),
                            TextInput::make('right_text_ru')->label('Right text ru')->required()->columnSpanFull(),
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

                Section::make('Contact Page')->schema([
                    Tabs::make()->tabs([
                        Tabs\Tab::make("uz")
                            ->schema([
                                TextInput::make('contact_main_title_uz')->label('Main title uz')->required(),
                                TextInput::make('contact_title_uz')->label('Title uz')->required(),
                                Textarea::make('contact_subtitle_uz')->label('Subtitle uz')->required(),
                                TextInput::make('contact_text1_uz')->label('Text 1 uz')->required(),
                                TextInput::make('contact_text2_uz')->label('Text 2 uz')->required(),
                                TextInput::make('contact_text3_uz')->label('Text 3 uz')->required(),
                            ]),
                        Tabs\Tab::make("ru")
                            ->schema([
                                TextInput::make('contact_main_title_ru')->label('Main title ru')->required(),
                                TextInput::make('contact_title_ru')->label('Title ru')->required(),
                                Textarea::make('contact_subtitle_ru')->label('Subtitle ru')->required(),
                                TextInput::make('contact_text1_ru')->label('Text 1 ru')->required(),
                                TextInput::make('contact_text2_ru')->label('Text 2 ru')->required(),
                                TextInput::make('contact_text3_ru')->label('Text 3 ru')->required(),
                            ]),
                        Tabs\Tab::make("en")
                            ->schema([
                                TextInput::make('contact_main_title_en')->label('Main title en')->required(),
                                TextInput::make('contact_title_en')->label('Title en')->required(),
                                Textarea::make('contact_subtitle_en')->label('Subtitle en')->required(),
                                TextInput::make('contact_text1_en')->label('Text 1 en')->required(),
                                TextInput::make('contact_text2_en')->label('Text 2 en')->required(),
                                TextInput::make('contact_text3_en')->label('Text 3 en')->required(),
                            ]),
                    ])->columnSpanFull(),
                ])->collapsed(),
            ]);
    }
}
