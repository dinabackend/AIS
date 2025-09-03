<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\InvoiceResource;
use App\Models\Invoice;
use App\Models\Order;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index(Request $request)
    {
        $invoices = Invoice::with(['order.customer', 'payments'])
            ->when($request->status, function($query, $status) {
                return $query->where('status', $status);
            })
            ->when($request->customer_id, function($query, $customerId) {
                return $query->whereHas('order', function($q) use ($customerId) {
                    $q->where('customer_id', $customerId);
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($request->get('per_page', 20));

        return InvoiceResource::collection($invoices);
    }

    public function generate(Request $request, $orderId)
    {
        $order = Order::with(['customer', 'items.product'])->findOrFail($orderId);

        $invoice = Invoice::create([
            'order_id' => $order->id,
            'invoice_number' => $this->generateInvoiceNumber(),
            'amount' => $order->total_amount,
            'tax_amount' => $order->tax_amount,
            'due_date' => now()->addDays(30),
            'status' => 'pending'
        ]);

        // Generate PDF invoice
        $pdf = $this->generateInvoicePDF($invoice);

        return new InvoiceResource($invoice);
    }

    public function markAsPaid($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->update([
            'status' => 'paid',
            'paid_at' => now()
        ]);

        return new InvoiceResource($invoice);
    }

    private function generateInvoiceNumber()
    {
        $lastInvoice = Invoice::latest('id')->first();
        $number = $lastInvoice ? $lastInvoice->id + 1 : 1;
        return 'INV-' . date('Y') . '-' . str_pad($number, 6, '0', STR_PAD_LEFT);
    }
}
