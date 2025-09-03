<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'type',
        'company',
        'tax_number',
        'credit_limit',
        'payment_terms',
        'discount_rate',
        'status',
        'notes',
        'birthday',
        'registration_date'
    ];

    protected $casts = [
        'credit_limit' => 'decimal:2',
        'discount_rate' => 'decimal:2',
        'birthday' => 'date',
        'registration_date' => 'date',
    ];

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(CustomerAddress::class);
    }

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class);
    }

    public function primaryAddress(): HasOne
    {
        return $this->hasOne(CustomerAddress::class)->where('is_primary', true);
    }

    public function calculateLifetimeValue(): float
    {
        return $this->orders()->sum('total_amount');
    }

    public function getFavoriteProducts()
    {
        return $this->orders()
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->selectRaw('products.*, SUM(order_items.quantity) as total_quantity')
            ->groupBy('products.id')
            ->orderBy('total_quantity', 'desc')
            ->take(5)
            ->get();
    }
}
