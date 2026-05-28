<x-app-layout>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600&family=DM+Sans:wght@300;400;500&display=swap');

    .cart-page * { font-family: 'DM Sans', sans-serif; }
    .cart-page h1, .cart-page h2, .cart-heading { font-family: 'Playfair Display', Georgia, serif; }

    .cart-item-card {
        background: #fffdf9; border: 1px solid #e8ddd0; border-radius: 20px;
        transition: box-shadow 0.25s ease, transform 0.2s ease;
    }
    .cart-item-card:hover { box-shadow: 0 8px 32px rgba(139,90,60,0.1); transform: translateY(-2px); }

    .qty-btn {
        width: 34px; height: 34px; display: flex; align-items: center; justify-content: center;
        background: #faf5ee; border: 1px solid #e0d3c0; color: #7a5c3e;
        font-size: 18px; line-height: 1; cursor: pointer; transition: background 0.15s;
    }
    .qty-btn:hover { background: #f0e4d0; }
    .qty-dec { border-radius: 10px 0 0 10px; }
    .qty-inc { border-radius: 0 10px 10px 0; }

    .qty-value {
        width: 44px; height: 34px; display: flex; align-items: center; justify-content: center;
        border-top: 1px solid #e0d3c0; border-bottom: 1px solid #e0d3c0;
        background: #fff; font-size: 14px; font-weight: 500; color: #3e2712;
    }

    .remove-btn {
        font-size: 12px; font-weight: 500; letter-spacing: 0.04em; color: #b07a60;
        text-transform: uppercase; background: none; border: none; cursor: pointer;
        padding: 4px 0; transition: color 0.15s;
    }
    .remove-btn:hover { color: #8b3a1e; }

    .custom-checkbox {
        appearance: none; -webkit-appearance: none;
        width: 18px; height: 18px; border: 1.5px solid #c4a07a; border-radius: 5px;
        background: #fff; cursor: pointer; position: relative;
        transition: background 0.15s, border-color 0.15s; flex-shrink: 0; margin-top: 2px;
    }
    .custom-checkbox:checked { background: #c4693f; border-color: #c4693f; }
    .custom-checkbox:checked::after {
        content: ''; position: absolute; left: 4px; top: 1px;
        width: 6px; height: 10px; border: 2px solid #fff;
        border-top: none; border-left: none; transform: rotate(42deg);
    }

    .summary-card { background: #fffdf9; border: 1px solid #e8ddd0; border-radius: 24px; }

    .checkout-btn {
        display: block; text-align: center; text-decoration: none;
        background: #c4693f; color: #fff; border: none; border-radius: 14px;
        padding: 16px 24px; font-family: 'DM Sans', sans-serif;
        font-size: 15px; font-weight: 500; letter-spacing: 0.03em;
        width: 100%; transition: background 0.2s, transform 0.15s;
        box-sizing: border-box; cursor: pointer;
    }
    .checkout-btn:hover { background: #a85230; transform: translateY(-1px); }
    .checkout-btn:active { transform: translateY(0); }
    .checkout-btn:disabled {
        background: #d6c4b4; cursor: not-allowed; transform: none;
    }

    .divider-line { border: none; border-top: 1px dashed #e0d3c0; margin: 16px 0; }
    .product-img { width: 96px; height: 96px; object-fit: cover; border-radius: 14px; border: 1px solid #eee7da; }

    .page-tag {
        display: inline-block; font-size: 11px; font-weight: 500;
        letter-spacing: 0.12em; text-transform: uppercase; color: #b08060;
        background: #f5ece0; border-radius: 20px; padding: 4px 14px; margin-bottom: 14px;
    }

    .shipping-badge {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: 12px; color: #6a8c5a; background: #edf5e6;
        border-radius: 20px; padding: 4px 12px; font-weight: 500;
    }

    .success-alert {
        background: #edf5e6; border: 1px solid #b8d9a0; color: #3d6b2c;
        border-radius: 14px; padding: 14px 20px; font-size: 14px; margin-bottom: 24px;
    }

    .error-alert {
        background: #fde8e8; border: 1px solid #f5b8b8; color: #9b2c2c;
        border-radius: 14px; padding: 14px 20px; font-size: 14px; margin-bottom: 24px;
    }

    .select-all-bar {
        background: #fffdf9; border: 1px solid #e8ddd0; border-radius: 14px;
        padding: 14px 20px; display: flex; align-items: center; gap: 12px;
    }

    .empty-cart-wrap {
        background: #fffdf9; border: 1px solid #e8ddd0; border-radius: 28px;
        padding: 80px 32px; text-align: center;
    }

    .shop-link {
        display: inline-block; background: #c4693f; color: #fff; text-decoration: none;
        border-radius: 14px; padding: 14px 32px; font-size: 14px; font-weight: 500;
        letter-spacing: 0.03em; transition: background 0.2s;
    }
    .shop-link:hover { background: #a85230; }

    .row-label { font-size: 13px; color: #9d7d6a; }
    .row-value { font-size: 13px; color: #3e2712; font-weight: 500; }
</style>

<div class="cart-page max-w-6xl mx-auto px-5 py-12">

    <div class="mb-10">
        <span class="page-tag">✦ Your bag</span>
        <h1 class="cart-heading text-4xl font-semibold text-[#2e1a0e] leading-tight">Shopping Cart</h1>
        <p class="text-[#9d7d6a] mt-2 text-sm tracking-wide">Handpicked with love — review your crochet selections below.</p>
    </div>

    @if(session('success'))
        <div id="success-alert" class="success-alert">✓ &nbsp;{{ session('success') }}</div>
        <script>
            setTimeout(() => {
                const el = document.getElementById('success-alert');
                if (el) { el.style.transition = 'opacity 0.5s'; el.style.opacity = '0'; setTimeout(() => el.remove(), 500); }
            }, 5000);
        </script>
    @endif

    @if(session('error'))
        <div class="error-alert">✕ &nbsp;{{ session('error') }}</div>
    @endif

    @php
        $cart     = session('cart', []);
        $selected = session('cart_selected', array_keys($cart)); // default: all selected
    @endphp

    @if(count($cart) > 0)

    {{-- MAIN SELECTION FORM — wraps all checkboxes --}}
    <form action="{{ route('cart.select') }}" method="POST" id="selectionForm">
        @csrf

        <div class="grid lg:grid-cols-3 gap-8 items-start">

            {{-- LEFT: CART ITEMS --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- SELECT ALL --}}
                <div class="select-all-bar">
                    <input type="checkbox" id="selectAll" class="custom-checkbox">
                    <label for="selectAll" class="text-sm font-medium text-[#2e1a0e] cursor-pointer select-none">
                        Select all items
                    </label>
                </div>

                @foreach($cart as $id => $item)
                    @php $subtotal = $item['price'] * $item['quantity']; @endphp

                    <div class="cart-item-card p-5 flex gap-5 items-start">

                        {{-- CHECKBOX — name="selected_items[]" so it's submitted in the form --}}
                        <div class="pt-1">
                            <input type="checkbox"
                                   name="selected_items[]"
                                   value="{{ $id }}"
                                   class="item-checkbox custom-checkbox"
                                   data-id="{{ $id }}"
                                   data-price="{{ $subtotal }}"
                                   {{ in_array($id, $selected) ? 'checked' : '' }}
                                   onchange="saveSelection()">
                        </div>

                        <img src="{{ asset('storage/' . $item['image']) }}"
                             alt="{{ $item['name'] }}"
                             class="product-img">

                        <div class="flex-1 min-w-0">

                            <div class="flex justify-between items-start gap-3">
                                <div>
                                    <h2 class="cart-heading text-lg font-medium text-[#2e1a0e] leading-snug">
                                        {{ $item['name'] }}
                                    </h2>
                                    <p class="text-[#b08060] text-sm mt-0.5 font-light">
                                        ₱{{ number_format($item['price'], 2) }} each
                                    </p>
                                </div>

                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    
                                    <button type="submit" class="remove-btn">Remove</button>
                                </form>
                            </div>

                            <hr class="divider-line">

                            <div class="flex items-center justify-between">

                                <div class="flex items-center">
                                    <form action="{{ route('cart.decrease', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="qty-btn qty-dec">−</button>
                                    </form>
                                    <div class="qty-value">{{ $item['quantity'] }}</div>
                                    <form action="{{ route('cart.increase', $id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="qty-btn qty-inc">+</button>
                                    </form>
                                </div>

                                <div class="text-right">
                                    <p class="text-xs text-[#b08060] font-light uppercase tracking-widest mb-0.5">Subtotal</p>
                                    <p class="text-lg font-semibold text-[#c4693f]">₱{{ number_format($subtotal, 2) }}</p>
                                </div>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- RIGHT: ORDER SUMMARY --}}
            <div class="sticky top-24">
                <div class="summary-card p-7">

                    <h2 class="cart-heading text-2xl font-semibold text-[#2e1a0e] mb-6">Order Summary</h2>

                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="row-label">Subtotal</span>
                            <span class="row-value" id="subtotalText">₱0.00</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="row-label">Shipping</span>
                            <span class="shipping-badge">✦ ₱50.00 flat</span>
                        </div>
                    </div>

                    <hr style="border:none;border-top:1px dashed #ddd0c0;margin:20px 0;">

                    <div class="flex justify-between items-center mb-7">
                        <span class="text-[#2e1a0e] font-medium text-base">Total</span>
                        <span class="cart-heading text-2xl font-semibold text-[#c4693f]" id="totalText">₱0.00</span>
                    </div>

                    {{-- CHECKOUT BUTTON — submits the selection form then redirects --}}
                    <button type="submit"
                            form="selectionForm"
                            id="checkoutBtn"
                            class="checkout-btn"
                            disabled>
                        Checkout →
                    </button>

                    <p class="text-center text-[#b8a08a] text-xs mt-4 tracking-wide">
                        Secure checkout · Handcrafted with care
                    </p>

                </div>
            </div>

        </div>
    </form>

    @else

    <div class="empty-cart-wrap">
        <div style="font-size:60px;margin-bottom:20px;opacity:0.6;">🧶</div>
        <h2 class="cart-heading text-3xl font-semibold text-[#2e1a0e] mb-3">Your cart is empty</h2>
        <p class="text-[#9d7d6a] mb-8 text-sm max-w-xs mx-auto leading-relaxed">
            You haven't added anything yet. Explore our handcrafted collection and find something you love.
        </p>
        <a href="{{ route('shop') }}" class="shop-link">Browse the shop →</a>
    </div>

    @endif

</div>

<script>
    const checkboxes  = document.querySelectorAll('.item-checkbox');
    const selectAll   = document.getElementById('selectAll');
    const checkoutBtn = document.getElementById('checkoutBtn');

    function updateTotals() {
        let subtotal = 0;
        let anyChecked = false;

        checkboxes.forEach(cb => {
            if (cb.checked) {
                subtotal += parseFloat(cb.dataset.price);
                anyChecked = true;
            }
        });

        const total = subtotal > 0 ? subtotal + 50 : 0;
        document.getElementById('subtotalText').innerText = '₱' + subtotal.toFixed(2);
        document.getElementById('totalText').innerText    = '₱' + total.toFixed(2);

        // ENABLE checkout only when at least one item is selected
        checkoutBtn.disabled = !anyChecked;

        // Sync select-all state
        if (selectAll) {
            selectAll.checked = [...checkboxes].every(cb => cb.checked);
            selectAll.indeterminate = anyChecked && ![...checkboxes].every(cb => cb.checked);
        }
    }

    // SAVE SELECTION TO SESSION via form submit, then redirect to checkout
    function saveSelection() {
        updateTotals();
    }

    checkboxes.forEach(cb => cb.addEventListener('change', updateTotals));

    if (selectAll) {
        selectAll.addEventListener('change', () => {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            updateTotals();
        });
    }

    updateTotals();
</script>

</x-app-layout>