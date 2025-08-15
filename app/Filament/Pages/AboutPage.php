<?php

namespace App\Filament\Pages;

use App\Settings\AboutSettings;
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

class AboutPage extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.about_page_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.about_page_settings');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-information-circle';

    protected static string $settings = AboutSettings::class;

    public function form(Form $form): Form
    {
        $main_title = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $main_title[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("main_title_$lang")->label(__('form.main', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $info = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $info[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("about_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                Textarea::make("text_$lang")->label(__('form.text', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $questions = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $questions[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("question_$lang")->label(__('form.question', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $information = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $information[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("text_$lang")->label(__('form.text', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $AisTechnoGroup = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $AisTechnoGroup[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("dalgakiran_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("Our_goal_$lang")->label(__('form.name1', locale: $lang))->required()->maxLength(255),
                Textarea::make("text1_$lang")->label(__('form.text1', locale: $lang))->required()->maxLength(255),
                TextInput::make("We_offer_$lang")->label(__('form.name2', locale: $lang))->required()->maxLength(255),
                Textarea::make("text2_$lang")->label(__('form.text2', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $OurPartners = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $OurPartners[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("ourPartners_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                Textarea::make("text3_$lang")->label(__('form.text', locale: $lang))->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Section::make(__('form.main'))->schema([
                Tabs::make()->schema($main_title)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.about'))->schema([
                Tabs::make()->schema($info)->columnSpanFull(),
                FileUpload::make('banner')->disk('public')->directory('img')->required()
            ])->collapsed(),

            Section::make(__('form.question'))->schema([
                Tabs::make()->schema($questions)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.information'))->schema([
                Repeater::make('information')->schema([
                    Tabs::make()->schema($information)->columnSpanFull(),
                    FileUpload::make('img')->disk('public')->directory('img')->required()
                ])
                ->columns(1)
                ->columnSpanFull()
            ])->collapsed(),

            Section::make(__('form.certificate'))->schema([
                Tabs::make()->schema($AisTechnoGroup)->columnSpanFull(),
                FileUpload::make('img')->disk('public')->directory('img')->required()
            ])->collapsed(),

            Section::make(__('form.OurPartners'))->schema([
                Tabs::make()->schema($OurPartners)->columnSpanFull(),
                FileUpload::make('images')
                    ->label(__('form.images'))
                    ->disk('public')
                    ->directory('images')
                    ->multiple()
                    ->required(),
            ])->collapsed(),
        ]);
    }
}
