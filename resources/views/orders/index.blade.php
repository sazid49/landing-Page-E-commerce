<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Products
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <!-- Add Button -->
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-700">Orders List</h3>


                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full w-full border border-gray-200 rounded-lg overflow-hidden">

                        <!-- HEADER -->
                        <thead
                            class="bg-gradient-to-r from-gray-100 to-gray-200 text-left text-sm font-semibold text-gray-700">
                            <tr>
                                <th class="px-4 py-3 border-b">Order Code</th>
                                <th class="px-4 py-3 border-b">Customer</th>
                                <th class="px-4 py-3 border-b">Total</th>
                                <th class="px-4 py-3 border-b">Delivery Charge</th>
                                <th class="px-4 py-3 border-b">Grand Total</th>
                                <th class="px-4 py-3 border-b">Status</th>
                                <th class="px-4 py-3 border-b text-center">Action</th>
                            </tr>
                        </thead>

                        <!-- BODY -->
                        <tbody class="text-sm bg-white">

                            @forelse ($orders as $order)
                                <tr class="border-b hover:bg-gray-50 transition">

                                    <!-- ORDER CODE -->
                                    <td class="px-4 py-3 font-semibold text-gray-700">
                                        {{ $order->order_code }}
                                    </td>

                                    <!-- CUSTOMER -->
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-800">
                                            {{ $order->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $order->phone }}
                                        </div>
                                    </td>

                                    <!-- TOTAL -->
                                    <td class="px-4 py-3 font-bold text-green-600">
                                        ৳ {{ $order->total_amount }}
                                    </td>
                                    <!-- DELIVERY CHARGE -->
                                    <td class="px-4 py-3 font-bold text-blue-600">
                                        ৳ {{ $order->delivery_charge }}
                                    </td>
                                    <!-- GRAND TOTAL -->
                                    <td class="px-4 py-3 font-bold text-indigo-600">
                                        ৳ {{ $order->grand_total }}
                                    </td>

                                    <!-- STATUS -->
                                    <td class="px-4 py-3">
                                        @php $status = $order->status; @endphp

                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold text-white
                            @if ($status == 'pending') bg-yellow-500
                            @elseif($status == 'confirmed') bg-blue-500
                            @elseif($status == 'shipped') bg-indigo-500
                            @elseif($status == 'delivered') bg-green-600
                            @elseif($status == 'cancelled') bg-red-500
                            @else bg-gray-400 @endif">
                                            {{ ucfirst($status) }}
                                        </span>
                                    </td>

                                    <!-- ACTION -->
                                    <td class="px-4 py-3">

                                        <div class="flex justify-center gap-2">

                                            <!-- SHOW -->
                                            <a href="/orders/{{ $order->id }}"
                                                class="bg-gray-600 hover:bg-gray-700 text-black px-3 py-1 rounded-lg text-xs shadow">
                                                View
                                            </a>

                                            <!-- CONFIRM -->
                                            <form method="POST" action="/orders/{{ $order->id }}/status">
                                                @csrf
                                                <input type="hidden" name="status" value="confirmed">

                                                <button
                                                    class="bg-blue-500 hover:bg-blue-600 text-black px-3 py-1 rounded-lg text-xs shadow">
                                                    Confirm
                                                </button>
                                            </form>

                                            <!-- DELETE -->
                                            <form method="POST" action="/orders/{{ $order->id }}"
                                                onsubmit="return confirm('Delete this order?')">
                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs shadow">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center p-10 text-gray-500">
                                        😢 No orders found
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>
                </div>


            </div>
        </div>
    </div>
</x-app-layout>
