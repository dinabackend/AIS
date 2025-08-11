<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class EventResource extends Resource
{
    public static function getLabel(): ?string
    {
        return __('panel.events');
    }

    public static function getPluralLabel(): ?string
    {
        return __('panel.events');
    }

    public static function getNavigationBadge(): ?string
    {
        return Event::count();
    }

    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-s-newspaper';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('time')
                ->label(__('form.date')),

                Forms\Components\Toggle::make('status')->inline(false),

                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('title'))
                            ->required()
                            ->label(__('form.title'))
                            ->maxLength(255),
                        Forms\Components\RichEditor::make($tab->makeName('description'))
                            ->required()
                            ->label(__('form.description'))
                    ])->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('img')
                    ->required()
                    ->visibility(true)
                    ->image()
                    ->label(__('form.img'))
                    ->collection('events_img'),

                SpatieMediaLibraryFileUpload::make('image')
                    ->required()
                    ->visibility(true)
                    ->label(__('form.image'))
                    ->image()
                    ->collection('events_image')
                    ->multiple()
                    ->reorderable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                SpatieMediaLibraryImageColumn::make('image')->collection('events_img'),
                TextColumn::make('title')->sortable(),
                SpatieMediaLibraryImageColumn::make('banner')->collection('events_image'),
                TextColumn::make('time')->sortable(),
                Tables\Columns\SelectColumn::make('category')->options(function () {
                    return [
                        'events' => __('categories.events'),
                        'occasions' => __('categories.occasions'),
                        'news' => __('categories.news'),
                        'announcements' => __('categories.announcements'),
                    ];
                })->sortable(),
                Tables\Columns\ToggleColumn::make('status')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit' => Pages\EditEvent::route('/{record}/edit'),
        ];
    }
}
