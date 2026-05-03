<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Order Details - {{ $order->order_code }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- ORDER INFO -->
            <div class="bg-white shadow rounded-xl p-6">

                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-bold">Order Info</h3>

                    <span
                        class="px-3 py-1 rounded-full text-white text-xs
                        @if ($order->status == 'pending') bg-yellow-500
                        @elseif($order->status == 'confirmed') bg-blue-500
                        @elseif($order->status == 'shipped') bg-indigo-500
                        @elseif($order->status == 'delivered') bg-green-600
                        @else bg-red-500 @endif">
                        {{ ucfirst($order->status) }}
                    </span>
                </div>

                <div class="mt-4 grid md:grid-cols-2 gap-4 text-sm">

                    <div>
                        <p class="text-gray-500">Order Code</p>
                        <p class="font-semibold">{{ $order->order_code }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Total Amount</p>
                        <p class="font-semibold text-green-600">৳ {{ $order->total_amount }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Delivery Charge</p>
                        <p class="font-semibold text-blue-600">৳ {{ $order->delivery_charge }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Grand Total</p>
                        <p class="font-semibold text-indigo-600">৳ {{ $order->grand_total }}</p>
                    </div>
                </div>

            </div>

            <!-- CUSTOMER INFO -->
            <div class="bg-white shadow rounded-xl p-6">

                <h3 class="text-lg font-bold mb-4">Customer Info</h3>

                <div class="grid md:grid-cols-2 gap-4 text-sm">

                    <div>
                        <p class="text-gray-500">Name</p>
                        <p class="font-semibold">{{ $order->name }}</p>
                    </div>

                    <div>
                        <p class="text-gray-500">Phone</p>
                        <p class="font-semibold">{{ $order->phone }}</p>
                    </div>

                    <div class="md:col-span-2">
                        <p class="text-gray-500">Address</p>
                        <p class="font-semibold">{{ $order->address }}</p>
                    </div>

                </div>

            </div>

            <!-- PRODUCT LIST -->
            <div class="bg-white shadow rounded-xl p-6">

                <h3 class="text-lg font-bold mb-4">Order Products</h3>

                <div class="overflow-x-auto">

                    <table class="w-full text-sm">

                        <thead class="bg-gray-100">
                            <tr>
                                <th class="p-3 text-left">Product</th>
                                <th class="p-3">Qty</th>
                                <th class="p-3">Price</th>
                                <th class="p-3">Subtotal</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($order->items as $item)
                                <tr class="border-b">

                                    <td class="p-3">
                                        {{ $item->product->name ?? 'Deleted Product' }}
                                    </td>

                                    <td class="p-3 text-center">
                                        {{ $item->qty }}
                                    </td>

                                    <td class="p-3 text-center">
                                        ৳ {{ $item->price }}
                                    </td>

                                    <td class="p-3 text-center font-semibold text-green-600">
                                        ৳ {{ $item->qty * $item->price }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="bg-white shadow rounded-xl p-6 flex gap-3">

                <!-- CONFIRM -->
                <form method="POST" action="/orders/{{ $order->id }}/status">
                    @csrf
                    <input type="hidden" name="status" value="confirmed">

                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                        Confirm
                    </button>
                </form>

                <!-- SHIPPED -->
                <form method="POST" action="/orders/{{ $order->id }}/status">
                    @csrf
                    <input type="hidden" name="status" value="shipped">

                    <button class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded">
                        Shipped
                    </button>
                </form>

                <!-- DELIVERED -->
                <form method="POST" action="/orders/{{ $order->id }}/status">
                    @csrf
                    <input type="hidden" name="status" value="delivered">

                    <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
                        Delivered
                    </button>
                </form>

            </div>

        </div>
    </div>

</x-app-layout>
