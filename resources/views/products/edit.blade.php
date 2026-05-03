<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Product
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow rounded-lg p-6">

                <!-- Back Button -->
                <div class="mb-4">
                    <a href="{{ route('products.index') }}" class="text-sm text-blue-600 hover:underline">
                        ← Back to Products
                    </a>
                </div>

                <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data"
                    class="space-y-5">

                    @csrf
                    @method('PUT')

                    <!-- IMAGE PREVIEW -->
                    <div class="flex flex-col items-center">

                        <img src="{{ asset('storage/' . $product->image) }}" id="previewImage"
                            class="w-32 h-32 rounded-lg object-cover border shadow">

                        <label class="mt-3 text-sm text-gray-600">Current Image</label>
                    </div>

                    <!-- IMAGE INPUT -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Change Product Image
                        </label>

                        <input type="file" name="image" onchange="previewFile(event)"
                            class="w-full border rounded-lg p-2">
                    </div>

                    <!-- NAME -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Product Name
                        </label>

                        <input type="text" name="name" value="{{ $product->name }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- PRICE -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Price (৳)
                        </label>

                        <input type="number" name="price" value="{{ $product->price }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- STOCK -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Stock
                        </label>

                        <input type="number" name="stock" value="{{ $product->stock }}"
                            class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- DESCRIPTION -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Description
                        </label>

                        <textarea name="description" rows="4" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400">{{ $product->description }}</textarea>
                    </div>

                    <!-- STATUS -->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="status" value="1" {{ $product->status ? 'checked' : '' }}>

                        <label class="text-sm text-gray-700">
                            Active Product
                        </label>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold shadow">
                        Update Product
                    </button>

                </form>

            </div>

        </div>
    </div>
    <script>
        function previewFile(event) {

            let input = event.target;

            if (input.files && input.files[0]) {

                let reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</x-app-layout>
