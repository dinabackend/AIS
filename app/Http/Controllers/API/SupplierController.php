<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\SupplierResource;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::with(['products', 'orders'])
            ->when($request->search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%");
            })
            ->when($request->country, function($query, $country) {
                return $query->where('country', $country);
            })
            ->orderBy('name')
            ->paginate($request->get('per_page', 20));

        return SupplierResource::collection($suppliers);
    }

    public function show($id)
    {
        $supplier = Supplier::with(['products', 'orders.orderItems', 'contracts'])
            ->findOrFail($id);
        return new SupplierResource($supplier);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:suppliers,email',
            'phone' => 'required|string',
            'address' => 'required|string',
            'country' => 'required|string',
            'tax_number' => 'nullable|string',
            'payment_terms' => 'nullable|integer',
        ]);

        $supplier = Supplier::create($request->all());
        return new SupplierResource($supplier);
    }

    public function contracts($id)
    {
        $supplier = Supplier::findOrFail($id);
        $contracts = $supplier->contracts()
            ->with(['terms'])
            ->orderBy('start_date', 'desc')
            ->get();

        return response()->json([
            'supplier' => new SupplierResource($supplier),
            'contracts' => $contracts
        ]);
    }

    public function performance($id)
    {
        $supplier = Supplier::findOrFail($id);

        $performance = [
            'total_orders' => $supplier->orders()->count(),
            'total_amount' => $supplier->orders()->sum('total_amount'),
            'avg_delivery_time' => $supplier->orders()->avg('delivery_days'),
            'on_time_delivery_rate' => $supplier->calculateOnTimeDeliveryRate(),
            'quality_rating' => $supplier->calculateQualityRating(),
        ];

        return response()->json($performance);
    }
}
