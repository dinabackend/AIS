<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TypeResource\Pages;
use App\Models\Type;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TypeResource extends Resource
{
    public static function getLabel(): ?string
    {
        return __('panel.types');
    }

    public static function getPluralLabel(): ?string
    {
        return __('panel.types');
    }

    protected static ?string $model = Type::class;

    protected static ?string $slug = 'types';

    protected static ?string $navigationIcon = 'heroicon-s-inbox-stack';

    public static function getNavigationBadge(): ?string
    {
        return Type::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TranslatableTabs::make()
                    ->localeTabSchema(fn(TranslatableTab $tab) => [
                        TextInput::make($tab->makeName('name'))
                            ->required($tab->makeName('name') === 'uz.name')
                    ])->columnSpanFull(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name'),
                TextColumn::make('products_count')->counts('products')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTypes::route('/'),
            'create' => Pages\CreateType::route('/create'),
            'edit' => Pages\EditType::route('/{record}/edit'),
        ];
    }

    public static function getGloballySearchableAttributes(): array
    {
        return [];
    }
}
