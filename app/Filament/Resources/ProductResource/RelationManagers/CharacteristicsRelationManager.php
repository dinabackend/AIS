<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Filament\Resources\CharacteristicResource;
use App\Models\CharacteristicKeyTranslation;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CharacteristicsRelationManager extends RelationManager
{

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('panel.characteristics');
    }

    protected static string $relationship = 'characteristics';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('characteristic_key_id')
                    ->relationship('characteristic_key', 'name')
                    ->options(function () {
                        return CharacteristicKeyTranslation::query()->where('locale', app()->getLocale())
                            ->pluck('name', 'characteristic_key_id');
                    })->required(),
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        Forms\Components\TextInput::make($tab->makeName('value'))
                            ->required()
                            ->maxLength(255)
                    ]),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('characteristic_key.name'),
                Tables\Columns\TextColumn::make('value'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                /*EditAction::make()->url(
                    fn(Model $record): string => CharacteristicResource::getUrl(name: 'edit', parameters: [
                        'record' => $record->id
                    ])
                ),*/
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
