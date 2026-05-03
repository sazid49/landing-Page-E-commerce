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
                    <h3 class="text-lg font-semibold text-gray-700">Products List</h3>

                    <a href="{{ route('products.create') }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                        + Add Product
                    </a>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="min-w-full w-full border border-gray-200 rounded-lg overflow-hidden">

                        <thead class="bg-gray-100 text-left text-sm font-semibold text-gray-700">
                            <tr>
                                <th class="p-3 border-b">#</th>
                                <th class="p-3 border-b">Image</th>
                                <th class="p-3 border-b">Name</th>
                                <th class="p-3 border-b">Price</th>
                                <th class="p-3 border-b">Stock</th>
                                <th class="p-3 border-b">Status</th>
                                <th class="p-3 border-b text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody class="text-sm">

                            @forelse($products as $key => $product)
                                <tr class="border-b hover:bg-gray-50 transition">

                                    <!-- ID -->
                                    <td class="p-3">
                                        {{ $key + 1 }}
                                    </td>

                                    <!-- IMAGE -->
                                    <td class="p-3">
                                        <img src="{{ asset('storage/' . $product->image) }}"
                                            class="w-16 h-16  rounded object-cover border">
                                    </td>

                                    <!-- NAME -->
                                    <td class="p-3 font-medium">
                                        {{ $product->name }}
                                    </td>

                                    <!-- PRICE -->
                                    <td class="p-3 text-green-600 font-semibold">
                                        ৳ {{ $product->price }}
                                    </td>

                                    <!-- STOCK -->
                                    <td class="p-3">
                                        {{ $product->stock }}
                                    </td>

                                    <!-- STATUS -->
                                    <td class="p-3">
                                        @if ($product->status)
                                            <span class="px-2 py-1 text-xs bg-green-100 text-green-600 rounded-full">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 py-1 text-xs bg-red-100 text-red-600 rounded-full">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <!-- ACTION -->
                                    <td class="p-3 text-center flex justify-center gap-2">

                                        <!-- EDIT -->
                                        <a href="{{ route('products.edit', $product->id) }}"
                                            class="bg-yellow-400 hover:bg-yellow-500 text-black px-3 py-1 rounded text-xs">
                                            Edit
                                        </a>

                                        <!-- DELETE -->
                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                                Delete
                                            </button>
                                        </form>

                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-6 text-center text-gray-500">
                                        No products found 😢
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
