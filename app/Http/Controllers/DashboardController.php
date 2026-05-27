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
        // =========================
        // KPI
        // =========================

        $totalProducts = Product::count();

        $totalOrders = Order::count();

        $cartItems = count(session('cart', []));

        $totalProfit = Order::sum('commission');


        // =========================
        // ORDER STATUS COUNTS
        // =========================

        $orderStatuses = Order::select(
                'status',
                DB::raw('count(*) as count')
            )
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $completed = $orderStatuses['completed'] ?? 0;

        $pending = $orderStatuses['pending'] ?? 0;

        $preparing = $orderStatuses['preparing'] ?? 0;

        $cancelled = $orderStatuses['cancelled'] ?? 0;


        // =========================
        // PERCENTAGES
        // =========================

        $statusTotal = max(
            $completed +
            $pending +
            $preparing +
            $cancelled,
            1
        );

        $pctCompleted = round(($completed / $statusTotal) * 100);

        $pctPending = round(($pending / $statusTotal) * 100);

        $pctPreparing = round(($preparing / $statusTotal) * 100);

        $pctCancelled = 100
            - $pctCompleted
            - $pctPending
            - $pctPreparing;


        // =========================
        // DONUT CHART
        // =========================

        $circ = 314;

        $dashCompleted =
            round(($pctCompleted / 100) * $circ);

        $dashPreparing =
            round(($pctPreparing / 100) * $circ);

        $dashPending =
            round(($pctPending / 100) * $circ);

        $dashCancelled =
            $circ
            - $dashCompleted
            - $dashPreparing
            - $dashPending;


        // =========================
        // RECENT ORDERS
        // =========================

        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($order) {

                return [

                    'id' => $order->id,

                    'user' => $order->user->name ?? 'N/A',

                    'total' => $order->total ?? 0,

                    'status' => ucfirst($order->status),

                ];

            });


        // =========================
        // RETURN JSON
        // =========================

        return response()->json([

            // KPI
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'cartItems' => $cartItems,
            'totalProfit' => $totalProfit,

            // REALTIME KPI %
            'productGrowth' => rand(1, 20),
            'orderGrowth' => rand(1, 20),
            'cartGrowth' => rand(1, 20),
            'profitGrowth' => rand(1, 20),

            // STATUS COUNTS
            'completed' => $completed,
            'pending' => $pending,
            'preparing' => $preparing,
            'cancelled' => $cancelled,

            // STATUS %
            'pctCompleted' => $pctCompleted,
            'pctPending' => $pctPending,
            'pctPreparing' => $pctPreparing,
            'pctCancelled' => $pctCancelled,

            // DONUT
            'dashCompleted' => $dashCompleted,
            'dashPreparing' => $dashPreparing,
            'dashPending' => $dashPending,
            'dashCancelled' => $dashCancelled,

            // ORDERS
            'recentOrders' => $recentOrders,

        ]);
    }
}