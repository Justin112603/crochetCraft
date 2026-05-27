<x-app-layout>

    <x-slot name="header">
        <div class="dash-header-bar">

            <div class="dash-header-left">
                <span class="dash-header-eyebrow">
                    OVERVIEW
                </span>

                <h2 class="dash-header-title">
                    Dashboard
                </h2>
            </div>

            <div class="dash-header-right">

                <span class="dash-live-badge">
                    <span class="dash-live-dot"></span>
                    Live Data
                </span>

                <span class="dash-date">
                    {{ now()->format('M d, Y h:i A') }}
                </span>

            </div>

        </div>
    </x-slot>

    <style>

        @import url('https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=DM+Mono:wght@300;400;500&display=swap');

        :root{
            --ink:#0d0f14;
            --surface:#f5f4f0;
            --card-bg:#ffffff;
            --accent:#e8ff47;
            --accent-2:#ff6b35;
            --accent-3:#4aaeff;
            --accent-4:#a78bfa;
            --muted:#8b8fa8;
            --border:rgba(13,15,20,.08);
            --shadow:0 2px 20px rgba(13,15,20,.07);
            --shadow-hover:0 8px 40px rgba(13,15,20,.13);
        }

        body{
            background:var(--surface);
        }

        .dash-page{
            padding:30px 0 60px;
        }

        .dash-container{
            max-width:1200px;
            margin:auto;
            padding:0 24px;
        }

        .dash-header-bar{
            display:flex;
            align-items:flex-end;
            justify-content:space-between;
        }

        .dash-header-eyebrow{
            font-family:'DM Mono', monospace;
            font-size:10px;
            letter-spacing:.18em;
            color:var(--muted);
        }

        .dash-header-title{
            font-family:'Syne', sans-serif;
            font-size:1.5rem;
            font-weight:800;
            color:var(--ink);
            margin-top:3px;
        }

        .dash-header-right{
            display:flex;
            align-items:center;
            gap:14px;
        }

        .dash-live-badge{
            display:flex;
            align-items:center;
            gap:6px;
            background:var(--ink);
            color:var(--accent);
            font-family:'DM Mono', monospace;
            font-size:11px;
            padding:6px 12px;
            border-radius:999px;
        }

        .dash-live-dot{
            width:7px;
            height:7px;
            background:var(--accent);
            border-radius:50%;
            animation:pulse 1.5s infinite;
        }

        @keyframes pulse{
            0%,100%{
                transform:scale(1);
                opacity:1;
            }
            50%{
                transform:scale(.6);
                opacity:.4;
            }
        }

        .dash-date{
            font-family:'DM Mono', monospace;
            font-size:11px;
            color:var(--muted);
        }

        .dash-section-label{
            font-family:'DM Mono', monospace;
            font-size:10px;
            letter-spacing:.2em;
            color:var(--muted);
            text-transform:uppercase;
            margin-bottom:14px;
        }

        .dash-kpi-grid{
            display:grid;
            grid-template-columns:repeat(4,1fr);
            gap:18px;
            margin-bottom:28px;
        }

        .dash-card{
            background:var(--card-bg);
            border-radius:24px;
            padding:28px;
            border:1px solid var(--border);
            box-shadow:var(--shadow);
            transition:.25s ease;
            position:relative;
            overflow:hidden;
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
            width:4px;
            height:45px;
            border-radius:0 4px 4px 0;
            background:var(--card-accent);
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
            --card-accent:var(--accent-4);
        }

        .dash-card-top{
            display:flex;
            justify-content:space-between;
            margin-bottom:20px;
        }

        .dash-card-icon{
            width:46px;
            height:46px;
            border-radius:14px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:19px;
        }

        .dash-card-products .dash-card-icon{
            background:rgba(74,174,255,.14);
        }

        .dash-card-orders .dash-card-icon{
            background:rgba(255,107,53,.14);
        }

        .dash-card-cart .dash-card-icon{
            background:rgba(232,255,71,.25);
        }

        .dash-card-profit .dash-card-icon{
            background:rgba(167,139,250,.14);
        }

        .dash-card-badge{
            background:#f0fdf4;
            color:#16a34a;
            padding:4px 10px;
            border-radius:999px;
            font-family:'DM Mono', monospace;
            font-size:10px;
        }

        .dash-card-label{
            font-family:'DM Mono', monospace;
            font-size:11px;
            color:var(--muted);
            text-transform:uppercase;
            margin-bottom:8px;
        }

        .dash-card-value{
            font-family:'Syne', sans-serif;
            font-size:2.5rem;
            font-weight:800;
            color:var(--ink);
        }

        .dash-analytics-card{
            background:white;
            border-radius:24px;
            padding:28px;
            border:1px solid var(--border);
            box-shadow:var(--shadow);
            margin-bottom:24px;
        }

        .dash-analytics-title{
            font-family:'Syne', sans-serif;
            font-size:1rem;
            font-weight:700;
            margin-bottom:22px;
            color:var(--ink);
        }

        .dash-donut-wrap{
            display:flex;
            flex-direction:column;
            align-items:center;
            gap:20px;
        }

        .dash-donut-svg{
            width:180px;
            height:180px;
        }

        .dash-donut-label-center{
            text-anchor:middle;
            dominant-baseline:middle;
        }

        .dash-donut-legend{
            width:100%;
            display:flex;
            flex-direction:column;
            gap:12px;
        }

        .dash-legend-row{
            display:flex;
            justify-content:space-between;
            align-items:center;
        }

        .dash-legend-left{
            display:flex;
            align-items:center;
            gap:10px;
        }

        .dash-legend-dot{
            width:10px;
            height:10px;
            border-radius:50%;
        }

        .dash-legend-name{
            font-family:'DM Mono', monospace;
            font-size:11px;
            color:var(--muted);
        }

        .dash-legend-val{
            font-family:'Syne', sans-serif;
            font-weight:700;
            color:var(--ink);
        }

        .dash-table-wrap{
            overflow-x:auto;
        }

        .dash-table{
            width:100%;
            border-collapse:collapse;
        }

        .dash-table th{
            text-align:left;
            padding-bottom:14px;
            border-bottom:1px solid var(--border);
            font-family:'DM Mono', monospace;
            font-size:10px;
            letter-spacing:.12em;
            color:var(--muted);
        }

        .dash-table td{
            padding:14px 0;
            border-bottom:1px solid var(--border);
            font-family:'Syne', sans-serif;
            font-size:14px;
            font-weight:600;
        }

        .dash-status-pill{
            padding:5px 12px;
            border-radius:999px;
            font-family:'DM Mono', monospace;
            font-size:10px;
        }

        .status-completed{
            background:#f0fdf4;
            color:#16a34a;
        }

        .status-pending{
            background:#fffbeb;
            color:#b45309;
        }

        .status-preparing{
            background:#eff6ff;
            color:#2563eb;
        }

        .status-cancelled{
            background:#fff1f2;
            color:#be123c;
        }

        @media(max-width:1000px){

            .dash-kpi-grid{
                grid-template-columns:repeat(2,1fr);
            }

        }

        @media(max-width:600px){

            .dash-kpi-grid{
                grid-template-columns:1fr;
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

                        <div class="dash-card-icon">
                            📦
                        </div>

                        <span class="dash-card-badge">
                            <span id="productGrowth">0</span>%
                        </span>

                    </div>

                    <p class="dash-card-label">
                        Total Products
                    </p>

                    <h2 class="dash-card-value">
                        <span id="totalProducts">0</span>
                    </h2>

                </div>

                <div class="dash-card dash-card-orders">

                    <div class="dash-card-top">

                        <div class="dash-card-icon">
                            🛒
                        </div>

                        <span class="dash-card-badge">
                            <span id="orderGrowth">0</span>%
                        </span>

                    </div>

                    <p class="dash-card-label">
                        Total Orders
                    </p>

                    <h2 class="dash-card-value">
                        <span id="totalOrders">0</span>
                    </h2>

                </div>

                <div class="dash-card dash-card-cart">

                    <div class="dash-card-top">

                        <div class="dash-card-icon">
                            🛍️
                        </div>

                        <span class="dash-card-badge">
                            <span id="cartGrowth">0</span>%
                        </span>

                    </div>

                    <p class="dash-card-label">
                        Cart Items
                    </p>

                    <h2 class="dash-card-value">
                        <span id="cartItems">0</span>
                    </h2>

                </div>

                <div class="dash-card dash-card-profit">

                    <div class="dash-card-top">

                        <div class="dash-card-icon">
                            💰
                        </div>

                        <span class="dash-card-badge">
                            <span id="profitGrowth">0</span>%
                        </span>

                    </div>

                    <p class="dash-card-label">
                        Total Profit
                    </p>

                    <h2 class="dash-card-value">
                        ₱<span id="totalProfit">0</span>
                    </h2>

                </div>

            </div>

            <div class="dash-analytics-card">

                <p class="dash-analytics-title">
                    Order Status
                </p>

                <div class="dash-donut-wrap">

                    <svg class="dash-donut-svg" viewBox="0 0 180 180">

                        <circle
                            cx="90"
                            cy="90"
                            r="55"
                            fill="none"
                            stroke="#e8ff47"
                            stroke-width="20"
                            id="circleCompleted"
                            stroke-dasharray="0 314"
                            transform="rotate(-90 90 90)"
                            stroke-linecap="round"
                        />

                        <circle
                            cx="90"
                            cy="90"
                            r="55"
                            fill="none"
                            stroke="#2563eb"
                            stroke-width="20"
                            id="circlePreparing"
                            stroke-dasharray="0 314"
                            transform="rotate(-90 90 90)"
                            stroke-linecap="round"
                        />

                        <circle
                            cx="90"
                            cy="90"
                            r="55"
                            fill="none"
                            stroke="#ff6b35"
                            stroke-width="20"
                            id="circlePending"
                            stroke-dasharray="0 314"
                            transform="rotate(-90 90 90)"
                            stroke-linecap="round"
                        />

                        <circle
                            cx="90"
                            cy="90"
                            r="55"
                            fill="none"
                            stroke="#be123c"
                            stroke-width="20"
                            id="circleCancelled"
                            stroke-dasharray="0 314"
                            transform="rotate(-90 90 90)"
                            stroke-linecap="round"
                        />

                        <text
                            x="90"
                            y="85"
                            class="dash-donut-label-center"
                            font-family="Syne"
                            font-size="26"
                            font-weight="800"
                            fill="#0d0f14"
                            id="donutOrders"
                        >
                            0
                        </text>

                        <text
                            x="90"
                            y="108"
                            class="dash-donut-label-center"
                            font-family="DM Mono"
                            font-size="10"
                            fill="#8b8fa8"
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
                                <span class="dash-legend-dot" style="background:#2563eb;"></span>
                                <span class="dash-legend-name">Preparing</span>
                            </div>

                            <span class="dash-legend-val">
                                <span id="pctPreparing">0</span>%
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
                                <span class="dash-legend-dot" style="background:#be123c;"></span>
                                <span class="dash-legend-name">Cancelled</span>
                            </div>

                            <span class="dash-legend-val">
                                <span id="pctCancelled">0</span>%
                            </span>

                        </div>

                    </div>

                </div>

            </div>

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

                    </table>

                </div>

            </div>

            @endif

        </div>

    </div>

<script>

async function loadDashboardStats(){

    try{

        const response = await fetch('/dashboard/stats');

        const data = await response.json();

        document.getElementById('totalProducts').innerText = data.totalProducts;
        document.getElementById('totalOrders').innerText = data.totalOrders;
        document.getElementById('donutOrders').innerHTML = data.totalOrders;
        document.getElementById('cartItems').innerText = data.cartItems;

        document.getElementById('totalProfit').innerText =
            Number(data.totalProfit).toLocaleString();

        document.getElementById('productGrowth').innerText = data.productGrowth;
        document.getElementById('orderGrowth').innerText = data.orderGrowth;
        document.getElementById('cartGrowth').innerText = data.cartGrowth;
        document.getElementById('profitGrowth').innerText = data.profitGrowth;

        document.getElementById('pctCompleted').innerText = data.pctCompleted;
        document.getElementById('pctPreparing').innerText = data.pctPreparing;
        document.getElementById('pctPending').innerText = data.pctPending;
        document.getElementById('pctCancelled').innerText = data.pctCancelled;

        document.getElementById('circleCompleted')
            .setAttribute('stroke-dasharray', `${data.dashCompleted} 314`);

        document.getElementById('circlePreparing')
            .setAttribute('stroke-dasharray', `${data.dashPreparing} 314`);

        document.getElementById('circlePending')
            .setAttribute('stroke-dasharray', `${data.dashPending} 314`);

        document.getElementById('circleCancelled')
            .setAttribute('stroke-dasharray', `${data.dashCancelled} 314`);

        document.getElementById('circlePreparing')
            .setAttribute('stroke-dashoffset', `-${data.dashCompleted}`);

        document.getElementById('circlePending')
            .setAttribute(
                'stroke-dashoffset',
                `-${data.dashCompleted + data.dashPreparing}`
            );

        document.getElementById('circleCancelled')
            .setAttribute(
                'stroke-dashoffset',
                `-${data.dashCompleted + data.dashPreparing + data.dashPending}`
            );

        let html = '';

        data.recentOrders.forEach(order => {

            let statusClass = '';

            switch(order.status.toLowerCase()){

                case 'completed':
                    statusClass = 'status-completed';
                    break;

                case 'pending':
                    statusClass = 'status-pending';
                    break;

                case 'preparing':
                    statusClass = 'status-preparing';
                    break;

                case 'cancelled':
                    statusClass = 'status-cancelled';
                    break;
            }

            html += `
                <tr>

                    <td>#${order.id}</td>

                    <td>${order.user}</td>

                    <td>₱${parseFloat(order.total).toLocaleString()}</td>

                    <td>
                        <span class="dash-status-pill ${statusClass}">
                            ${order.status}
                        </span>
                    </td>

                </tr>
            `;
        });

        document.getElementById('recentOrdersTable').innerHTML = html;

    }catch(error){

        console.error('Realtime dashboard error:', error);

    }

}

loadDashboardStats();

setInterval(loadDashboardStats, 3000);

</script>

</x-app-layout>