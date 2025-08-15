<?php

namespace App\Filament\Pages;

use App\Settings\HomePageSettings;
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
        $settings_array = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $settings_array[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("subtitle_$lang")->label(__('form.subtitle', locale: $lang))->required()->maxLength(255),
                Repeater::make("info_$lang")->schema([
                    TextInput::make("number")->label(__('form.number'))->required(),
                    TextInput::make("text")->label(__('form.text'))->required(),
                ])->label(__('form.info list', locale: $lang))->columns(),
            ]);
        }

        $settings2 = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $settings2[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title2_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("subtitle2_$lang")->label(__('form.subtitle', locale: $lang))->required()->maxLength(255),
                Textarea::make("text1_$lang")->label(__('form.text1', locale: $lang))->required(),
                Textarea::make("text2_$lang")->label(__('form.text2', locale: $lang))->required(),
                Textarea::make("text3_$lang")->label(__('form.text3', locale: $lang))->required(),
                Repeater::make("info2_$lang")->schema([
                    TextInput::make("number")->label(__('form.number'))->required(),
                    TextInput::make("text")->label(__('form.text'))->required(),
                ])->label(__('form.info list', locale: $lang))->columns(),
            ]);
        }

//        $advantages = [];
//        foreach (['ru', 'uz', 'en'] as $lang) {
//            $advantages[] = Tabs\Tab::make($lang)->schema([
//                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
//                Repeater::make("items_$lang")->schema([
//                    TextInput::make("title3")->label(__('form.title'))->required(),
//                    Textarea::make("text4")->label(__('form.text'))->required(),
//                ])->label(__('form.items list', locale: $lang))->columns(),
//            ]);
//        }

        $companies = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $companies[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title3_$lang")->label(__('form.they trust us.', locale: $lang))->required()->maxLength(255),
                TextInput::make("name1_$lang")->label(__('form.name1', locale: $lang))->required()->maxLength(255),
                TextInput::make("name2_$lang")->label(__('form.name2', locale: $lang))->required()->maxLength(255),
                Textarea::make("text5_$lang")->label(__('form.text1', locale: $lang))->required()->maxLength(255),
                Textarea::make("text6_$lang")->label(__('form.text2', locale: $lang))->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Section::make(__('form.banner'))->schema([
                Repeater::make('banner')->schema([
                    FileUpload::make(__('form.banner'))->disk('public')->directory('banner')->required(),
                    Tabs::make()->schema($settings_array)->columnSpanFull(),
                ])->label(__('form.banner'))->columns(),
            ])->collapsed(),

            Section::make(__('form.info'))->schema([
                Tabs::make()->schema($settings2)->columnSpanFull(),
                FileUpload::make("img")->label(__('form.image1'))->required(),
                FileUpload::make("img2")->label(__('form.image2'))->required()
            ])->collapsed(),

            Section::make(__('form.company'))->schema([
                Tabs::make()->schema($companies)->columnSpanFull(),
                FileUpload::make('imagess')
                    ->label(__('form.images'))
                    ->disk('public')
                    ->directory('images')
                    ->multiple()
                    ->required(),
            ])->collapsed(),

            Section::make(__('form.cooperation'))->schema([
                Tabs::make()->tabs([
                    Tabs\Tab::make('ru')->schema([
                        TextInput::make('titleb_ru')->label(__('form.title'))->required()->maxLength(255),
                    ]),
                    Tabs\Tab::make('uz')->schema([
                        TextInput::make('titleb_uz')->label(__('form.title'))->required()->maxLength(255),
                    ]),
                    Tabs\Tab::make('en')->schema([
                        TextInput::make('titleb_en')->label(__('form.title'))->required()->maxLength(255),
                    ]),
                ]),
                FileUpload::make('images')
                    ->label(__('form.images'))
                    ->disk('public')
                    ->directory('images')
                    ->multiple()
                    ->required(),

            ])->collapsed(),

            Section::make(__('form.events'))->schema([
                Tabs::make()->tabs([
                    Tabs\Tab::make('ru')->schema([
                        TextInput::make('event_title_ru')->label(__('form.title'))->required()->maxLength(255),
                    ]),
                    Tabs\Tab::make('uz')->schema([
                        TextInput::make('event_title_uz')->label(__('form.title'))->required()->maxLength(255),
                    ]),
                    Tabs\Tab::make('en')->schema([
                        TextInput::make('event_title_en')->label(__('form.title'))->required()->maxLength(255),
                    ]),
                ]),
            ])->collapsed(),
        ]);
    }
}
