{{-- profile/_order-card.blade.php --}}
<div class="order-card">
    <div class="order-top">
        <div>
            <div class="order-id">#ORDER-{{ $order->id }}</div>
            <div class="order-date">{{ $order->created_at->format('F d, Y') }}</div>
        </div>
        <span class="badge badge-{{ strtolower(str_replace(' ', '-', $order->status)) }}">
            {{ ucfirst($order->status) }}
        </span>
    </div>
    <div class="order-foot">
        <div class="order-amt">₱{{ number_format($order->total, 2) }}</div>
        <button class="btn-sm"
            data-order-id="{{ $order->id }}"
            data-date="{{ $order->created_at->format('F d, Y h:i A') }}"
            data-status="{{ ucfirst($order->status) }}"
            data-subtotal="{{ number_format($order->subtotal, 2) }}"
            data-total="{{ number_format($order->total, 2) }}"
            data-payment="{{ $order->payment_method }}"
            data-image="{{ asset('storage/' . $order->image) }}"
            data-product="{{ $order->product->name ?? 'Product' }}"
            data-qty="{{ $order->quantity ?? 1 }}"
            data-name="{{ auth()->user()->name }}"
            data-email="{{ auth()->user()->email }}"
            data-phone="{{ auth()->user()->phone ?? 'No phone number' }}"
            data-address="{{ auth()->user()->address ?? 'No address added' }}"
            data-cancel-url="{{ route('orders.cancel', $order->id) }}"
            onclick="openOrderModalFromBtn(this)"
        >{{ $btnLabel ?? 'View' }}</button>
    </div>
</div>