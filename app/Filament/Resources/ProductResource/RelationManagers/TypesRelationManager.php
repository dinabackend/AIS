<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\TypeTranslation;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TypesRelationManager extends RelationManager
{
    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('panel.types');
    }

    protected static string $relationship = 'types';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                //Tables\Actions\AttachAction::make(),
                Tables\Actions\AttachAction::make()
                    ->multiple()
                    ->preloadRecordSelect()
                    ->form(fn() => [
                        Select::make('recordId')
                            ->label('Category')
                            ->options(fn() => TypeTranslation::query()
                                ->where('locale', app()->getLocale())
                                ->pluck('name', 'type_id')
                            )
                            ->searchable()
                            ->preload()
                            ->required(),
                    ]),
            ])
            ->actions([
                Tables\Actions\DetachAction::make()
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
