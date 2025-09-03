<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerResource\Pages\CreateCustomer;
use App\Filament\Resources\CustomerResource\Pages\EditCustomer;
use App\Filament\Resources\CustomerResource\Pages\ListCustomers;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Sales Management';

    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Customer Information')
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

                        Forms\Components\Select::make('type')
                            ->options([
                                'individual' => 'Individual',
                                'business' => 'Business',
                            ])
                            ->required(),

                        Forms\Components\TextInput::make('company')
                            ->maxLength(255)
                            ->visible(fn (Forms\Get $get) => $get('type') === 'business'),

                        Forms\Components\DatePicker::make('birthday')
                            ->visible(fn (Forms\Get $get) => $get('type') === 'individual'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Business Settings')
                    ->schema([
                        Forms\Components\TextInput::make('credit_limit')
                            ->numeric()
                            ->prefix('$'),

                        Forms\Components\TextInput::make('payment_terms')
                            ->numeric()
                            ->suffix('days'),

                        Forms\Components\TextInput::make('discount_rate')
                            ->numeric()
                            ->suffix('%')
                            ->maxValue(100),

                        Forms\Components\Select::make('status')
                            ->options([
                                'active' => 'Active',
                                'inactive' => 'Inactive',
                                'suspended' => 'Suspended',
                            ])
                            ->default('active'),
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

                TextColumn::make('type')
                    ->badge()
                    ->colors([
                        'primary' => 'individual',
                        'success' => 'business',
                    ]),

                TextColumn::make('orders_count')
                    ->counts('orders')
                    ->sortable(),

                TextColumn::make('total_spent')
                    ->getStateUsing(fn ($record) => $record->orders()->sum('total_amount'))
                    ->money('USD')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'success' => 'active',
                        'danger' => 'inactive',
                        'warning' => 'suspended',
                    ]),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\SelectFilter::make('type'),
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

    public static function getPages(): array
    {
        return [
            'index' => ListCustomers::route('/'),
            'create' => CreateCustomer::route('/create'),
            'edit' => EditCustomer::route('/{record}/edit'),
            ];
    }
}
