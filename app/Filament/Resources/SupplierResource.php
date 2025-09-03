<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Filament\Resources\SupplierResource\RelationManagers\ContractsRelationManager;
use App\Filament\Resources\SupplierResource\RelationManagers\OrdersRelationManager;
use App\Models\Supplier;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Supply Chain';

    protected static ?int $navigationSort = 2;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignorable: fn ($record) => $record),

                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required(),

                        Forms\Components\Textarea::make('address')
                            ->required()
                            ->rows(3),

                        Forms\Components\TextInput::make('city')
                            ->required(),

                        Forms\Components\Select::make('country')
                            ->options([
                                'UZ' => 'Uzbekistan',
                                'RU' => 'Russia',
                                'KZ' => 'Kazakhstan',
                                'TR' => 'Turkey',
                                'CN' => 'China',
                                'DE' => 'Germany',
                                'IT' => 'Italy',
                            ])
                            ->required(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Business Details')
                    ->schema([
                        Forms\Components\TextInput::make('tax_number')
                            ->label('Tax Number'),

                        Forms\Components\TextInput::make('payment_terms')
                            ->label('Payment Terms (Days)')
                            ->numeric()
                            ->minValue(0),

                        Forms\Components\TextInput::make('credit_limit')
                            ->label('Credit Limit')
                            ->numeric()
                            ->prefix('$'),

                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'pending' => 'Pending',
                                'suspended' => 'Suspended',
                            ])
                            ->default('active'),

                        Forms\Components\Textarea::make('notes')
                            ->rows(3),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('country')
                    ->badge()
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                        'warning' => 'pending',
                        'secondary' => 'suspended',
                    ]),

                TextColumn::make('orders_count')
                    ->label('Total Orders')
                    ->counts('orders')
                    ->sortable(),

                TextColumn::make('credit_limit')
                    ->money('USD')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                        'pending' => 'Pending',
                        'suspended' => 'Suspended',
                    ]),

                Tables\Filters\SelectFilter::make('country')
                    ->options([
                        'UZ' => 'Uzbekistan',
                        'RU' => 'Russia',
                        'KZ' => 'Kazakhstan',
                        'TR' => 'Turkey',
                        'CN' => 'China',
                    ]),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            //ContractsRelationManager::class,
            //OrdersRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            //'index' => Pages\ListSuppliers::route('/'),
            //'create' => Pages\CreateSupplier::route('/create'),
            //'view' => Pages\ViewSupplier::route('/{record}'),
            //'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
