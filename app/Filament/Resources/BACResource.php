<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BACResource\Pages;
use App\Models\BAC;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\Resources\Concerns\ResourceTranslatable;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms;
use Filament\Forms\Components\SpatieMediaLibraryFileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class BACResource extends Resource
{
    use ResourceTranslatable;

    public static function getLabel(): ?string
    {
        return 'B & C';
    }
    public static function getPluralLabel(): ?string
    {
        return 'B & C';
    }

    protected static ?string $model = BAC::class;

    protected static ?string $navigationIcon = 'heroicon-o-puzzle-piece';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        TextInput::make($tab->makeName('title'))
                            ->required($tab->makeName('title') === 'uz.title')
                            ->label(__('form.Title')),
                        TextArea::make($tab->makeName('description'))
                            ->required($tab->makeName('description') === 'uz.description')
                            ->label(__('form.description')),
                    ])->columnSpanFull(),

                Forms\Components\Select::make('type')
                    ->options([
                        'b2b' => __('form.b2b'),
                        'creation' => __('form.creation')
                    ])
                    ->default('b2b')
                    ->required()
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('image')
                    ->visibility(true)
                    ->image()
                    ->imageEditor()
                    ->collection('bac_img')
                    ->label(__('form.img'))
                    ->columnSpanFull(),

                SpatieMediaLibraryFileUpload::make('images')
                    ->visibility(true)
                    ->image()
                    ->imageEditor()
                    ->collection('bac_image')
                    ->multiple()
                    ->reorderable()
                    ->label(__('form.image'))
                    ->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->toggleable(isToggledHiddenByDefault: true)->sortable(),
                TextColumn::make('title')
                    ->toggleable()
                    ->label(__('form.Title'))
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->toggleable()
                    ->label(__('form.type'))
                    ->sortable()
                    ->searchable(),
                SpatieMediaLibraryImageColumn::make('image')
                    ->collection('bac_img')->stacked()->label(__('form.img'))
                    ->toggleable(isToggledHiddenByDefault: true),

                SpatieMediaLibraryImageColumn::make('images')
                    ->collection('bac_image')->stacked()->label(__('form.image'))
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->reorderable('order_column')
            ->defaultSort('order_column')
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBACS::route('/'),
            'create' => Pages\CreateBAC::route('/create'),
            'edit' => Pages\EditBAC::route('/{record}/edit'),
        ];
    }
}
