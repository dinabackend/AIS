<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WarehouseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'code' => $this->code,
            'address' => $this->address,
            'city' => $this->city,
            'country' => $this->country,
            'phone' => $this->phone,
            'email' => $this->email,
            'capacity' => $this->capacity,
            'current_capacity' => $this->current_capacity,
            'available_capacity' => $this->available_capacity,
            'status' => $this->status,
            'manager' => $this->whenLoaded('manager'),
            'inventories_count' => $this->whenLoaded('inventories', function() {
                return $this->inventories->count();
            }),
            'low_stock_items' => $this->whenLoaded('inventories', function() {
                return $this->inventories->filter(function($inventory) {
                    return $inventory->isLowStock();
                })->count();
            }),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
