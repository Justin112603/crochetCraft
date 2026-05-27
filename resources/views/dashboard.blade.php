<x-app-layout>
    <x-slot name="header">
        <div class="dash-header-bar">
            <div class="dash-header-left">
                <span class="dash-header-eyebrow">OVERVIEW</span>
                <h2 class="dash-header-title">Dashboard</h2>
            </div>
            <div class="dash-header-right">
                <span class="dash-live-badge">
                    <span class="dash-live-dot"></span>
                    Live Data
                </span>
                <span class="dash-date">{{ now()->format('M d, Y') }}</span>
            </div>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap');

        :root {
            --ink: #0d0f14;
            --ink-mid: #1e2130;
            --surface: #f5f4f0;
            --card-bg: #ffffff;
            --accent: #e8ff47;
            --accent-2: #ff6b35;
            --accent-3: #4aaeff;
            --muted: #8b8fa8;
            --border: rgba(13,15,20,0.08);
            --shadow: 0 2px 20px rgba(13,15,20,0.07);
            --shadow-hover: 0 8px 40px rgba(13,15,20,0.13);
        }

        /* HEADER */
        .dash-header-bar {
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            padding: 4px 0;
        }
        .dash-header-eyebrow {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.18em;
            color: var(--muted);
            display: block;
            margin-bottom: 2px;
        }
        .dash-header-title {
            font-family: 'Syne', sans-serif;
            font-size: 1.35rem;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -0.02em;
            margin: 0;
        }
        .dash-header-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .dash-live-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: var(--ink);
            color: var(--accent);
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: 0.08em;
            padding: 5px 12px;
            border-radius: 20px;
        }
        .dash-live-dot {
            width: 6px;
            height: 6px;
            background: var(--accent);
            border-radius: 50%;
            animation: dashPulse 1.8s ease-in-out infinite;
        }
        @keyframes dashPulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.4; transform: scale(0.7); }
        }
        .dash-date {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 0.06em;
        }

        /* PAGE WRAPPER */
        .dash-page {
            padding: 32px 0 48px;
            background: var(--surface);
            min-height: calc(100vh - 80px);
        }
        .dash-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* SECTION LABEL */
        .dash-section-label {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.2em;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 16px;
            padding-left: 2px;
        }

        /* KPI GRID */
        .dash-kpi-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 16px;
            margin-bottom: 32px;
            animation: dashFadeUp 0.5s ease both;
        }
        @keyframes dashFadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .dash-kpi-grid .dash-card:nth-child(1) { animation-delay: 0.05s; }
        .dash-kpi-grid .dash-card:nth-child(2) { animation-delay: 0.10s; }
        .dash-kpi-grid .dash-card:nth-child(3) { animation-delay: 0.15s; }
        .dash-kpi-grid .dash-card:nth-child(4) { animation-delay: 0.20s; }

        /* KPI CARD */
        .dash-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 28px 26px 24px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
            transition: transform 0.25s ease, box-shadow 0.25s ease;
            animation: dashFadeUp 0.5s ease both;
            cursor: default;
        }
        .dash-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow-hover);
        }

        /* Accent bar on left */
        .dash-card::before {
            content: '';
            position: absolute;
            top: 20px;
            left: 0;
            width: 3px;
            height: 40px;
            border-radius: 0 3px 3px 0;
            background: var(--card-accent, var(--ink));
        }

        .dash-card-products { --card-accent: var(--accent-3); }
        .dash-card-orders   { --card-accent: var(--accent-2); }
        .dash-card-cart     { --card-accent: var(--accent); }
        .dash-card-profit   { --card-accent: #a78bfa; }

        /* Card top row */
        .dash-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 18px;
        }
        .dash-card-icon {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            background: var(--icon-bg, #f0f0f0);
        }
        .dash-card-products .dash-card-icon { background: rgba(74,174,255,0.12); }
        .dash-card-orders   .dash-card-icon { background: rgba(255,107,53,0.12); }
        .dash-card-cart     .dash-card-icon { background: rgba(232,255,71,0.18); }
        .dash-card-profit   .dash-card-icon { background: rgba(167,139,250,0.12); }

        .dash-card-badge {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            font-weight: 500;
            padding: 3px 9px;
            border-radius: 20px;
            letter-spacing: 0.05em;
            background: #f0fdf4;
            color: #16a34a;
        }
        .dash-card-badge.down {
            background: #fff1f0;
            color: #e03131;
        }

        /* Card label */
        .dash-card-label {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            font-weight: 400;
            letter-spacing: 0.08em;
            color: var(--muted);
            margin: 0 0 6px;
            text-transform: uppercase;
        }

        /* Card value */
        .dash-card-value {
            font-family: 'Syne', sans-serif;
            font-size: 2.4rem;
            font-weight: 800;
            color: var(--ink);
            letter-spacing: -0.04em;
            line-height: 1;
            margin: 0 0 14px;
        }

        /* Sparkline bar */
        .dash-sparkline {
            display: flex;
            align-items: flex-end;
            gap: 3px;
            height: 28px;
        }
        .dash-bar {
            flex: 1;
            border-radius: 3px 3px 0 0;
            background: var(--bar-color, #e2e4ea);
            transition: height 0.6s cubic-bezier(.4,0,.2,1);
            min-height: 3px;
        }

        /* ANALYTICS SECTION */
        .dash-analytics-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 16px;
            margin-bottom: 28px;
            animation: dashFadeUp 0.5s 0.25s ease both;
        }
        .dash-analytics-card {
            background: var(--card-bg);
            border-radius: 20px;
            padding: 28px 26px;
            border: 1px solid var(--border);
            box-shadow: var(--shadow);
        }
        .dash-analytics-title {
            font-family: 'Syne', sans-serif;
            font-size: 1rem;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.01em;
            margin: 0 0 22px;
        }

        /* SVG chart */
        .dash-chart-wrap {
            width: 100%;
            overflow: hidden;
        }
        .dash-chart-wrap svg {
            width: 100%;
            height: 160px;
            overflow: visible;
        }

        /* Donut chart */
        .dash-donut-wrap {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 20px;
        }
        .dash-donut-svg {
            width: 140px;
            height: 140px;
        }
        .dash-donut-label-center {
            text-anchor: middle;
            dominant-baseline: middle;
        }
        .dash-donut-legend {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .dash-legend-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }
        .dash-legend-left {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .dash-legend-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .dash-legend-name {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--muted);
            letter-spacing: 0.05em;
        }
        .dash-legend-val {
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }

        /* BOTTOM ROW */
        .dash-bottom-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            animation: dashFadeUp 0.5s 0.35s ease both;
        }
        .dash-table-wrap {
            overflow-x: auto;
        }
        table.dash-table {
            width: 100%;
            border-collapse: collapse;
        }
        table.dash-table th {
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.14em;
            text-transform: uppercase;
            color: var(--muted);
            text-align: left;
            padding: 0 0 12px;
            border-bottom: 1px solid var(--border);
        }
        table.dash-table td {
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
            padding: 13px 0;
            border-bottom: 1px solid var(--border);
        }
        table.dash-table tr:last-child td {
            border-bottom: none;
        }
        .dash-status-pill {
            display: inline-block;
            font-family: 'DM Mono', monospace;
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.06em;
            padding: 3px 10px;
            border-radius: 20px;
        }
        .status-completed { background: #f0fdf4; color: #16a34a; }
        .status-pending   { background: #fffbeb; color: #b45309; }
        .status-cancelled { background: #fff1f2; color: #be123c; }

        /* Progress bars */
        .dash-progress-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }
        .dash-progress-item {}
        .dash-progress-top {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-bottom: 7px;
        }
        .dash-progress-name {
            font-family: 'Syne', sans-serif;
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
        }
        .dash-progress-pct {
            font-family: 'DM Mono', monospace;
            font-size: 11px;
            color: var(--muted);
        }
        .dash-progress-track {
            height: 6px;
            background: #eee;
            border-radius: 10px;
            overflow: hidden;
        }
        .dash-progress-fill {
            height: 100%;
            border-radius: 10px;
            transition: width 1s cubic-bezier(.4,0,.2,1);
        }

        /* Responsive */
        @media (max-width: 900px) {
            .dash-kpi-grid { grid-template-columns: repeat(2, 1fr); }
            .dash-analytics-grid { grid-template-columns: 1fr; }
            .dash-bottom-grid { grid-template-columns: 1fr; }
        }
        @media (max-width: 540px) {
            .dash-kpi-grid { grid-template-columns: 1fr; }
            .dash-card-value { font-size: 2rem; }
        }
    </style>

    <div class="dash-page">
        <div class="dash-container">

            @if(auth()->user()->role === 'admin')

            {{-- KPI CARDS --}}
            <p class="dash-section-label">Key Metrics</p>
            <div class="dash-kpi-grid">

                {{-- Products --}}
                <div class="dash-card dash-card-products">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">📦</div>
                        <span class="dash-card-badge">+12%</span>
                    </div>
                    <p class="dash-card-label">Total Products</p>
                    <h2 class="dash-card-value">{{ $totalProducts }}</h2>
                    <div class="dash-sparkline" id="spark-products"></div>
                </div>

                {{-- Orders --}}
                <div class="dash-card dash-card-orders">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">🛒</div>
                        <span class="dash-card-badge">+8%</span>
                    </div>
                    <p class="dash-card-label">Total Orders</p>
                    <h2 class="dash-card-value">{{ $totalOrders }}</h2>
                    <div class="dash-sparkline" id="spark-orders"></div>
                </div>

                {{-- Cart --}}
                <div class="dash-card dash-card-cart">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">🛍️</div>
                        <span class="dash-card-badge down">-3%</span>
                    </div>
                    <p class="dash-card-label">Cart Items</p>
                    <h2 class="dash-card-value">{{ $cartItems }}</h2>
                    <div class="dash-sparkline" id="spark-cart"></div>
                </div>

                {{-- Profit --}}
                <div class="dash-card dash-card-profit">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">💰</div>
                        <span class="dash-card-badge">+21%</span>
                    </div>
                    <p class="dash-card-label">Total Profit</p>
                    <h2 class="dash-card-value">₱{{ number_format($totalProfit, 0) }}</h2>
                    <div class="dash-sparkline" id="spark-profit"></div>
                </div>

            </div>

            {{-- ANALYTICS ROW --}}
            <p class="dash-section-label">Analytics</p>
            <div class="dash-analytics-grid">

                {{-- Line chart --}}
                <div class="dash-analytics-card">
                    <p class="dash-analytics-title">Revenue Overview — Last 7 Days</p>
                    <div class="dash-chart-wrap">
                        <svg viewBox="0 0 500 160" xmlns="http://www.w3.org/2000/svg">
                            <defs>
                                <linearGradient id="lineGrad" x1="0" y1="0" x2="0" y2="1">
                                    <stop offset="0%" stop-color="#a78bfa" stop-opacity="0.25"/>
                                    <stop offset="100%" stop-color="#a78bfa" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                            <!-- Grid lines -->
                            <line x1="0" y1="40"  x2="500" y2="40"  stroke="#f0f0f0" stroke-width="1"/>
                            <line x1="0" y1="80"  x2="500" y2="80"  stroke="#f0f0f0" stroke-width="1"/>
                            <line x1="0" y1="120" x2="500" y2="120" stroke="#f0f0f0" stroke-width="1"/>
                            <!-- Area fill -->
                            <path d="M0,110 C60,90 100,60 150,70 S250,40 300,50 S400,30 500,45 L500,160 L0,160 Z"
                                  fill="url(#lineGrad)"/>
                            <!-- Line -->
                            <path d="M0,110 C60,90 100,60 150,70 S250,40 300,50 S400,30 500,45"
                                  fill="none" stroke="#a78bfa" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <!-- Dots -->
                            <circle cx="0"   cy="110" r="4" fill="#a78bfa"/>
                            <circle cx="83"  cy="65"  r="4" fill="#a78bfa"/>
                            <circle cx="166" cy="72"  r="4" fill="#a78bfa"/>
                            <circle cx="250" cy="43"  r="4" fill="#a78bfa"/>
                            <circle cx="333" cy="50"  r="4" fill="#a78bfa"/>
                            <circle cx="416" cy="33"  r="4" fill="#a78bfa"/>
                            <circle cx="500" cy="45"  r="5" fill="#a78bfa" stroke="#fff" stroke-width="2"/>
                            <!-- X-axis labels -->
                            <text x="0"   y="155" font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8">Mon</text>
                            <text x="72"  y="155" font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8">Tue</text>
                            <text x="155" y="155" font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8">Wed</text>
                            <text x="238" y="155" font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8">Thu</text>
                            <text x="321" y="155" font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8">Fri</text>
                            <text x="404" y="155" font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8">Sat</text>
                            <text x="487" y="155" font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8">Sun</text>
                        </svg>
                    </div>
                </div>

                {{-- Donut chart --}}
                <div class="dash-analytics-card">
                    <p class="dash-analytics-title">Order Status</p>
                    <div class="dash-donut-wrap">
                        <svg class="dash-donut-svg" viewBox="0 0 140 140">
                            <!-- Donut segments (r=50, circumference≈314) -->
                            <!-- Completed: 60% = 188.4 -->
                            <circle cx="70" cy="70" r="50" fill="none" stroke="#e8ff47" stroke-width="22"
                                stroke-dasharray="188 314" stroke-dashoffset="0"
                                transform="rotate(-90 70 70)" stroke-linecap="round"/>
                            <!-- Pending: 28% = 87.9 -->
                            <circle cx="70" cy="70" r="50" fill="none" stroke="#ff6b35" stroke-width="22"
                                stroke-dasharray="88 314" stroke-dashoffset="-188"
                                transform="rotate(-90 70 70)" stroke-linecap="round"/>
                            <!-- Cancelled: 12% = 37.7 -->
                            <circle cx="70" cy="70" r="50" fill="none" stroke="#4aaeff" stroke-width="22"
                                stroke-dasharray="38 314" stroke-dashoffset="-276"
                                transform="rotate(-90 70 70)" stroke-linecap="round"/>
                            <!-- Center label -->
                            <text x="70" y="65" class="dash-donut-label-center"
                                  font-family="Syne,sans-serif" font-size="20" font-weight="800" fill="#0d0f14">{{ $totalOrders }}</text>
                            <text x="70" y="82" class="dash-donut-label-center"
                                  font-family="DM Mono,monospace" font-size="9" fill="#8b8fa8" letter-spacing="1">ORDERS</text>
                        </svg>
                        <div class="dash-donut-legend">
                            <div class="dash-legend-row">
                                <div class="dash-legend-left">
                                    <span class="dash-legend-dot" style="background:#e8ff47;"></span>
                                    <span class="dash-legend-name">Completed</span>
                                </div>
                                <span class="dash-legend-val">60%</span>
                            </div>
                            <div class="dash-legend-row">
                                <div class="dash-legend-left">
                                    <span class="dash-legend-dot" style="background:#ff6b35;"></span>
                                    <span class="dash-legend-name">Pending</span>
                                </div>
                                <span class="dash-legend-val">28%</span>
                            </div>
                            <div class="dash-legend-row">
                                <div class="dash-legend-left">
                                    <span class="dash-legend-dot" style="background:#4aaeff;"></span>
                                    <span class="dash-legend-name">Cancelled</span>
                                </div>
                                <span class="dash-legend-val">12%</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            {{-- BOTTOM ROW --}}
            <div class="dash-bottom-grid">

                {{-- Recent Orders Table --}}
                <div class="dash-analytics-card">
                    <p class="dash-analytics-title">Recent Orders</p>
                    <div class="dash-table-wrap">
                        <table class="dash-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($recentOrders) && $recentOrders->count())
                                    @foreach($recentOrders as $order)
                                    <tr>
                                        <td>#{{ $order->id }}</td>
                                        <td>{{ $order->user->name ?? 'N/A' }}</td>
                                        <td>₱{{ number_format($order->total ?? 0, 2) }}</td>
                                        <td>
                                            <span class="dash-status-pill status-{{ strtolower($order->status ?? 'pending') }}">
                                                {{ ucfirst($order->status ?? 'Pending') }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                    {{-- Placeholder rows --}}
                                    <tr>
                                        <td>#1042</td><td>Maria Santos</td><td>₱1,240.00</td>
                                        <td><span class="dash-status-pill status-completed">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>#1041</td><td>Juan dela Cruz</td><td>₱880.50</td>
                                        <td><span class="dash-status-pill status-pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>#1040</td><td>Ana Reyes</td><td>₱3,100.00</td>
                                        <td><span class="dash-status-pill status-completed">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>#1039</td><td>Carlo Lim</td><td>₱560.00</td>
                                        <td><span class="dash-status-pill status-cancelled">Cancelled</span></td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Top Products --}}
                <div class="dash-analytics-card">
                    <p class="dash-analytics-title">Top Products</p>
                    <div class="dash-progress-list">
                        @if(isset($topProducts) && $topProducts->count())
                            @foreach($topProducts as $i => $product)
                            @php
                                $colors = ['#4aaeff','#ff6b35','#e8ff47','#a78bfa','#34d399'];
                                $pct = $product->sales_pct ?? (80 - $i * 14);
                            @endphp
                            <div class="dash-progress-item">
                                <div class="dash-progress-top">
                                    <span class="dash-progress-name">{{ $product->name }}</span>
                                    <span class="dash-progress-pct">{{ $pct }}%</span>
                                </div>
                                <div class="dash-progress-track">
                                    <div class="dash-progress-fill" style="width:{{ $pct }}%; background:{{ $colors[$i % count($colors)] }};"></div>
                                </div>
                            </div>
                            @endforeach
                        @else
                            {{-- Placeholder --}}
                            @php
                                $placeholders = [
                                    ['Beef Sinigang Mix', 82, '#4aaeff'],
                                    ['Lechon Sauce', 67, '#ff6b35'],
                                    ['Bagoong Balayan', 54, '#e8ff47'],
                                    ['Adobo Mix', 41, '#a78bfa'],
                                    ['Pancit Malabon', 29, '#34d399'],
                                ];
                            @endphp
                            @foreach($placeholders as $p)
                            <div class="dash-progress-item">
                                <div class="dash-progress-top">
                                    <span class="dash-progress-name">{{ $p[0] }}</span>
                                    <span class="dash-progress-pct">{{ $p[1] }}%</span>
                                </div>
                                <div class="dash-progress-track">
                                    <div class="dash-progress-fill" style="width:{{ $p[1] }}%; background:{{ $p[2] }};"></div>
                                </div>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            @endif {{-- end admin check --}}

        </div>
    </div>

    <script>
    (function() {
        // Sparkline data sets
        const sparks = {
            'spark-products': { data: [40,55,45,60,50,70,65], color: '#4aaeff' },
            'spark-orders':   { data: [30,50,40,70,55,65,80], color: '#ff6b35' },
            'spark-cart':     { data: [60,50,55,45,50,42,48], color: '#c8e800' },
            'spark-profit':   { data: [20,40,35,55,60,75,90], color: '#a78bfa' },
        };
        Object.entries(sparks).forEach(([id, cfg]) => {
            const el = document.getElementById(id);
            if (!el) return;
            const max = Math.max(...cfg.data);
            cfg.data.forEach(v => {
                const bar = document.createElement('div');
                bar.className = 'dash-bar';
                const pct = (v / max) * 100;
                bar.style.cssText = `height:0%; background:${cfg.color}; opacity:0.7; transition:height 0.8s cubic-bezier(.4,0,.2,1);`;
                el.appendChild(bar);
                // Animate in
                requestAnimationFrame(() => requestAnimationFrame(() => {
                    bar.style.height = pct + '%';
                }));
            });
        });
    })();
    </script>

</x-app-layout>