<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'address',
        'city',
        'country',
        'manager_id',
        'capacity',
        'status',
        'phone',
        'email'
    ];

    protected $casts = [
        'capacity' => 'decimal:2',
    ];

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function inventories(): HasMany
    {
        return $this->hasMany(Inventory::class);
    }

    public function movements(): HasMany
    {
        return $this->hasMany(InventoryMovement::class);
    }

    public function getCurrentCapacityAttribute(): float
    {
        return $this->inventories()->sum('quantity');
    }

    public function getAvailableCapacityAttribute(): float
    {
        return $this->capacity - $this->current_capacity;
    }
}
