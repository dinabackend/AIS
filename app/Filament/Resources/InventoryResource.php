<?php

namespace App\Filament\Resources;

use App\Filament\Resources\InventoryResource\Pages;
use App\Filament\Resources\InventoryResource\RelationManagers\MovementsRelationManager;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Warehouse;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class InventoryResource extends Resource
{
    protected static ?string $model = Inventory::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $navigationGroup = 'Warehouse Management';

    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Inventory Details')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Product')
                            ->options(Product::all()->pluck('name', 'id'))
                            ->required()
                            ->searchable(),

                        Forms\Components\Select::make('warehouse_id')
                            ->label('Warehouse')
                            ->options(Warehouse::all()->pluck('name', 'id'))
                            ->required(),

                        Forms\Components\TextInput::make('quantity')
                            ->label('Current Quantity')
                            ->numeric()
                            ->required()
                            ->minValue(0),

                        Forms\Components\TextInput::make('min_quantity')
                            ->label('Minimum Quantity')
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\TextInput::make('max_quantity')
                            ->label('Maximum Quantity')
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\TextInput::make('unit_cost')
                            ->label('Unit Cost')
                            ->numeric()
                            ->prefix('$'),

                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3),
                    ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('product.name')
                    ->label('Product')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('warehouse.name')
                    ->label('Warehouse')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('quantity')
                    ->label('Quantity')
                    ->numeric()
                    ->sortable(),

                BadgeColumn::make('stock_status')
                    ->label('Stock Status')
                    ->getStateUsing(function ($record) {
                        if ($record->isLowStock()) return 'Low Stock';
                        if ($record->isOverStock()) return 'Over Stock';
                        return 'Normal';
                    })
                    ->colors([
                        'danger' => 'Low Stock',
                        'warning' => 'Over Stock',
                        'success' => 'Normal',
                    ]),

                TextColumn::make('total_value')
                    ->label('Total Value')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('warehouse_id')
                    ->label('Warehouse')
                    ->options(Warehouse::all()->pluck('name', 'id')),

                SelectFilter::make('stock_status')
                    ->label('Stock Status')
                    ->options([
                        'low' => 'Low Stock',
                        'normal' => 'Normal',
                        'over' => 'Over Stock',
                    ])
                    ->query(function ($query, $data) {
                        if ($data['value'] === 'low') {
                            return $query->whereColumn('quantity', '<=', 'min_quantity');
                        }
                        if ($data['value'] === 'over') {
                            return $query->whereColumn('quantity', '>=', 'max_quantity');
                        }
                        return $query;
                    }),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\ViewAction::make(),
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
            //MovementsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListInventories::route('/'),
            //'create' => Pages\CreateInventory::route('/create'),
            //'edit' => Pages\EditInventory::route('/{record}/edit'),
            //'view' => Pages\ViewInventory::route('/{record}'),
        ];
    }
}
