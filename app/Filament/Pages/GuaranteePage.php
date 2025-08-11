<?php

namespace App\Filament\Pages;

use App\Settings\GuaranteePageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Components\Tab;
use Illuminate\Contracts\Support\Htmlable;

class GuaranteePage extends SettingsPage
{
    public function getTitle(): string|Htmlable
    {
        return __('panel.guarantee_page_settings');
    }

    public static function getNavigationLabel(): string
    {
        return __('panel.guarantee_page_settings');
    }

    protected static ?string $navigationGroup = 'Settings';
    protected static ?string $navigationIcon = 'heroicon-o-shield-check';

    protected static string $settings = GuaranteePageSettings::class;

    public function form(Form $form): Form
    {

        $many_titles = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $many_titles[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("main_$lang")->label(__('form.main', locale: $lang))->required()->maxLength(255),
            ]);
        }

        $settings = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $settings[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                TextInput::make("subtitle_$lang")->label(__('form.subtitle', locale: $lang))->required()->maxLength(255),
                Repeater::make("repeater_$lang")->schema([
                    TextInput::make("name")->label(__('form.name'))->required(),
                    TextInput::make("text")->label(__('form.text'))->required(),
                ])->label(__('form.info list', locale: $lang))->columns(),
            ]);
        }

        $questions = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $questions[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("question_$lang")
                    ->label(__('form.question', locale: $lang))->required()->maxLength(255),
                Repeater::make("question_list_$lang")->schema([
                    TextInput::make("answer")->label(__('form.step', locale: $lang))->required(),
                ])->label(__('form.answers list', locale: $lang))->columns(),
            ]);
        }

        $defect = [];
        foreach (['ru', 'uz', 'en'] as $lang) {
            $defect[] = Tabs\Tab::make($lang)->schema([
                TextInput::make("defect_title_$lang")->label(__('form.title', locale: $lang))->required()->maxLength(255),
                Repeater::make("defect_list_$lang")->schema([
                    TextInput::make("text")->label(__('form.text', locale: $lang))->required(),
                ])->label(__('form.defect list', locale: $lang))->columns(),
                TextInput::make("defect_question_$lang")->label(__('form.question', locale: $lang))->required()->maxLength(255),
            ]);
        }

        return $form->schema([
            Section::make(__('form.main'))->schema([
                Tabs::make('main')->schema($many_titles)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.guarantee'))->schema([
                Tabs::make('guarantee')->schema($settings)->columnSpanFull(),
                FileUpload::make('banner')->disk('public')->directory('banner')->required()
            ])->collapsed(),

            Section::make(__('form.question'))->schema([
                Tabs::make('question')->schema($questions)->columnSpanFull(),
            ])->collapsed(),

            Section::make(__('form.defect'))->schema([
                Tabs::make('defect')->schema($defect)->columnSpanFull(),
            ])->collapsed(),
        ]);
    }
}
