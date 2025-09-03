<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingResource;
use App\Models\Shipping;
use App\Models\Order;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function index(Request $request)
    {
        $shipments = Shipping::with(['order.customer'])
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->carrier, function($query, $carrier) {
                return $query->where('carrier', $carrier);
            })
            ->orderBy('shipped_at', 'desc')
            ->paginate($request->get('per_page', 20));

        return ShippingResource::collection($shipments);
    }

    public function track($trackingNumber)
    {
        $shipping = Shipping::where('tracking_number', $trackingNumber)
            ->with(['order.customer', 'trackingEvents'])
            ->firstOrFail();

        // Simulate tracking API call
        $trackingData = $this->getTrackingData($trackingNumber, $shipping->carrier);

        return response()->json([
            'shipment' => new ShippingResource($shipping),
            'tracking_data' => $trackingData,
            'estimated_delivery' => $shipping->estimated_delivery_date,
        ]);
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,shipped,in_transit,delivered,returned',
            'location' => 'nullable|string',
            'notes' => 'nullable|string'
        ]);

        $shipping = Shipping::findOrFail($id);
        $shipping->update($request->only(['status', 'notes']));

        // Create tracking event
        $shipping->trackingEvents()->create([
            'status' => $request->status,
            'location' => $request->location,
            'description' => $request->notes,
            'timestamp' => now()
        ]);

        if ($request->status === 'delivered') {
            $shipping->order->update(['status' => 'delivered', 'delivered_at' => now()]);
        }

        return new ShippingResource($shipping);
    }

    private function getTrackingData($trackingNumber, $carrier)
    {
        // Fake tracking data simulation
        return [
            'tracking_number' => $trackingNumber,
            'carrier' => $carrier,
            'status' => 'in_transit',
            'events' => [
                [
                    'date' => now()->subDays(2)->toDateTimeString(),
                    'status' => 'picked_up',
                    'location' => 'Origin Facility',
                    'description' => 'Package picked up from sender'
                ],
                [
                    'date' => now()->subDays(1)->toDateTimeString(),
                    'status' => 'in_transit',
                    'location' => 'Sorting Facility',
                    'description' => 'Package in transit to destination'
                ]
            ]
        ];
    }
}
