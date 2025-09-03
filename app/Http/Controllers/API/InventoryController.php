<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InventoryResource;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $inventories = Inventory::with(['warehouse', 'product'])
            ->when($request->warehouse_id, function($query, $warehouseId) {
                return $query->where('warehouse_id', $warehouseId);
            })
            ->when($request->low_stock, function($query) {
                return $query->where('quantity', '<=', 'min_quantity');
            })
            ->paginate($request->get('per_page', 50));

        return InventoryResource::collection($inventories);
    }

    public function show($id)
    {
        $inventory = Inventory::with(['warehouse', 'product', 'movements'])->findOrFail($id);
        return new InventoryResource($inventory);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:0',
            'min_quantity' => 'nullable|numeric|min:0',
            'max_quantity' => 'nullable|numeric|min:0',
        ]);

        $inventory = Inventory::findOrFail($id);
        $inventory->update($request->all());

        return new InventoryResource($inventory);
    }

    public function lowStock()
    {
        $inventories = Inventory::whereColumn('quantity', '<=', 'min_quantity')
            ->with(['warehouse', 'product'])
            ->get();

        return InventoryResource::collection($inventories);
    }

    public function movements($id)
    {
        $inventory = Inventory::findOrFail($id);
        $movements = $inventory->movements()
            ->with(['user'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json([
            'inventory' => new InventoryResource($inventory),
            'movements' => $movements
        ]);
    }
}
