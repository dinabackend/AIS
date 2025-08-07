<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CharacteristicKeyResource\Pages;
use App\Models\CharacteristicKey;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class CharacteristicKeyResource extends Resource
{
    public static function getLabel(): ?string
    {
        return __('panel.characteristics');
    }

    public static function getPluralLabel(): ?string
    {
        return __('panel.characteristics');
    }

    protected static ?string $model = CharacteristicKey::class;

    protected static ?string $navigationIcon = 'heroicon-s-adjustments-horizontal';

    public static function getNavigationBadge(): ?string
    {
        return CharacteristicKey::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        TextInput::make($tab->makeName('name'))
                            ->required()
                            ->maxLength(255)
                    ])->columnSpanFull()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                ToggleColumn::make('filterable')
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
            'index' => Pages\ListCharacteristicKeys::route('/'),
            'create' => Pages\CreateCharacteristicKey::route('/create'),
            'edit' => Pages\EditCharacteristicKey::route('/{record}/edit'),
        ];
    }
}
