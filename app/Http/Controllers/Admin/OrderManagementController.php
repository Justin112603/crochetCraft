<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->paginate(10);

        return view(
            'admin.orders',
            compact('orders')
        );
    }

    public function updateStatus(Request $request, Order $order)
{
    if ($order->status === 'cancelled') {
        return back()->with('error', 'Cannot update a cancelled order.');
    }

    $request->validate([
        'status' => ['required', 'in:preparing,out_for_delivery,received'],
    ]);

    $order->update(['status' => $request->status]);

    return back()->with('success', 'Order #' . $order->id . ' status updated successfully.');
}
}