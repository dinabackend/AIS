<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'country',
        'tax_number',
        'payment_terms',
        'credit_limit',
        'status',
        'notes'
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
        'payment_terms' => 'integer',
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class)->withPivot(['cost_price', 'lead_time']);
    }

    public function orders(): HasMany
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function contracts(): HasMany
    {
        return $this->hasMany(SupplierContract::class);
    }

    public function calculateOnTimeDeliveryRate(): float
    {
        $totalOrders = $this->orders()->count();
        if ($totalOrders === 0) return 0;

        $onTimeOrders = $this->orders()->where('delivered_on_time', true)->count();
        return ($onTimeOrders / $totalOrders) * 100;
    }

    public function calculateQualityRating(): float
    {
        return $this->orders()->avg('quality_rating') ?? 0;
    }
}
