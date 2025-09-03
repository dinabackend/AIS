<?php

namespace App\Filament\Resources;

use App\Models\Invoice;
use App\Models\Order;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;

class InvoiceResource extends Resource
{
    protected static ?string $model = Invoice::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationGroup = 'Financial Management';

    protected static ?int $navigationSort = 1;

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Invoice Details')
                    ->schema([
                        Forms\Components\TextInput::make('invoice_number')
                            ->required()
                            ->unique(ignorable: fn ($record) => $record),

                        Forms\Components\Select::make('order_id')
                            ->label('Order')
                            ->options(Order::with('customer')->get()->mapWithKeys(function($order) {
                                return [$order->id => $order->order_number . ' - ' . $order->customer->name];
                            }))
                            ->required()
                            ->searchable(),

                        Forms\Components\TextInput::make('amount')
                            ->numeric()
                            ->prefix('$')
                            ->required(),

                        Forms\Components\TextInput::make('tax_amount')
                            ->numeric()
                            ->prefix('$'),

                        Forms\Components\DatePicker::make('due_date')
                            ->required()
                            ->default(now()->addDays(30)),

                        Forms\Components\Select::make('status')
                            ->options([
                                'pending' => 'Pending',
                                'sent' => 'Sent',
                                'paid' => 'Paid',
                                'overdue' => 'Overdue',
                                'cancelled' => 'Cancelled',
                            ])
                            ->required(),

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
                TextColumn::make('invoice_number')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('order.customer.name')
                    ->label('Customer')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('total_amount')
                    ->money('USD')
                    ->sortable(),

                BadgeColumn::make('status')
                    ->colors([
                        'warning' => 'pending',
                        'info' => 'sent',
                        'success' => 'paid',
                        'danger' => 'overdue',
                        'secondary' => 'cancelled',
                    ]),

                TextColumn::make('due_date')
                    ->date()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status'),
                Tables\Filters\Filter::make('overdue')
                    ->query(fn ($query) => $query->where('due_date', '<', now())->where('status', '!=', 'paid')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->url(fn ($record) => route('invoices.download', $record)),
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
            //PaymentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            //'index' => Pages\ListInvoices::route('/'),
            //'create' => Pages\CreateInvoice::route('/create'),
            //'view' => Pages\ViewInvoice::route('/{record}'),
            //'edit' => Pages\EditInvoice::route('/{record}/edit'),
        ];
    }
}
