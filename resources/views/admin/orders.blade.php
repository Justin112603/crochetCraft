<x-app-layout>

<div class="max-w-7xl mx-auto px-6 py-10">

    <div class="mb-8">
        <h1 class="text-3xl font-bold text-[#2e1a0e]">Orders Management</h1>
        <p class="text-[#9d7d6a] mt-2">Manage customer orders</p>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-5 py-4 rounded-2xl mb-6">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-300 text-red-700 px-5 py-4 rounded-2xl mb-6">
            {{ session('error') }}
        </div>
    @endif

    <div class="bg-white rounded-3xl shadow overflow-hidden">

        <table class="w-full">

            <thead class="bg-[#fff7f2]">
                <tr>
                    <th class="px-6 py-4 text-left">Order ID</th>
                    <th class="px-6 py-4 text-left">Customer</th>
                    <th class="px-6 py-4 text-left">Payment</th>
                    <th class="px-6 py-4 text-left">Total</th>
                    <th class="px-6 py-4 text-left">Status</th>
                    <th class="px-6 py-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)

                    @php
                        $statusMap = [
                            'pending'          => ['bg-gray-100',   'text-gray-600',   'Pending'],
                            'preparing'        => ['bg-yellow-100', 'text-yellow-700', 'Preparing'],
                            'out_for_delivery' => ['bg-blue-100',   'text-blue-700',   'Out for Delivery'],
                            'received'         => ['bg-green-100',  'text-green-700',  'Product Received'],
                            'cancelled'        => ['bg-red-100',    'text-red-700',    'Cancelled'],
                        ];
                        [$bg, $text, $label] = $statusMap[$order->status] ?? ['bg-gray-100', 'text-gray-500', ucfirst($order->status)];
                    @endphp

                    <tr class="border-b hover:bg-[#fffaf5]">

                        <td class="px-6 py-4">#{{ $order->id }}</td>

                        <td class="px-6 py-4">
                            <div>
                                <h3 class="font-semibold">{{ $order->user->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $order->user->email }}</p>
                            </div>
                        </td>

                        <td class="px-6 py-4 uppercase">{{ $order->payment_method }}</td>

                        <td class="px-6 py-4 font-semibold text-[#c4693f]">
                            ₱{{ number_format($order->total, 2) }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="{{ $bg }} {{ $text }} px-3 py-1 rounded-full text-xs font-semibold">
                                {{ $label }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-center">
                            @if($order->status === 'cancelled')
                                <span class="text-sm text-red-400 italic">Order cancelled</span>
                            @else
                                <form action="{{ route('admin.orders.status', $order) }}"
                                      method="POST"
                                      class="flex items-center gap-2 justify-center">
                                    @csrf
                                    @method('PUT')

                                    <select name="status" class="border border-[#e8d5bd] rounded-xl px-3 py-2 text-sm">
                                        <option value="preparing"        {{ $order->status == 'preparing'        ? 'selected' : '' }}>Preparing</option>
                                        <option value="out_for_delivery" {{ $order->status == 'out_for_delivery' ? 'selected' : '' }}>Out for Delivery</option>
                                        <option value="received"         {{ $order->status == 'received'         ? 'selected' : '' }}>Product Received</option>
                                    </select>

                                    <button type="submit"
                                        class="bg-[#c4693f] hover:bg-[#9e4a28] text-white px-4 py-2 rounded-xl text-sm transition">
                                        Update
                                    </button>
                                </form>
                            @endif
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="6" class="text-center py-10 text-gray-500">
                            No orders found.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        <div class="p-6">
            {{ $orders->links() }}
        </div>

    </div>

</div>

</x-app-layout>