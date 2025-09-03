<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'product' => new ProductResource($this->whenLoaded('product')),
            'warehouse' => new WarehouseResource($this->whenLoaded('warehouse')),
            'quantity' => $this->quantity,
            'min_quantity' => $this->min_quantity,
            'max_quantity' => $this->max_quantity,
            'unit_cost' => $this->unit_cost,
            'total_value' => $this->total_value,
            'is_low_stock' => $this->isLowStock(),
            'is_over_stock' => $this->isOverStock(),
            'last_movement' => $this->movements()->latest()->first(),
            'updated_by' => $this->whenLoaded('updatedBy'),
            'notes' => $this->notes,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
