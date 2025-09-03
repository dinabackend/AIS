<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WarehouseResource;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class WarehouseController extends Controller
{
    public function index(Request $request)
    {
        $warehouses = Warehouse::with(['inventories', 'manager'])
            ->when($request->search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                           ->orWhere('code', 'like', "%{$search}%");
            })
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->orderBy('name')
            ->paginate($request->get('per_page', 20));

        return WarehouseResource::collection($warehouses);
    }

    public function show($id)
    {
        $warehouse = Warehouse::with(['inventories.product', 'manager', 'movements'])
            ->findOrFail($id);
        return new WarehouseResource($warehouse);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:warehouses,code',
            'address' => 'required|string',
            'manager_id' => 'nullable|exists:users,id',
            'capacity' => 'nullable|numeric',
        ]);

        $warehouse = Warehouse::create($request->all());
        return new WarehouseResource($warehouse);
    }

    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|unique:warehouses,code,' . $warehouse->id,
            'address' => 'required|string',
            'manager_id' => 'nullable|exists:users,id',
            'capacity' => 'nullable|numeric',
        ]);

        $warehouse->update($request->all());
        return new WarehouseResource($warehouse);
    }

    public function destroy($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $warehouse->delete();

        return response()->json(['message' => 'Warehouse deleted successfully']);
    }

    public function inventory($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        $inventories = $warehouse->inventories()
            ->with(['product'])
            ->orderBy('quantity', 'asc')
            ->get();

        return response()->json([
            'warehouse' => new WarehouseResource($warehouse),
            'inventories' => $inventories
        ]);
    }
}
