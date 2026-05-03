<!DOCTYPE html>
<html>

<head>
    <title>Cart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-100">

    <!-- HEADER -->
    <header class="bg-white shadow sticky top-0 z-50">
        <div class="max-w-4xl mx-auto flex items-center justify-between p-4">
            <a href="/" class="flex items-center gap-2 text-gray-600 hover:text-black">
                ← Back
            </a>

            <h1 class="font-bold text-lg">🛒 Cart</h1>
            <div></div>
        </div>
    </header>

    <div class="max-w-4xl mx-auto p-4">

        <!-- CART CARD -->
        <div class="bg-white rounded-2xl shadow p-4">

            @php $total = 0; @endphp

            @foreach ($cart as $id => $item)
                @php
                    $subtotal = $item['price'] * $item['qty'];
                    $total += $subtotal;
                @endphp

                <div class="flex items-center justify-between border-b py-4 gap-4">

                    <!-- PRODUCT -->
                    <div class="flex-1">
                        <h3 class="font-semibold">{{ $item['name'] }}</h3>

                        <img src="{{ asset('storage/' . $item['image']) }}" class="w-16 h-16 object-cover my-2">

                        <p class="text-green-600 text-sm">৳ {{ $item['price'] }}</p>
                    </div>

                    <!-- QTY -->
                    <div class="flex items-center gap-2 bg-gray-100 px-2 py-1 rounded-lg">
                        <button onclick="updateQty({{ $id }}, -1)" class="px-2">-</button>
                        <span id="qty_{{ $id }}" class="font-bold">{{ $item['qty'] }}</span>
                        <button onclick="updateQty({{ $id }}, 1)" class="px-2">+</button>
                    </div>

                    <!-- SUBTOTAL -->
                    <div class="text-right">
                        <p class="font-semibold">
                            ৳ <span id="sub_{{ $id }}">{{ $subtotal }}</span>
                        </p>

                        <button onclick="removeItem({{ $id }})" class="text-xs text-red-500 hover:underline">
                            Remove
                        </button>
                    </div>

                </div>
            @endforeach

            <!-- TOTAL -->
            <div class="flex justify-between items-center mt-4 text-lg font-bold">
                <span>Total</span>
                <span>৳ <span id="total">{{ $total }}</span></span>
            </div>

            <!-- DELIVERY -->
            <div class="mt-4">
                <label class="font-semibold">Delivery Area:</label>

                <div class="flex gap-4 mt-2">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="delivery_area_ui" checked onchange="updateDelivery(60)">
                        Inside Dhaka (৳60)
                    </label>

                    <label class="flex items-center gap-2">
                        <input type="radio" name="delivery_area_ui" onchange="updateDelivery(120)">
                        Outside Dhaka (৳120)
                    </label>
                </div>
            </div>

            <!-- DELIVERY CHARGE -->
            <div class="flex justify-between mt-3">
                <span>Delivery Charge</span>
                <span>৳ <span id="delivery">60</span></span>
            </div>

            <!-- GRAND TOTAL -->
            <div class="flex justify-between items-center mt-2 text-xl font-bold">
                <span>Grand Total</span>
                <span>৳ <span id="grand_total">{{ $total + 60 }}</span></span>
            </div>

        </div>

        <!-- CHECKOUT -->
        <form method="POST" action="/order/multi" class="mt-6 bg-white p-5 rounded-2xl shadow space-y-3">

            @csrf

            <h2 class="font-bold text-lg mb-2">📦 Delivery Info</h2>

            <input name="name" placeholder="Full Name"
                class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-green-400">

            <input name="phone" placeholder="Phone Number"
                class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-green-400">

            <textarea name="address" placeholder="Full Address"
                class="w-full border p-3 rounded-lg focus:ring-2 focus:ring-green-400"></textarea>

            <!-- Hidden Inputs for DB -->
            <input type="hidden" name="delivery_area" id="delivery_area" value="dhaka">
            <input type="hidden" name="delivery_charge" id="delivery_input" value="60">
            <input type="hidden" name="grand_total" id="grand_total_input" value="{{ $total + 60 }}">

            <button class="w-full bg-green-600 hover:bg-green-700 text-white py-3 rounded-xl font-bold shadow">
                ✅ Place Order
            </button>
        </form>

    </div>

    <!-- JS -->
    <script>
        function updateQty(id, change) {

            let qtyEl = document.getElementById('qty_' + id);
            let qty = parseInt(qtyEl.innerText);

            qty += change;
            if (qty < 1) qty = 1;

            fetch('/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: id,
                    qty: qty
                })
            }).then(() => location.reload());
        }

        function removeItem(id) {

            fetch('/cart/remove', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({
                    product_id: id
                })
            }).then(() => location.reload());
        }

        function updateDelivery(charge) {

            let total = parseFloat(document.getElementById('total').innerText);

            document.getElementById('delivery').innerText = charge;

            let grandTotal = total + charge;

            document.getElementById('grand_total').innerText = grandTotal;

            document.getElementById('delivery_input').value = charge;
            document.getElementById('grand_total_input').value = grandTotal;

            // area value update
            document.getElementById('delivery_area').value = (charge == 60) ? 'dhaka' : 'outside';
        }
    </script>

</body>

</html>
