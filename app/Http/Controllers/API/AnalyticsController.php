<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AnalyticsResource;
use App\Models\Product;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function dashboard()
    {
        $data = [
            'total_revenue' => Order::sum('total_amount'),
            'total_orders' => Order::count(),
            'total_customers' => Customer::count(),
            'total_products' => Product::count(),
            'monthly_revenue' => $this->getMonthlyRevenue(),
            'top_products' => $this->getTopProducts(),
            'recent_orders' => $this->getRecentOrders(),
            'conversion_rate' => $this->calculateConversionRate(),
        ];

        return response()->json($data);
    }

    public function sales(Request $request)
    {
        $period = $request->get('period', 'month');

        return response()->json([
            'sales_data' => $this->getSalesData($period),
            'growth_rate' => $this->calculateGrowthRate($period),
            'comparison' => $this->getComparisonData($period),
        ]);
    }

    public function inventory()
    {
        return response()->json([
            'low_stock_items' => Product::where('stock_quantity', '<=', 'min_stock')->count(),
            'out_of_stock' => Product::where('stock_quantity', 0)->count(),
            'total_inventory_value' => Product::sum(\DB::raw('stock_quantity * price')),
            'warehouse_utilization' => $this->getWarehouseUtilization(),
        ]);
    }

    private function getMonthlyRevenue()
    {
        return Order::selectRaw('MONTH(created_at) as month, SUM(total_amount) as revenue')
            ->whereYear('created_at', date('Y'))
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    private function getTopProducts()
    {
        return Product::join('order_items', 'products.id', '=', 'order_items.product_id')
            ->selectRaw('products.*, SUM(order_items.quantity) as total_sold')
            ->groupBy('products.id')
            ->orderBy('total_sold', 'desc')
            ->take(10)
            ->get();
    }

    private function getRecentOrders()
    {
        return Order::with(['customer', 'items.product'])
            ->latest()
            ->take(5)
            ->get();
    }

    private function calculateConversionRate()
    {
        $totalVisitors = 10000; // This would come from analytics service
        $totalOrders = Order::count();
        return ($totalOrders / $totalVisitors) * 100;
    }
}
