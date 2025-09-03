<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PurchaseOrderResource;
use App\Models\PurchaseOrder;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = PurchaseOrder::with(['supplier', 'items.product'])
            ->when($request->supplier_id, function($query, $supplierId) {
                return $query->where('supplier_id', $supplierId);
            })
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->date_from, function($query, $dateFrom) {
                return $query->where('order_date', '>=', $dateFrom);
            })
            ->orderBy('order_date', 'desc')
            ->paginate($request->get('per_page', 20));

        return PurchaseOrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = PurchaseOrder::with(['supplier', 'items.product', 'receivedItems'])
            ->findOrFail($id);
        return new PurchaseOrderResource($order);
    }

    public function approve($id)
    {
        $order = PurchaseOrder::findOrFail($id);
        $order->update(['status' => 'approved', 'approved_at' => now()]);

        // Send notification to supplier
        $order->supplier->notify(new OrderApprovedNotification($order));

        return new PurchaseOrderResource($order);
    }

    public function receive(Request $request, $id)
    {
        $order = PurchaseOrder::findOrFail($id);

        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|exists:purchase_order_items,id',
            'items.*.received_quantity' => 'required|numeric|min:0',
        ]);

        foreach ($request->items as $item) {
            $orderItem = $order->items()->findOrFail($item['id']);
            $orderItem->update(['received_quantity' => $item['received_quantity']]);

            // Update inventory
            $inventory = Inventory::where('product_id', $orderItem->product_id)
                ->where('warehouse_id', $order->warehouse_id)
                ->first();

            if ($inventory) {
                $inventory->increment('quantity', $item['received_quantity']);
            }
        }

        $order->update(['status' => 'received', 'received_at' => now()]);

        return new PurchaseOrderResource($order->fresh());
    }
}
