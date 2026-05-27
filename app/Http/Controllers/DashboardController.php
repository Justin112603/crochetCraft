<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function stats()
    {
        // KPI
        $totalProducts = Product::count();
        $totalOrders   = Order::count();
        $cartItems     = count(session('cart', []));
        $totalProfit   = Order::sum('commission');

        // ORDER STATUS
        $completed = Order::where('status', 'completed')->count();
        $pending   = Order::where('status', 'pending')->count();
        $cancelled = Order::where('status', 'cancelled')->count();

        $statusTotal = max($completed + $pending + $cancelled, 1);

        $pctCompleted = round(($completed / $statusTotal) * 100);
        $pctPending   = round(($pending / $statusTotal) * 100);
        $pctCancelled = 100 - $pctCompleted - $pctPending;

        // RECENT ORDERS
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {
                return [
                    'id'     => $order->id,
                    'user'   => $order->user->name ?? 'N/A',
                    'total'  => number_format($order->total, 2),
                    'status' => ucfirst($order->status),
                ];
            });

        return response()->json([
            'totalProducts' => $totalProducts,
            'totalOrders'   => $totalOrders,
            'cartItems'     => $cartItems,
            'totalProfit'   => number_format($totalProfit, 0),

            'pctCompleted'  => $pctCompleted,
            'pctPending'    => $pctPending,
            'pctCancelled'  => $pctCancelled,

            'recentOrders'  => $recentOrders,
        ]);
    }
}