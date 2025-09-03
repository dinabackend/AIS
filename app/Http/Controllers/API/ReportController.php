<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReportResource;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function salesReport(Request $request)
    {
        $period = $request->get('period', 'month');
        $startDate = $request->get('start_date', now()->subMonth());
        $endDate = $request->get('end_date', now());

        $data = [
            'total_sales' => Order::whereBetween('created_at', [$startDate, $endDate])->sum('total_amount'),
            'total_orders' => Order::whereBetween('created_at', [$startDate, $endDate])->count(),
            'avg_order_value' => Order::whereBetween('created_at', [$startDate, $endDate])->avg('total_amount'),
            'top_customers' => $this->getTopCustomers($startDate, $endDate),
            'sales_by_day' => $this->getSalesByDay($startDate, $endDate),
        ];

        return response()->json($data);
    }

    public function inventoryReport()
    {
        return response()->json([
            'low_stock_products' => Product::where('stock_quantity', '<=', 'min_stock')->count(),
            'out_of_stock_products' => Product::where('stock_quantity', 0)->count(),
            'total_inventory_value' => Product::sum(\DB::raw('stock_quantity * cost_price')),
            'slow_moving_items' => $this->getSlowMovingItems(),
        ]);
    }

    public function financialReport(Request $request)
    {
        $month = $request->get('month', now()->month);
        $year = $request->get('year', now()->year);

        return response()->json([
            'revenue' => Order::whereMonth('created_at', $month)
                             ->whereYear('created_at', $year)
                             ->sum('total_amount'),
            'expenses' => $this->calculateExpenses($month, $year),
            'profit_margin' => $this->calculateProfitMargin($month, $year),
            'tax_liability' => $this->calculateTaxLiability($month, $year),
        ]);
    }

    private function getTopCustomers($startDate, $endDate)
    {
        return Customer::join('orders', 'customers.id', '=', 'orders.customer_id')
            ->whereBetween('orders.created_at', [$startDate, $endDate])
            ->selectRaw('customers.*, SUM(orders.total_amount) as total_spent')
            ->groupBy('customers.id')
            ->orderBy('total_spent', 'desc')
            ->take(10)
            ->get();
    }

    private function getSalesByDay($startDate, $endDate)
    {
        return Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, SUM(total_amount) as sales')
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    private function getSlowMovingItems()
    {
        return Product::whereDoesntHave('orderItems', function($query) {
            $query->where('created_at', '>=', now()->subMonths(3));
        })->get();
    }
}
