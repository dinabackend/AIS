<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupplierResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'tax_number' => $this->tax_number,
            'payment_terms' => $this->payment_terms,
            'credit_limit' => $this->credit_limit,
            'status' => $this->status,
            'performance' => [
                'on_time_delivery_rate' => $this->calculateOnTimeDeliveryRate(),
                'quality_rating' => $this->calculateQualityRating(),
                'total_orders' => $this->orders()->count(),
                'total_amount' => $this->orders()->sum('total_amount'),
            ],
            'products_count' => $this->whenLoaded('products', function() {
                return $this->products->count();
            }),
            'recent_orders' => $this->whenLoaded('orders', function() {
                return $this->orders()->latest()->take(5)->get();
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
