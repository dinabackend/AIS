<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PurchaseOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'supplier_id',
        'warehouse_id',
        'order_date',
        'expected_delivery_date',
        'actual_delivery_date',
        'status',
        'total_amount',
        'tax_amount',
        'discount_amount',
        'notes',
        'approved_at',
        'approved_by',
        'received_at',
        'received_by'
    ];

    protected $casts = [
        'order_date' => 'date',
        'expected_delivery_date' => 'date',
        'actual_delivery_date' => 'date',
        'approved_at' => 'datetime',
        'received_at' => 'datetime',
        'total_amount' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(PurchaseOrderItem::class);
    }

    public function receivedItems(): HasMany
    {
        return $this->hasMany(ReceivedItem::class);
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    public function receivedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    public function isOverdue(): bool
    {
        return $this->expected_delivery_date < now() && $this->status !== 'received';
    }

    public function calculateTotalAmount(): float
    {
        $subtotal = $this->items()->sum(\DB::raw('quantity * unit_price'));
        return $subtotal + $this->tax_amount - $this->discount_amount;
    }
}
