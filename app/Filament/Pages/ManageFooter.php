<?php

namespace App\Filament\Pages;

use App\Settings\FooterSettings;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;

class ManageFooter extends SettingsPage
{
    public function getTitle(): string | Htmlable
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

                // Footer title
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make("O'zbekcha")
                            ->schema([
                                TextInput::make('footer_title_uz')->label('Footer Title uz')->required()->columnSpanFull(),
                            ]),
                        Tabs\Tab::make("Русский")
                            ->schema([
                                TextInput::make('footer_title_ru')->label('Footer Title ru')->required()->columnSpanFull(),
                            ]),
                        Tabs\Tab::make("English")
                            ->schema([
                                TextInput::make('footer_title_en')->label('Footer Title en')->required()->columnSpanFull(),
                            ]),
                    ])->columnSpanFull(),

                // Address
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make("O'zbekcha")
                            ->schema([
                                TextInput::make('address_uz',)
                                    ->label('Manzil')
                                    ->required(),
                            ]),
                        Tabs\Tab::make("Русский")
                            ->schema([
                                TextInput::make('address_ru',)
                                    ->label('Адрес')
                                    ->required(),
                            ]),
                        Tabs\Tab::make("English")
                            ->schema([
                                TextInput::make('address_en',)
                                    ->label('Address')
                                    ->required(),
                            ]),
                    ])->columnSpanFull(),
                Tabs::make()
                    ->tabs([
                        Tabs\Tab::make("Telegram")
                            ->schema([
                                TextInput::make('telegram',)
                                    ->label('Telegram Link')
                                    ->required(),
                            ]),
                        Tabs\Tab::make("Instagram")
                            ->schema([
                                TextInput::make('instagram',)
                                    ->label('Instagram Link')
                                    ->required(),
                            ]),
                        Tabs\Tab::make("Whatsapp")
                            ->schema([
                                TextInput::make('whatsapp',)
                                    ->label('Whatsapp Link')
                                    ->required(),
                            ]),
                    ])->columnSpanFull(),

                // Social Media
                TextInput::make('mail',)->label('Mail Address')->required(),
                TextInput::make('phone_top_1')->label('Phone Top 1')->required(),
                TextInput::make('phone_top_2')->label('Phone Top 2')->required(),
                TextInput::make('phone_footer')->label('Phone Footer')->required(),
            ]);
    }
}
