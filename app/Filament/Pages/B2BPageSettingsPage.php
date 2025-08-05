<?php

namespace App\Filament\Pages;

use App\Settings\B2BPageSettings;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Illuminate\Contracts\Support\Htmlable;

class B2BPageSettingsPage extends SettingsPage
{
    protected static ?string $navigationIcon = 'heroicon-o-briefcase';
    protected static string $settings = B2BPageSettings::class;
    protected static ?string $navigationLabel = null;
    protected static ?string $navigationGroup = null;
    protected static ?string $slug = 'b2b-page-settings';

    public static function getNavigationLabel(): string
    {
        return __('panel.B2B Page Settings Page');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('panel.Pages');
    }

    public function getTitle(): string|Htmlable
    {
        return __('panel.B2B Page Settings Page');
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Tabs::make()->schema([

                Tabs\Tab::make(__('form.Banner'))->schema([
                    FileUpload::make('banner')->label('Banner'),
                ]),

                Tabs\Tab::make(__('form.Title'))->schema([
                    TextInput::make('title_uz')->label('Title uz'),
                    TextInput::make('title_ru')->label('Title ru'),
                    TextInput::make('title_en')->label('Title en'),
                ]),

                Tabs\Tab::make(__('form.Subtitle'))->schema([
                    TextInput::make('subtitle_uz')->label('Subtitle uz'),
                    TextInput::make('subtitle_ru')->label('Subtitle ru'),
                    TextInput::make('subtitle_en')->label('Subtitle en'),
                ]),

                Tabs\Tab::make(__('form.Text'))->schema([
                    Repeater::make('text_uz')
                        ->label('UZ')
                        ->schema([
                            Textarea::make('left')->label(__('form.left')),
                            Textarea::make('right')->label(__('form.right')),
                        ])
                        ->columns(),
                    Repeater::make('text_ru')
                        ->label('RU')
                        ->schema([
                            Textarea::make('left')->label(__('form.left')),
                            Textarea::make('right')->label(__('form.right')),
                        ])
                        ->columns(),
                    Repeater::make('text_en')
                        ->label('EN')
                        ->schema([
                            Textarea::make('left')->label(__('form.left')),
                            Textarea::make('right')->label(__('form.right')),
                        ])
                        ->columns(),
                ]),

                Tabs\Tab::make(__('form.Images'))->schema([
                    FileUpload::make('images')->label(__('form.image'))->image()->multiple(),
                ]),

                Tabs\Tab::make(__('form.Our Title'))->schema([
                    TextInput::make('our_title_uz')->label('Our Title uz'),
                    TextInput::make('our_title_ru')->label('Our Title ru'),
                    TextInput::make('our_title_en')->label('Our Title en'),
                ]),

                Tabs\Tab::make(__('form.Our Text'))->schema([
                    Textarea::make('our_text_uz')->label('Our Text uz'),
                    Textarea::make('our_text_ru')->label('Our Text ru'),
                    Textarea::make('our_text_en')->label('Our Text en'),
                ]),

                Tabs\Tab::make(__('form.Info Name'))->schema([
                    TextInput::make('info_name_uz')->label('Info Name uz'),
                    TextInput::make('info_name_ru')->label('Info Name ru'),
                    TextInput::make('info_name_en')->label('Info Name en'),
                ]),

                Tabs\Tab::make(__('form.Info Title'))->schema([
                    TextInput::make('info_title_uz')->label('Info Title uz'),
                    TextInput::make('info_title_ru')->label('Info Title ru'),
                    TextInput::make('info_title_en')->label('Info Title en'),
                ]),

                Tabs\Tab::make(__('form.Info List'))->schema([
                    Repeater::make('info_list_uz')
                        ->label('UZ')
                        ->schema([
                            Textarea::make('left')->label(__('form.left')),
                            Textarea::make('right')->label(__('form.right')),
                        ])
                        ->columns(),
                    Repeater::make('info_list_ru')
                        ->label('RU')
                        ->schema([
                            Textarea::make('left')->label(__('form.left')),
                            Textarea::make('right')->label(__('form.right')),
                        ])
                        ->columns(),
                    Repeater::make('info_list_en')
                        ->label('EN')
                        ->schema([
                            Textarea::make('left')->label(__('form.left')),
                            Textarea::make('right')->label(__('form.right')),
                        ])
                        ->columns(),

                ]),

            ])->columnSpanFull(),
        ]);
    }
}
