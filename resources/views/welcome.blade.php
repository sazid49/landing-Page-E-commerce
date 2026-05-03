<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel AJAX Shop</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100 text-gray-800">

    <!-- HEADER -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-6xl mx-auto flex justify-between items-center p-4">

            <h1 class="text-xl font-bold">🛒 My Shop</h1>

            <div class="flex items-center gap-4">

                <!-- CART BUTTON -->
                <a href="/cart"
                    class="relative flex items-center gap-2 bg-gray-100 px-4 py-2 rounded-full hover:bg-gray-200">

                    🛍️ Cart

                    <!-- COUNT BADGE -->
                    <span id="cartCount"
                        class="absolute -top-2 -right-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full">
                        0
                    </span>
                </a>

            </div>

        </div>
    </header>

    <!-- HERO -->
    <section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white py-14 text-center">
        <h1 class="text-4xl font-bold">Order Your Favorite Products</h1>
        <p class="mt-2">Fast Delivery • Cash on Delivery • Trusted Shop</p>
    </section>

    <!-- PRODUCTS -->
    <section class="max-w-6xl mx-auto p-6">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">🔥 Trending Products</h2>
            <span class="text-sm text-gray-500">Limited stock available</span>
        </div>

        <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">

            @foreach ($products as $product)
                <div class="bg-white rounded-2xl shadow hover:shadow-xl transition overflow-hidden group">

                    <!-- IMAGE -->
                    <div class="relative overflow-hidden">
                        <img src="{{ asset('storage/' . $product['image']) }}"
                            class="w-full h-52 object-cover group-hover:scale-105 transition duration-300">

                        <!-- BADGE -->
                        <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-1 rounded-full shadow">
                            HOT
                        </span>
                    </div>

                    <div class="p-4">

                        <!-- NAME -->
                        <h3 class="font-semibold text-lg line-clamp-2">
                            {{ $product['name'] }}
                        </h3>

                        <!-- PRICE -->
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-green-600 text-lg font-bold">
                                ৳ {{ $product['price'] }}
                            </p>

                            <span class="text-xs text-gray-400">Stock limited</span>
                        </div>

                        <!-- QTY CONTROLLER -->
                        <div class="flex items-center justify-between mt-4 bg-gray-100 rounded-xl px-3 py-2">

                            <button onclick="changeQty(-1, {{ $product['id'] }})"
                                class="w-8 h-8 flex items-center justify-center bg-white rounded-lg shadow hover:bg-gray-200">
                                -
                            </button>

                            <span id="qty_{{ $product['id'] }}" class="font-bold text-lg">
                                1
                            </span>

                            <button onclick="changeQty(1, {{ $product['id'] }})"
                                class="w-8 h-8 flex items-center justify-center bg-white rounded-lg shadow hover:bg-gray-200">
                                +
                            </button>
                        </div>

                        <!-- BUTTON -->
                        <button
                            onclick="addToCart({{ $product['id'] }},'{{ $product['name'] }}', '{{ $product['image'] }}' ,{{ $product['price'] }})"
                            class="mt-4 w-full bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-indigo-600 hover:to-blue-500 text-white py-3 rounded-xl font-semibold shadow-lg transition">

                            🛒 Add to Cart
                        </button>

                    </div>
                </div>
            @endforeach

        </div>
    </section>

    <!-- FOOTER -->
    <footer class="text-center p-6 text-gray-500">
        © 2026 My Shop
    </footer>

    <!-- JS -->
    <script>
        let qty = {};

        // quantity control
        function changeQty(val, id) {
            if (!qty[id]) qty[id] = 1;

            qty[id] += val;

            if (qty[id] < 1) qty[id] = 1;

            document.getElementById('qty_' + id).innerText = qty[id];
        }

        // add to cart
        function addToCart(id, name, image, price) {

            let qty = document.getElementById('qty_' + id).innerText;

            fetch("/cart/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').content
                    },
                    body: JSON.stringify({
                        product_id: id,
                        name: name,
                        image: image,
                        price: price,
                        qty: parseInt(qty)
                    })
                })
                .then(res => res.json())
                .then(data => {

                    // 🔥 CART COUNT UPDATE
                    document.getElementById('cartCount').innerText = data.cart_count;

                    alert("Added to cart ✅");

                })
                .catch(err => {
                    console.log(err);
                    alert("Error ❌");
                });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            fetch('/cart/count')
                .then(res => res.json())
                .then(data => {
                    document.getElementById('cartCount').innerText = data.count;
                });
        });
    </script>

</body>

</html>
