<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['customer', 'items.product', 'shipping'])
            ->when($request->customer_id, function($query, $customerId) {
                return $query->where('customer_id', $customerId);
            })
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->date_from, function($query, $dateFrom) {
                return $query->where('created_at', '>=', $dateFrom);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 20));

        return OrderResource::collection($orders);
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'items.product', 'shipping', 'payments'])
            ->findOrFail($id);
        return new OrderResource($order);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
            'notes' => 'nullable|string'
        ]);

        $order = Order::findOrFail($id);
        $order->update([
            'status' => $request->status,
            'status_notes' => $request->notes,
            'status_updated_at' => now()
        ]);

        // Send notification to customer
        $order->customer->notify(new OrderStatusUpdatedNotification($order));

        return new OrderResource($order);
    }

    public function ship(Request $request, $id)
    {
        $request->validate([
            'tracking_number' => 'required|string',
            'carrier' => 'required|string',
            'estimated_delivery' => 'nullable|date'
        ]);

        $order = Order::findOrFail($id);
        $order->shipping()->create($request->all());
        $order->update(['status' => 'shipped', 'shipped_at' => now()]);

        return new OrderResource($order->fresh());
    }
}
