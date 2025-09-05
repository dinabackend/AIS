<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'tracking_number',
        'carrier',
        'service_type',
        'status',
        'cost',
        'weight',
        'dimensions',
        'shipped_at',
        'estimated_delivery_date',
        'actual_delivery_date',
        'recipient_name',
        'recipient_phone',
        'shipping_address',
        'notes'
    ];

    protected $casts = [
        'cost' => 'decimal:2',
        'weight' => 'decimal:2',
        'dimensions' => 'array',
        'shipped_at' => 'datetime',
        'estimated_delivery_date' => 'datetime',
        'actual_delivery_date' => 'datetime',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function trackingEvents(): HasMany
    {
        return $this->hasMany(TrackingEvent::class);
    }

    public function isDelayed(): bool
    {
        return $this->estimated_delivery_date < now() && $this->status !== 'delivered';
    }
}

