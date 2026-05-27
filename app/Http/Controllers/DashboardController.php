<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── KPI CARDS ─────────────────────────────────────────────
        $totalProducts = Product::count();
        $totalOrders   = Order::count();
        $cartItems     = count(session('cart', []));
        $totalProfit   = Order::sum('commission');

        // ── ORDER STATUS BREAKDOWN (donut chart) ──────────────────
        $orderStatuses = Order::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        $completed = $orderStatuses['completed'] ?? $orderStatuses['Completed'] ?? 0;
        $pending   = $orderStatuses['pending']   ?? $orderStatuses['Pending']   ?? 0;
        $cancelled = $orderStatuses['cancelled'] ?? $orderStatuses['Cancelled'] ?? 0;

        // Convert to percentages for the donut (avoid division by zero)
        $statusTotal   = max($completed + $pending + $cancelled, 1);
        $pctCompleted  = round(($completed / $statusTotal) * 100);
        $pctPending    = round(($pending   / $statusTotal) * 100);
        $pctCancelled  = 100 - $pctCompleted - $pctPending;

        // Donut stroke-dasharray values  (circumference = 2π×50 ≈ 314)
        $circ            = 314;
        $dashCompleted   = round(($pctCompleted  / 100) * $circ);
        $dashPending     = round(($pctPending    / 100) * $circ);
        $dashCancelled   = $circ - $dashCompleted - $dashPending;

        $offsetPending   = -$dashCompleted;
        $offsetCancelled = -($dashCompleted + $dashPending);

        // ── REVENUE LAST 7 DAYS (line chart) ──────────────────────
        $revenueWeek = Order::select(
                DB::raw('DATE(created_at) as date'),
                DB::raw('SUM(commission) as daily_profit')
            )
            ->where('created_at', '>=', now()->subDays(6)->startOfDay())
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->pluck('daily_profit', 'date')
            ->toArray();

        // Fill all 7 days (Mon→today), default 0 if no orders that day
        $revenuePoints = [];
        for ($i = 6; $i >= 0; $i--) {
            $day = now()->subDays($i)->toDateString();
            $revenuePoints[] = [
                'label' => now()->subDays($i)->format('D'),   // Mon, Tue …
                'value' => (float) ($revenueWeek[$day] ?? 0),
            ];
        }

        // ── RECENT ORDERS (table) ─────────────────────────────────
        // Adjust the relationship name if yours differs (e.g. ->with('buyer'))
        $recentOrders = Order::with('user')
            ->latest()
            ->take(5)
            ->get();

        // ── TOP PRODUCTS (progress bars) ─────────────────────────
        // orders table has no product_id — needs an order_items pivot to be
        // data-driven. Empty collection makes the blade show placeholders.
        $topProducts = collect();

        // ── RETURN VIEW ───────────────────────────────────────────
        return view('dashboard', compact(
            'totalProducts',
            'totalOrders',
            'cartItems',
            'totalProfit',
            // donut
            'pctCompleted', 'pctPending', 'pctCancelled',
            'dashCompleted', 'dashPending', 'dashCancelled',
            'offsetPending', 'offsetCancelled',
            // line chart
            'revenuePoints',
            // table + progress bars
            'recentOrders',
            'topProducts'
        ));
    }
}