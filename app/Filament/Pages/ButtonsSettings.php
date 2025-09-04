<?php

namespace App\Filament\Pages;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Support\Htmlable;

class ButtonsSettings extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.buttons');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.buttons');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('panel.settings');
    }
    protected static ?string $navigationIcon = 'heroicon-o-cursor-arrow-rays';

    protected static string $settings = \App\Settings\ButtonsSettings::class;

    public function form(Form $form): Form
    {


        $buttons = [
            'nav_form',
            'about_link',
            'info_link',
            'info_contact',
            'company_link',
            'catalog_link',
            'collection_link',
            'telegram',
            'contacts_link',
            'footer_form_link',
            'footer_catalog_link',
        ];

        $settings = [];
        foreach ($buttons as $button) {
            $settings[] = Tabs\Tab::make($button)->schema([
                TextInput::make("{$button}_text_ru")->label(__('form.Text', locale: 'ru') . ' ru')->required()->maxLength(255),
                TextInput::make("{$button}_text_uz")->label(__('form.Text', locale: 'uz') . ' uz')->required()->maxLength(255),
                TextInput::make("{$button}_text_en")->label(__('form.Text', locale: 'en') . ' en')->required()->maxLength(255),
                TextInput::make("{$button}_link")->label('Link')->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Tabs::make()->schema($settings)->columnSpanFull(),
        ]);
    }
}
