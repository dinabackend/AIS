<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $customers = Customer::with(['orders', 'addresses'])
            ->when($request->search, function($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                           ->orWhere('email', 'like', "%{$search}%")
                           ->orWhere('phone', 'like', "%{$search}%");
            })
            ->when($request->type, function($query, $type) {
                return $query->where('type', $type);
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 20));

        return CustomerResource::collection($customers);
    }

    public function show($id)
    {
        $customer = Customer::with(['orders.items.product', 'addresses', 'paymentMethods'])
            ->findOrFail($id);
        return new CustomerResource($customer);
    }

    public function orders($id)
    {
        $customer = Customer::findOrFail($id);
        $orders = $customer->orders()
            ->with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json([
            'customer' => new CustomerResource($customer),
            'orders' => $orders
        ]);
    }

    public function analytics($id)
    {
        $customer = Customer::findOrFail($id);

        $analytics = [
            'total_orders' => $customer->orders()->count(),
            'total_spent' => $customer->orders()->sum('total_amount'),
            'avg_order_value' => $customer->orders()->avg('total_amount'),
            'last_order_date' => $customer->orders()->latest()->first()?->created_at,
            'favorite_products' => $customer->getFavoriteProducts(),
            'lifetime_value' => $customer->calculateLifetimeValue(),
        ];

        return response()->json($analytics);
    }
}
