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
        $settings = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $settings[] = Tabs\Tab::make($lang)->schema([
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
                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("subtitle_$lang")->label(__('form.subtitle', locale: $lang))->required()->maxLength(255),
                Textarea::make("text1_$lang")->label(__('form.text1', locale: $lang))->required(),
                Textarea::make("text2_$lang")->label(__('form.text2', locale: $lang))->required(),
                Textarea::make("text3_$lang")->label(__('form.text3', locale: $lang))->required(),
                Repeater::make("info_$lang")->schema([
                    TextInput::make("number")->label(__('form.number'))->required(),
                    TextInput::make("text")->label(__('form.text'))->required(),
                ])->label(__('form.info list', locale: $lang))->columns(),
            ]);
        }

        $companies = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $companies[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.they trust us.', locale: $lang))->required()->maxLength(255),
                TextInput::make("name1_$lang")->label(__('form.name1', locale: $lang))->required()->maxLength(255),
                TextInput::make("name2_$lang")->label(__('form.name2', locale: $lang))->required()->maxLength(255),
                Textarea::make("text1_$lang")->label(__('form.text1', locale: $lang))->required()->maxLength(255),
                Textarea::make("text2_$lang")->label(__('form.text2', locale: $lang))->required()->maxLength(255),
                TextInput::make("title2_$lang")->label(__('form.official partners', locale: $lang))->required()->maxLength(255),
                TextInput::make("title3_$lang")->label(__('form.news', locale: $lang))->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Section::make(__('form.banner'))->schema([
                Repeater::make(__('form.banner'))->schema([
                    Tabs::make()->schema($settings)->columnSpanFull(),
                    FileUpload::make('banner')->disk('public')->directory('banner')->required()
                ])->defaultItems(1)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.info'))->schema([
                Repeater::make('Info')->schema([
                    Tabs::make()->schema($settings2)->columnSpanFull(),
                    FileUpload::make("img_$lang")->label(__('form.image1', locale: $lang))->required(),
                    FileUpload::make("img2_$lang")->label(__('form.image2', locale: $lang))->required(),
                ])->defaultItems(1)->columnSpanFull(),
            ])->collapsed(),

//            Section::make(__('form.Advantages'))->schema([
//                Tabs::make(__('form.Advantages'))->tabs([
//                    Tabs\Tab::make('uz')->schema([
//                        TextInput::make('title1_uz')->label('Title 1')->required(),
//                        TextInput::make('title2_uz')->label('Title 2')->required(),
//                        Repeater::make('items_uz')->schema([
//                            TextInput::make('title')->label('Title')->required(),
//                            TextInput::make('text')->label('Text')->required(),
//                            TextInput::make('icon')->label('Icon')->required(),
//                        ])->label('Items')->columns(),
//                    ]),
//                    Tabs\Tab::make('ru')->schema([
//                        TextInput::make('title1_ru')->label('Title 1')->required(),
//                        TextInput::make('title2_ru')->label('Title 2')->required(),
//                        Repeater::make('items_ru')->schema([
//                            TextInput::make('title')->label('Title')->required(),
//                            TextInput::make('text')->label('Text')->required(),
//                            TextInput::make('icon')->label('Icon')->required(),
//                        ])->label('Items')->columns(),
//                    ]),
//                    Tabs\Tab::make('en')->schema([
//                        TextInput::make('title1_en')->label('Title 1')->required(),
//                        TextInput::make('title2_en')->label('Title 2')->required(),
//                        Repeater::make('items_en')->schema([
//                            TextInput::make('title')->label('Title')->required(),
//                            TextInput::make('text')->label('Text')->required(),
//                            TextInput::make('icon')->label('Icon')->required(),
//                        ])->label('Items')->columns(),
//                    ]),
//                ]),
//            ])->collapsed(),

            Section::make(__('form.company'))->schema([
                Repeater::make(__('form.company'))->schema([
                    Tabs::make()->schema($companies)->columnSpanFull(),
                ])->defaultItems(1)->columnSpanFull(),
            ])->collapsed(),
        ]);
    }
}
