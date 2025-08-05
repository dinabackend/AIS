<?php

namespace App\Filament\Resources\ProductResource\RelationManagers;

use App\Models\Category;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CategoriesRelationManager extends RelationManager
{

    public static function getTitle(Model $ownerRecord, string $pageClass): string
    {
        return __('panel.categories');
    }

    protected static string $relationship = 'categories';

    public function form(Form $form): Form
    {
        return $form->schema([]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitle(fn(Category $record) => $record->getTranslation(app()->getLocale())->name)
            ->columns([
                TextColumn::make('id')->formatStateUsing(function (Category $category) {
                    return $category->getTranslation(app()->getLocale())->name;
                })->label('category'),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\AttachAction::make()
                    ->multiple()
                    ->preloadRecordSelect()
                    ->form(fn() => [
                        Select::make('recordId')
                            ->label('Category')
                            ->options(fn() => Category::query()->whereNull('parent_id')->with('children')->get()
                                ->mapWithKeys(fn($category) => [
                                    $category->name =>
                                        [$category->id => $category->name] +
                                        $category->children->pluck('name', 'id')->toArray()
                                ])
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
