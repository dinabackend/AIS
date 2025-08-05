<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SpecialistResource\Pages;
use App\Models\Specialist;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SpatieMediaLibraryImageColumn;
use Filament\Tables\Table;

class SpecialistResource extends Resource
{
    public static function getLabel(): ?string
    {
        return __('panel.specialists');
    }

    public static function getPluralLabel(): ?string
    {
        return __('panel.specialists');
    }

    protected static ?string $model = Specialist::class;

    protected static ?string $navigationIcon = 'heroicon-s-user-group';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('name'))
                            ->required()
                            ->maxLength(255)
                    ]),
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('position'))
                            ->required()
                            ->maxLength(255)
                    ]),
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        Forms\Components\Textarea::make($tab->makeName('description'))
                            ->required()
                            ->maxLength(255)
                    ])->columnSpanFull(),
                Forms\Components\SpatieMediaLibraryFileUpload::make('image')
                    ->required()
                    ->visibility(true)
                    ->image()
                    ->collection('specialists')
                    ->multiple()
                    ->reorderable(),
                Forms\Components\Checkbox::make('main')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                SpatieMediaLibraryImageColumn::make('image')->collection('specialists'),
                Tables\Columns\TextColumn::make('name'),
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
            'index' => Pages\ListSpecialists::route('/'),
            'create' => Pages\CreateSpecialist::route('/create'),
            'edit' => Pages\EditSpecialist::route('/{record}/edit'),
        ];
    }
}
