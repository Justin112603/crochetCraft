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

                <span class="dash-date">
                    {{ now()->format('M d, Y') }}
                </span>
            </div>
        </div>
    </x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap');

        :root {
            --ink: #0d0f14;
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

        .dash-header-bar{
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
            padding:4px 0;
        }

        .dash-header-eyebrow{
            font-family:'DM Mono', monospace;
            font-size:10px;
            font-weight:500;
            letter-spacing:.18em;
            color:var(--muted);
            display:block;
            margin-bottom:2px;
        }

        .dash-header-title{
            font-family:'Syne', sans-serif;
            font-size:1.35rem;
            font-weight:800;
            color:var(--ink);
            letter-spacing:-.02em;
            margin:0;
        }

        .dash-header-right{
            display:flex;
            align-items:center;
            gap:16px;
        }

        .dash-live-badge{
            display:flex;
            align-items:center;
            gap:6px;
            background:var(--ink);
            color:var(--accent);
            font-family:'DM Mono', monospace;
            font-size:11px;
            font-weight:500;
            letter-spacing:.08em;
            padding:5px 12px;
            border-radius:20px;
        }

        .dash-live-dot{
            width:6px;
            height:6px;
            background:var(--accent);
            border-radius:50%;
            animation:dashPulse 1.8s ease-in-out infinite;
        }

        @keyframes dashPulse{
            0%,100%{
                opacity:1;
                transform:scale(1);
            }
            50%{
                opacity:.4;
                transform:scale(.7);
            }
        }

        .dash-date{
            font-family:'DM Mono', monospace;
            font-size:11px;
            color:var(--muted);
            letter-spacing:.06em;
        }

        .dash-page{
            padding:32px 0 48px;
            background:var(--surface);
            min-height:calc(100vh - 80px);
        }

        .dash-container{
            max-width:1200px;
            margin:0 auto;
            padding:0 24px;
        }

        .dash-section-label{
            font-family:'DM Mono', monospace;
            font-size:10px;
            font-weight:500;
            letter-spacing:.2em;
            color:var(--muted);
            text-transform:uppercase;
            margin-bottom:16px;
            padding-left:2px;
        }

        .dash-kpi-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:16px;
            margin-bottom:32px;
        }

        .dash-card{
            background:var(--card-bg);
            border-radius:20px;
            padding:28px 26px 24px;
            border:1px solid var(--border);
            box-shadow:var(--shadow);
            position:relative;
            overflow:hidden;
            transition:.25s ease;
        }

        .dash-card:hover{
            transform:translateY(-4px);
            box-shadow:var(--shadow-hover);
        }

        .dash-card::before{
            content:'';
            position:absolute;
            top:20px;
            left:0;
            width:3px;
            height:40px;
            border-radius:0 3px 3px 0;
            background:var(--card-accent, var(--ink));
        }

        .dash-card-products{
            --card-accent:var(--accent-3);
        }

        .dash-card-orders{
            --card-accent:var(--accent-2);
        }

        .dash-card-cart{
            --card-accent:var(--accent);
        }

        .dash-card-profit{
            --card-accent:#a78bfa;
        }

        .dash-card-top{
            display:flex;
            align-items:flex-start;
            justify-content:space-between;
            margin-bottom:18px;
        }

        .dash-card-icon{
            width:42px;
            height:42px;
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:18px;
        }

        .dash-card-products .dash-card-icon{
            background:rgba(74,174,255,.12);
        }

        .dash-card-orders .dash-card-icon{
            background:rgba(255,107,53,.12);
        }

        .dash-card-cart .dash-card-icon{
            background:rgba(232,255,71,.18);
        }

        .dash-card-profit .dash-card-icon{
            background:rgba(167,139,250,.12);
        }

        .dash-card-badge{
            font-family:'DM Mono', monospace;
            font-size:10px;
            font-weight:500;
            padding:3px 9px;
            border-radius:20px;
            letter-spacing:.05em;
            background:#f0fdf4;
            color:#16a34a;
        }

        .dash-card-badge.down{
            background:#fff1f0;
            color:#e03131;
        }

        .dash-card-label{
            font-family:'DM Mono', monospace;
            font-size:11px;
            letter-spacing:.08em;
            color:var(--muted);
            margin:0 0 6px;
            text-transform:uppercase;
        }

        .dash-card-value{
            font-family:'Syne', sans-serif;
            font-size:2.4rem;
            font-weight:800;
            color:var(--ink);
            letter-spacing:-.04em;
            line-height:1;
            margin:0 0 14px;
        }

        .dash-sparkline{
            display:flex;
            align-items:flex-end;
            gap:3px;
            height:28px;
        }

        .dash-bar{
            flex:1;
            border-radius:3px 3px 0 0;
            min-height:3px;
        }

        .dash-analytics-grid{
            display:grid;
            grid-template-columns:1fr;
            gap:16px;
            margin-bottom:28px;
        }

        .dash-analytics-card{
            background:var(--card-bg);
            border-radius:20px;
            padding:28px 26px;
            border:1px solid var(--border);
            box-shadow:var(--shadow);
        }

        .dash-analytics-title{
            font-family:'Syne', sans-serif;
            font-size:1rem;
            font-weight:700;
            color:var(--ink);
            margin:0 0 22px;
        }

        .dash-donut-wrap{
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:20px;
        }

        .dash-donut-svg{
            width:140px;
            height:140px;
        }

        .dash-donut-label-center{
            text-anchor:middle;
            dominant-baseline:middle;
        }

        .dash-donut-legend{
            width:100%;
            display:flex;
            flex-direction:column;
            gap:10px;
        }

        .dash-legend-row{
            display:flex;
            align-items:center;
            justify-content:space-between;
        }

        .dash-legend-left{
            display:flex;
            align-items:center;
            gap:8px;
        }

        .dash-legend-dot{
            width:8px;
            height:8px;
            border-radius:50%;
        }

        .dash-legend-name{
            font-family:'DM Mono', monospace;
            font-size:11px;
            color:var(--muted);
        }

        .dash-legend-val{
            font-family:'Syne', sans-serif;
            font-size:13px;
            font-weight:700;
            color:var(--ink);
        }

        .dash-bottom-grid{
            display:grid;
            grid-template-columns:1fr;
            gap:16px;
        }

        .dash-table-wrap{
            overflow-x:auto;
        }

        table.dash-table{
            width:100%;
            border-collapse:collapse;
        }

        table.dash-table th{
            font-family:'DM Mono', monospace;
            font-size:10px;
            font-weight:500;
            letter-spacing:.14em;
            text-transform:uppercase;
            color:var(--muted);
            text-align:left;
            padding:0 0 12px;
            border-bottom:1px solid var(--border);
        }

        table.dash-table td{
            font-family:'Syne', sans-serif;
            font-size:13px;
            font-weight:600;
            color:var(--ink);
            padding:13px 0;
            border-bottom:1px solid var(--border);
        }

        .dash-status-pill{
            display:inline-block;
            font-family:'DM Mono', monospace;
            font-size:10px;
            padding:3px 10px;
            border-radius:20px;
        }

        .status-completed{
            background:#f0fdf4;
            color:#16a34a;
        }

        .status-pending{
            background:#fffbeb;
            color:#b45309;
        }

        .status-cancelled{
            background:#fff1f2;
            color:#be123c;
        }

        @media(max-width:900px){
            .dash-kpi-grid{
                grid-template-columns:repeat(2,1fr);
            }
        }

        @media(max-width:540px){
            .dash-kpi-grid{
                grid-template-columns:1fr;
            }

            .dash-card-value{
                font-size:2rem;
            }
        }
    </style>

    <div class="dash-page">
        <div class="dash-container">

            @if(auth()->user()->role === 'admin')

            <p class="dash-section-label">
                Key Metrics
            </p>

            <div class="dash-kpi-grid">

                <div class="dash-card dash-card-products">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">📦</div>
                        <span class="dash-card-badge">+12%</span>
                    </div>

                    <p class="dash-card-label">
                        Total Products
                    </p>

                    <h2 class="dash-card-value">
                        <span id="totalProducts">0</span>
                    </h2>

                    <div class="dash-sparkline" id="spark-products"></div>
                </div>

                <div class="dash-card dash-card-orders">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">🛒</div>
                        <span class="dash-card-badge">+8%</span>
                    </div>

                    <p class="dash-card-label">
                        Total Orders
                    </p>

                    <h2 class="dash-card-value">
                        <span id="totalOrders">0</span>
                    </h2>

                    <div class="dash-sparkline" id="spark-orders"></div>
                </div>

                <div class="dash-card dash-card-cart">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">🛍️</div>
                        <span class="dash-card-badge down">-3%</span>
                    </div>

                    <p class="dash-card-label">
                        Cart Items
                    </p>

                    <h2 class="dash-card-value">
                        <span id="cartItems">0</span>
                    </h2>

                    <div class="dash-sparkline" id="spark-cart"></div>
                </div>

                <div class="dash-card dash-card-profit">
                    <div class="dash-card-top">
                        <div class="dash-card-icon">💰</div>
                        <span class="dash-card-badge">+21%</span>
                    </div>

                    <p class="dash-card-label">
                        Total Profit
                    </p>

                    <h2 class="dash-card-value">
                        ₱<span id="totalProfit">0</span>
                    </h2>

                    <div class="dash-sparkline" id="spark-profit"></div>
                </div>

            </div>

            <p class="dash-section-label">
                Analytics
            </p>

            <div class="dash-analytics-grid">

                <div class="dash-analytics-card">

                    <p class="dash-analytics-title">
                        Order Status
                    </p>

                    <div class="dash-donut-wrap">

                        <svg class="dash-donut-svg" viewBox="0 0 140 140">

                            <circle
                                cx="70"
                                cy="70"
                                r="50"
                                fill="none"
                                stroke="#e8ff47"
                                stroke-width="22"
                                stroke-dasharray="188 314"
                                stroke-dashoffset="0"
                                transform="rotate(-90 70 70)"
                                stroke-linecap="round"
                            />

                            <circle
                                cx="70"
                                cy="70"
                                r="50"
                                fill="none"
                                stroke="#ff6b35"
                                stroke-width="22"
                                stroke-dasharray="88 314"
                                stroke-dashoffset="-188"
                                transform="rotate(-90 70 70)"
                                stroke-linecap="round"
                            />

                            <circle
                                cx="70"
                                cy="70"
                                r="50"
                                fill="none"
                                stroke="#4aaeff"
                                stroke-width="22"
                                stroke-dasharray="38 314"
                                stroke-dashoffset="-276"
                                transform="rotate(-90 70 70)"
                                stroke-linecap="round"
                            />

                            <text
                                x="70"
                                y="65"
                                class="dash-donut-label-center"
                                font-family="Syne,sans-serif"
                                font-size="20"
                                font-weight="800"
                                fill="#0d0f14"
                            >
                                <span id="totalOrders">0</span>
                            </text>

                            <text
                                x="70"
                                y="82"
                                class="dash-donut-label-center"
                                font-family="DM Mono,monospace"
                                font-size="9"
                                fill="#8b8fa8"
                                letter-spacing="1"
                            >
                                ORDERS
                            </text>

                        </svg>

                        <div class="dash-donut-legend">

                            <div class="dash-legend-row">
                                <div class="dash-legend-left">
                                    <span class="dash-legend-dot" style="background:#e8ff47;"></span>
                                    <span class="dash-legend-name">Completed</span>
                                </div>

                                <span class="dash-legend-val">
                                    <span id="pctCompleted">0</span>%
                                </span>
                            </div>

                            <div class="dash-legend-row">
                                <div class="dash-legend-left">
                                    <span class="dash-legend-dot" style="background:#ff6b35;"></span>
                                    <span class="dash-legend-name">Pending</span>
                                </div>

                                <span class="dash-legend-val">
                                    <span id="pctPending">0</span>%
                                </span>
                            </div>

                            <div class="dash-legend-row">
                                <div class="dash-legend-left">
                                    <span class="dash-legend-dot" style="background:#4aaeff;"></span>
                                    <span class="dash-legend-name">Cancelled</span>
                                </div>

                                <span class="dash-legend-val">
                                    <span id="pctCancelled">0</span>%
                                </span>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <div class="dash-bottom-grid">

                <div class="dash-analytics-card">

                    <p class="dash-analytics-title">
                        Recent Orders
                    </p>

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

                            <tbody id="recentOrdersTable"></tbody>

                                @if(isset($recentOrders) && $recentOrders->count())

                                    @foreach($recentOrders as $order)

                                    <tr>

                                        <td>
                                            #{{ $order->id }}
                                        </td>

                                        <td>
                                            {{ $order->user->name ?? 'N/A' }}
                                        </td>

                                        <td>
                                            ₱{{ number_format($order->total ?? 0, 2) }}
                                        </td>

                                        <td>
                                            <span class="dash-status-pill status-{{ strtolower($order->status ?? 'pending') }}">
                                                {{ ucfirst($order->status ?? 'Pending') }}
                                            </span>
                                        </td>

                                    </tr>

                                    @endforeach

                                @endif

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            @endif

        </div>
    </div>

    <script>
async function loadDashboardStats() {

    try {

        const response = await fetch('/dashboard/stats');

        const data = await response.json();

        // KPI
        document.getElementById('totalProducts').innerText = data.totalProducts;
        document.getElementById('totalOrders').innerText   = data.totalOrders;
        document.getElementById('cartItems').innerText     = data.cartItems;
        document.getElementById('totalProfit').innerText   = data.totalProfit;

        // Donut percentages
        document.getElementById('pctCompleted').innerText = data.pctCompleted;
        document.getElementById('pctPending').innerText   = data.pctPending;
        document.getElementById('pctCancelled').innerText = data.pctCancelled;

        // Recent Orders
        let html = '';

        data.recentOrders.forEach(order => {

            html += `
                <tr>
                    <td>#${order.id}</td>
                    <td>${order.user}</td>
                    <td>₱${order.total}</td>
                    <td>
                        <span class="dash-status-pill">
                            ${order.status}
                        </span>
                    </td>
                </tr>
            `;
        });

        document.getElementById('recentOrdersTable').innerHTML = html;

    } catch (error) {

        console.error('Realtime dashboard error:', error);

    }
}

// Initial load
loadDashboardStats();

// Refresh every 3 seconds
setInterval(loadDashboardStats, 3000);
</script>

</x-app-layout>