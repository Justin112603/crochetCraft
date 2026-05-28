<x-app-layout>
    <x-slot name="title">My Profile</x-slot>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=DM+Sans:wght@300;400;500&display=swap');

        .pf * {
            font-family: 'DM Sans', sans-serif;
        }

        .pf .serif {
            font-family: 'Playfair Display', Georgia, serif;
        }

        /* ── Layout ── */
        .pf-wrap {
            max-width: 1100px;
            margin: 0 auto;
            padding: 56px 32px 100px;
        }

        .pf-grid {
            display: grid;
            grid-template-columns: 250px 1fr;
            gap: 24px;
            align-items: start;
        }

        /* ── Sidebar ── */
        .sidebar {
            background: #fffdf9;
            border: 1px solid #e8ddd0;
            border-radius: 22px;
            padding: 28px 16px;
            position: sticky;
            top: 88px;
        }

        .sb-avatar {
            width: 68px;
            height: 68px;
            border-radius: 50%;
            background: #f0e4d0;
            border: 2.5px solid #e0cdb8;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Playfair Display', serif;
            font-size: 1.6rem;
            font-weight: 600;
            color: #8b5e3c;
            margin: 0 auto 10px;
        }

        .sb-name {
            font-family: 'Playfair Display', serif;
            font-size: 1rem;
            font-weight: 600;
            color: #2e1a0e;
            text-align: center;
            margin-bottom: 2px;
        }

        .sb-email {
            font-size: 0.74rem;
            color: #9d7d6a;
            text-align: center;
            margin-bottom: 22px;
        }

        .nav-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 10px 14px;
            border-radius: 11px;
            border: none;
            background: transparent;
            font-size: 0.85rem;
            font-weight: 500;
            color: #7a5c3e;
            cursor: pointer;
            text-align: left;
            transition: .18s;
        }

        .nav-btn:hover {
            background: #f5ece0;
            color: #2e1a0e;
        }

        .nav-btn.active {
            background: rgba(196, 105, 63, .12);
            color: #c4693f;
            font-weight: 600;
        }

        .nav-btn .icon {
            font-size: 16px;
            width: 20px;
            text-align: center;
        }

        .sb-divider {
            border: none;
            border-top: 1px solid #e8ddd0;
            margin: 10px 0;
        }

        /* ── Panel ── */
        .panel {
            display: none;
        }

        .panel.active {
            display: block;
        }

        /* ── Cards ── */
        .card {
            background: #fffdf9;
            border: 1px solid #e8ddd0;
            border-radius: 22px;
            padding: 28px;
            margin-bottom: 20px;
        }

        .card-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 500;
            color: #2e1a0e;
            margin-bottom: 20px;
        }

        /* ── Stat grid ── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: #fffdf9;
            border: 1px solid #e8ddd0;
            border-radius: 18px;
            padding: 20px;
        }

        .stat-val {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: #c4693f;
        }

        .stat-lbl {
            font-size: .78rem;
            color: #9d7d6a;
            margin-top: 3px;
        }

        /* ── Form fields ── */
        .f-lbl {
            display: block;
            margin-bottom: 7px;
            font-size: 11px;
            font-weight: 500;
            letter-spacing: .09em;
            text-transform: uppercase;
            color: #a07858;
        }

        .f-inp {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #e2d0bc;
            border-radius: 12px;
            background: #f5ede3;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: #3e2712;
            outline: none;
            transition: border-color .2s;
            box-sizing: border-box;
        }

        .f-inp:focus {
            border-color: #c4693f;
        }

        .f-inp[readonly] {
            color: #7a5c3e;
            cursor: default;
        }

        .f-group {
            margin-bottom: 16px;
        }

        /* ── Buttons ── */
        .btn-primary {
            background: #c4693f;
            color: #fff;
            border: none;
            padding: 13px 22px;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s, transform .15s;
        }

        .btn-primary:hover {
            background: #a85230;
            transform: translateY(-1px);
        }

        .btn-ghost {
            background: #f5ede3;
            color: #8b5e3c;
            border: none;
            padding: 13px 18px;
            border-radius: 12px;
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-ghost:hover {
            background: #ecdcc8;
        }

        .btn-sm {
            padding: 9px 16px;
            border-radius: 9px;
            border: 1px solid #e8ddd0;
            background: #fffdf9;
            font-size: 13px;
            font-weight: 500;
            color: #7a5c3e;
            cursor: pointer;
            transition: .15s;
        }

        .btn-sm:hover {
            border-color: #c4693f;
            color: #c4693f;
        }

        /* ── Order cards ── */
        .order-card {
            border: 1px solid #e8ddd0;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 14px;
            background: #fffdf9;
        }

        .order-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 14px;
        }

        .order-id {
            font-weight: 600;
            font-size: 14px;
            color: #2e1a0e;
        }

        .order-date {
            font-size: .75rem;
            color: #9d7d6a;
            margin-top: 2px;
        }

        .order-foot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 14px;
            border-top: 1px solid #e8ddd0;
        }

        .order-amt {
            font-family: 'Playfair Display', serif;
            font-size: 1.15rem;
            font-weight: 600;
            color: #c4693f;
        }

        .badge {
            padding: 4px 11px;
            border-radius: 999px;
            font-size: .68rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
        }

        .badge-pending {
            background: rgba(245, 158, 11, .1);
            color: #f59e0b;
        }

        .badge-processing {
            background: rgba(59, 130, 246, .1);
            color: #3b82f6;
        }

        .badge-delivered {
            background: rgba(34, 197, 94, .1);
            color: #22c55e;
        }

        .badge-cancelled {
            background: rgba(239, 68, 68, .1);
            color: #ef4444;
        }

        .badge-preparing {
            background: rgba(59, 130, 246, .1);
            color: #3b82f6;
        }

        .badge-out {
            background: rgba(168, 85, 247, .1);
            color: #a855f7;
        }

        .badge-received {
            background: rgba(34, 197, 94, .1);
            color: #22c55e;
        }

        /* ── Alerts ── */
        .alert-success {
            background: #edf5e6;
            border: 1px solid #b8d9a0;
            color: #3d6b2c;
            border-radius: 12px;
            padding: 13px 16px;
            font-size: 13px;
            margin-bottom: 18px;
        }

        .info-note {
            background: #fdf4e8;
            border: 1px solid #eedcc4;
            border-left: 3px solid #c4903f;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 13px;
            color: #7d6b60;
            margin-top: 16px;
        }

        /* ── Address card ── */
        .address-card {
            border: 1px solid #e8ddd0;
            border-radius: 14px;
            padding: 16px;
            background: #fffdf9;
            margin-bottom: 18px;
        }

        .address-lbl {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .09em;
            color: #a07858;
            font-weight: 500;
        }

        .address-val {
            font-size: 14px;
            color: #3e2712;
            margin-top: 6px;
            line-height: 1.6;
        }

        /* ── Withdrawal panel ── */
        .withdraw-stat {
            background: linear-gradient(135deg, #c4693f 0%, #a85230 100%);
            border-radius: 18px;
            padding: 28px;
            color: #fff;
            margin-bottom: 20px;
        }

        .withdraw-stat .ws-lbl {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: .1em;
            opacity: .8;
            margin-bottom: 8px;
        }

        .withdraw-stat .ws-val {
            font-family: 'Playfair Display', serif;
            font-size: 2.4rem;
            font-weight: 600;
        }

        .withdraw-stat .ws-sub {
            font-size: 12px;
            opacity: .7;
            margin-top: 4px;
        }


        /* ── Modal ── */
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(46, 26, 14, .45);
            z-index: 9999;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .modal-box {
            background: #fffdf9;
            width: 100%;
            max-width: 620px;
            border-radius: 26px;
            overflow: hidden;
            max-height: 90vh;
            overflow-y: auto;
            animation: fadeUp .25s ease;
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .modal-head {
            padding: 24px 28px;
            border-bottom: 1px solid #e8ddd0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fffdf9;
        }

        .modal-tag {
            font-size: 11px;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: #a07858;
            margin-bottom: 5px;
        }

        .modal-close {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            border: none;
            background: #f0e4d0;
            cursor: pointer;
            font-size: 16px;
            color: #7a5c3e;
            transition: .15s;
        }

        .modal-close:hover {
            background: #e0cdb8;
        }

        .modal-body {
            padding: 24px 28px;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 18px;
        }

        .detail-chip {
            background: #f5ede3;
            border-radius: 14px;
            padding: 16px;
        }

        .detail-chip .dc-lbl {
            font-size: 11px;
            color: #9d7d6a;
            margin-bottom: 5px;
        }

        .detail-chip .dc-val {
            font-size: 14px;
            font-weight: 600;
            color: #2e1a0e;
        }

        .modal-section {
            border: 1px solid #e8ddd0;
            border-radius: 16px;
            padding: 18px;
            margin-bottom: 16px;
        }

        .modal-section-title {
            font-family: 'Playfair Display', serif;
            font-size: 15px;
            font-weight: 500;
            color: #2e1a0e;
            margin-bottom: 14px;
        }

        .modal-row {
            display: flex;
            justify-content: space-between;
            padding: 13px 0;
            border-bottom: 1px dashed #e8ddd0;
        }

        .modal-row:last-child {
            border-bottom: none;
        }

        .modal-row-lbl {
            font-size: 13px;
            color: #9d7d6a;
        }

        .modal-row-val {
            font-size: 13px;
            font-weight: 500;
            color: #2e1a0e;
        }

        .modal-total-row {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            padding: 16px 0 0;
        }

        @media(max-width: 768px) {
            .pf-grid {
                grid-template-columns: 1fr;
            }

            .stat-grid {
                grid-template-columns: 1fr 1fr;
            }

            .pf-wrap {
                padding: 32px 16px 80px;
            }

            .detail-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    @php
        $user = auth()->user();
        $orderCount = $user->orders()->count();
        $pendingCount = $user->orders()->where('status', 'pending')->count();
        $totalSpent = $user->orders()->sum(\DB::raw('total + 50'));
        $commission = auth()->user()
            ->orders()
            ->whereNotNull('commission')
            ->whereNull('withdrawn_at')
            ->sum('commission');
        $recentOrders = $user->orders()->latest()->take(3)->get();
        $allOrders = $user->orders()->latest()->get();
    @endphp

    <div class="pf">
        <div class="pf-wrap">
            <div class="pf-grid">

                {{-- ── SIDEBAR ── --}}
                <aside class="sidebar">

                    <div class="sb-avatar">{{ strtoupper(substr($user->name, 0, 1)) }}</div>
                    <div class="sb-name">{{ $user->name }}</div>
                    <div class="sb-email">{{ $user->email }}</div>

                    <nav style="display:flex;flex-direction:column;gap:2px;">
                        <button class="nav-btn active" onclick="showPanel('overview',this)">
                            <span class="icon">◈</span> Overview
                        </button>
                        <button class="nav-btn" onclick="showPanel('orders',this)">
                            <span class="icon">📦</span> Orders
                        </button>
                        <button class="nav-btn" onclick="showPanel('edit',this)">
                            <span class="icon">✏️</span> Edit Profile
                        </button>
                        <button class="nav-btn" onclick="showPanel('password',this)">
                            <span class="icon">🔒</span> Change Password
                        </button>
                        <button class="nav-btn" onclick="showPanel('address',this)">
                            <span class="icon">📍</span> Address
                        </button>
                        <hr class="sb-divider">

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-btn" style="width:100%;">
                                <span class="icon">→</span> Logout
                            </button>
                        </form>
                    </nav>

                </aside>

                {{-- ── CONTENT ── --}}
                <div>

                    {{-- OVERVIEW --}}
                    <div id="panel-overview" class="panel active">

                        <div class="stat-grid">
                            <div class="stat-card">
                                <div class="stat-val">{{ $orderCount }}</div>
                                <div class="stat-lbl">Total Orders</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-val">{{ $pendingCount }}</div>
                                <div class="stat-lbl">Pending</div>
                            </div>
                            <div class="stat-card">
                                <div class="stat-val">₱{{ number_format($totalSpent, 2) }}</div>
                                <div class="stat-lbl">Total Spent</div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-title">Recent Orders</div>

                            @forelse($recentOrders as $order)
                                @include('profile._order-card', ['order' => $order, 'btnLabel' => 'View Order'])
                            @empty
                                <p style="color:#9d7d6a;font-size:14px;">No orders yet.</p>
                            @endforelse
                        </div>

                    </div>

                    {{-- ORDERS --}}
                    <div id="panel-orders" class="panel">
                        <div class="card">
                            <div class="card-title">Order History</div>

                            @forelse($allOrders as $order)
                                @include('profile._order-card', ['order' => $order, 'btnLabel' => 'View Details'])
                            @empty
                                <p style="color:#9d7d6a;font-size:14px;">No orders found.</p>
                            @endforelse
                        </div>
                    </div>

                    {{-- EDIT PROFILE --}}
                    <div id="panel-edit" class="panel">
                        <div class="card">
                            <div class="card-title">Edit Profile</div>

                            @if(session('status') === 'profile-updated')
                                <div class="alert-success">✓ Profile updated successfully.</div>
                            @endif

                            <form action="{{ route('profile.update') }}" method="POST">
                                @csrf @method('PATCH')

                                <div class="f-group">
                                    <label class="f-lbl">Full Name</label>
                                    <input type="text" name="name" value="{{ old('name', $user->name) }}" class="f-inp">
                                </div>

                                <div class="f-group">
                                    <label class="f-lbl">Email Address</label>
                                    <input type="email" name="email" value="{{ old('email', $user->email) }}"
                                        class="f-inp">
                                </div>

                                <div class="f-group">
                                    <label class="f-lbl">Mobile Number</label>
                                    <input type="text" name="phone" value="{{ old('phone', $user->phone) }}"
                                        placeholder="e.g. 09XXXXXXXXX" class="f-inp">
                                    @error('phone')
                                        <p style="color:#c4693f;font-size:12px;margin-top:5px;">{{ $message }}</p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn-primary">Save Changes</button>

                            </form>
                        </div>
                    </div>

                    {{-- CHANGE PASSWORD --}}
                    <div id="panel-password" class="panel">
                        <div class="card">
                            <div class="card-title">Change Password</div>

                            @if(session('status') === 'password-updated')
                                <div class="alert-success">✓ Password updated successfully.</div>
                            @endif

                            <form action="{{ route('password.update') }}" method="POST">
                                @csrf @method('PUT')

                                <div class="f-group">
                                    <label class="f-lbl">Current Password</label>
                                    <input type="password" name="current_password" class="f-inp">
                                </div>
                                <div class="f-group">
                                    <label class="f-lbl">New Password</label>
                                    <input type="password" name="password" class="f-inp">
                                </div>
                                <div class="f-group">
                                    <label class="f-lbl">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="f-inp">
                                </div>

                                <button type="submit" class="btn-primary">Update Password</button>
                            </form>
                        </div>
                    </div>

                    {{-- ADDRESS --}}
                    <div id="panel-address" class="panel">
                        <div class="card">
                            <div
                                style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                                <div class="card-title" style="margin-bottom:0;">Address</div>
                                <button type="button" onclick="toggleEl('addressForm')" class="btn-primary"
                                    style="padding:10px 16px;font-size:13px;">
                                    + Add / Edit
                                </button>
                            </div>

                            @if(session('status') === 'address-updated')
                                <div class="alert-success">✓ Address saved successfully.</div>
                            @endif

                            <div class="address-card">
                                <div class="address-lbl">Default Address</div>
                                <div class="address-val">
                                    {{ $user->address ?: 'No address added yet.' }}
                                </div>
                            </div>

                            {{-- ADDRESS FORM — posts to a dedicated address route --}}
                            <div id="addressForm" style="display:none;">
                                <form action="{{ route('profile.address') }}" method="POST">
                                    @csrf @method('PATCH')

                                    <div class="f-group">
                                        <label class="f-lbl">Complete Address</label>
                                        <textarea name="address" rows="4" class="f-inp"
                                            placeholder="Enter your complete address..."
                                            style="resize:none;">{{ old('address', $user->address) }}</textarea>
                                    </div>

                                    <div style="display:flex;gap:10px;flex-wrap:wrap;">
                                        <button type="button" onclick="useMyLocation()" class="btn-ghost">
                                            📍 Use Current Location
                                        </button>
                                        <button type="submit" class="btn-primary">Save Address</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>{{-- end content --}}

            </div>
        </div>
    </div>

    {{-- ── ORDER MODAL ── --}}
    <div id="orderModal" class="modal-overlay" onclick="if(event.target===this)closeModal()">

        <div class="modal-box">

            <div class="modal-head">

                <div>
                    <div class="modal-tag">
                        Order Details
                    </div>

                    <div class="serif" id="mOrderId" style="font-size:1.5rem;font-weight:600;color:#2e1a0e;"></div>
                </div>

                <button class="modal-close" onclick="closeModal()">
                    ✕
                </button>

            </div>

            <div class="modal-body">

                <div class="detail-grid">

                    <div class="detail-chip">
                        <div class="dc-lbl">
                            Order Date
                        </div>

                        <div class="dc-val" id="mDate"></div>
                    </div>

                    <div class="detail-chip">
                        <div class="dc-lbl">
                            Payment
                        </div>

                        <div class="dc-val" id="mPayment" style="text-transform:uppercase;"></div>
                    </div>

                </div>

                <div class="detail-chip" style="margin-bottom:18px;">

                    <div class="dc-lbl" style="margin-bottom:8px;">
                        Status
                    </div>

                    <div id="mStatus"></div>

                </div>

                <div class="modal-section">

                    <div class="modal-section-title">
                        Product
                    </div>

                    <div style="display:flex;gap:14px;align-items:center;">

                        <img id="mImg" src="" style="
                            width:72px;
                            height:72px;
                            object-fit:cover;
                            border-radius:12px;
                            border:1px solid #eee7da;
                        ">

                        <div>

                            <div id="mProduct" style="
                                font-weight:600;
                                color:#2e1a0e;
                                font-size:15px;
                            "></div>

                            <div style="
                                font-size:13px;
                                color:#9d7d6a;
                                margin-top:3px;
                            ">
                                Qty:
                                <span id="mQty"></span>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="modal-section">

                    <div class="modal-section-title">
                        Customer
                    </div>

                    <div class="modal-row">
                        <span class="modal-row-lbl">Name</span>
                        <span class="modal-row-val" id="mName"></span>
                    </div>

                    <div class="modal-row">
                        <span class="modal-row-lbl">Email</span>
                        <span class="modal-row-val" id="mEmail"></span>
                    </div>

                    <div class="modal-row">
                        <span class="modal-row-lbl">Phone</span>
                        <span class="modal-row-val" id="mPhone"></span>
                    </div>

                    <div class="modal-row">
                        <span class="modal-row-lbl">Address</span>

                        <span class="modal-row-val" id="mAddress" style="max-width:300px;text-align:right;"></span>
                    </div>

                </div>

                <div class="modal-section">

                    <div class="modal-section-title">
                        Payment Summary
                    </div>

                    <div class="modal-row">
                        <span class="modal-row-lbl">Subtotal</span>
                        <span class="modal-row-val" id="mSubtotal"></span>
                    </div>

                    <div class="modal-row">
                        <span class="modal-row-lbl">Shipping</span>
                        <span class="modal-row-val">₱50.00</span>
                    </div>

                    <div class="modal-total-row">

                        <span style="
                            font-size:15px;
                            font-weight:600;
                            color:#2e1a0e;
                        ">
                            Total
                        </span>

                        <span class="serif" id="mTotal" style="
                            font-size:1.4rem;
                            font-weight:600;
                            color:#c4693f;
                        "></span>

                    </div>

                </div>

                {{-- CANCEL BUTTON CONTAINER --}}
                <div id="cancelOrderContainer">
                    <button class="btn-sm" onclick="openOrderModal(
        '{{ $order->id }}',
        '{{ $order->created_at->format('M d, Y h:i A') }}',
        '{{ strtolower($order->status) }}',
        '{{ number_format($order->total ?? 0, 2) }}',
        '{{ number_format(($order->total ?? 0) + 50, 2) }}',
        '{{ $order->payment_method ?? 'COD' }}',
        '{{ asset('storage/' . ($order->product->image ?? 'products/default.png')) }}',
        '{{ $order->product->name ?? 'Product' }}',
        '{{ $order->quantity ?? 1 }}',
        '{{ auth()->user()->name }}',
        '{{ auth()->user()->email }}',
        '{{ auth()->user()->phone ?? 'N/A' }}',
        '{{ auth()->user()->address ?? 'N/A' }}',
        '{{ route('orders.cancel', $order->id) }}'
    )">
                        {{ $btnLabel ?? 'View Details' }}
                    </button>
                </div>


            </div>

        </div>

    </div>

<script>
        

        /* ── Panel switching ── */
        function showPanel(id, btn) {

            document.querySelectorAll('.panel').forEach(p => {
                p.classList.remove('active');
            });

            document.querySelectorAll('.nav-btn').forEach(b => {
                b.classList.remove('active');
            });

            document.getElementById('panel-' + id)
                .classList.add('active');

            btn.classList.add('active');
        }

        /* ── Toggle helper ── */
        function toggleEl(id) {

            const el = document.getElementById(id);

            el.style.display =
                el.style.display === 'none'
                    ? 'block'
                    : 'none';
        }

        /* ── STATUS COLORS ── */
        const statusStyles = {

            pending: {
                bg: 'rgba(245,158,11,.1)',
                color: '#f59e0b',
                label: 'Pending'
            },

            preparing: {
                bg: 'rgba(59,130,246,.1)',
                color: '#3b82f6',
                label: 'Preparing'
            },

            completed: {
                bg: 'rgba(34,197,94,.1)',
                color: '#22c55e',
                label: 'Completed'
            },

            cancelled: {
                bg: 'rgba(239,68,68,.1)',
                color: '#ef4444',
                label: 'Cancelled'
            },
        };

        /* ── OPEN ORDER MODAL ── */
        function openOrderModal(
            id,
            date,
            status,
            subtotal,
            total,
            payment,
            image,
            product,
            qty,
            name,
            email,
            phone,
            address,
            cancelUrl
        ) {

            const s = statusStyles[status.toLowerCase()] || {
                bg: '#f0e4d0',
                color: '#7a5c3e',
                label: status
            };

            document.getElementById('mOrderId').innerText =
                '#ORDER-' + id;

            document.getElementById('mDate').innerText =
                date;

            document.getElementById('mPayment').innerText =
                payment;

            document.getElementById('mSubtotal').innerText =
                '₱' + subtotal;

            document.getElementById('mTotal').innerText =
                '₱' + parseFloat(total.replace(/,/g, '')).toFixed(2);

            document.getElementById('mImg').src =
                image;

            document.getElementById('mProduct').innerText =
                product;

            document.getElementById('mQty').innerText =
                qty;

            document.getElementById('mName').innerText =
                name;

            document.getElementById('mEmail').innerText =
                email;

            document.getElementById('mPhone').innerText =
                phone;

            document.getElementById('mAddress').innerText =
                address;

            document.getElementById('mStatus').innerHTML = `
            <span style="
                background:${s.bg};
                color:${s.color};
                padding:6px 14px;
                border-radius:999px;
                font-size:12px;
                font-weight:700;
                text-transform:uppercase;
                letter-spacing:.05em;
            ">
                ${s.label}
            </span>
        `;

            /* REMOVE OLD BUTTON */
            document.getElementById('cancelOrderContainer')
                .innerHTML = '';

            /* SHOW CANCEL ONLY IF PENDING */
            if (status.toLowerCase() === 'pending') {

                cancelBtn.innerHTML = `
        <form method="POST" action="${cancelUrl}">
            @csrf
            @method('PATCH')

            <button type="submit"
                style="
                    background:#ef4444;
                    color:white;
                    border:none;
                    padding:12px 18px;
                    border-radius:12px;
                    font-size:13px;
                    font-weight:600;
                    cursor:pointer;
                    width:100%;
                    margin-top:16px;
                "
                onclick="return confirm('Cancel this order?')"
            >
                Cancel Order
            </button>
        </form>
                `;

            } else {

                cancelBtn.innerHTML = '';

            }

            /* ── CLOSE MODAL ── */
            function closeModal() {

                document.getElementById('orderModal').style.display =
                    'none';
            }

            /* ── GEOLOCATION ── */
            async function useMyLocation() {

                if (!navigator.geolocation) {
                    return alert('Geolocation not supported.');
                }

                navigator.geolocation.getCurrentPosition(
                    async pos => {

                        try {

                            const r = await fetch(
                                `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${pos.coords.latitude}&lon=${pos.coords.longitude}`
                            );

                            const d = await r.json();

                            document.querySelector(
                                '#addressForm textarea[name="address"]'
                            ).value = d.display_name || '';

                        } catch {

                            alert('Could not fetch address.');
                        }
                    },

                    () => alert('Location permission denied.')
                );
            }
}
</script>



</x-app-layout>