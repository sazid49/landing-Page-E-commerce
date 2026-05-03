<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class OrderController extends Controller
{


    public function addToCart(Request $request)
    {
        $cart = session()->get('cart', []);

        $id = $request->product_id;

        if (isset($cart[$id])) {
            $cart[$id]['qty'] += $request->qty;
        } else {
            $cart[$id] = [
                'name' => $request->name,
                'image' => $request->image,
                'price' => $request->price,
                'qty' => $request->qty,
            ];
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => true,
            'cart_count' => count($cart) // 🔥 THIS IS IMPORTANT
        ]);
    }

    public function multiOrder(Request $request)
    {
        // dd($request->all());
        $cart = session('cart', []);

        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $order = Order::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'type' => 'multi',
            'total_amount' => $total,
            'grand_total' => $total + $request->delivery_charge,
            'delivery_charge' => $request->delivery_charge,
            'delivery_area' => $request->delivery_area,
        ]);

        foreach ($cart as $productId => $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $productId,
                'qty' => $item['qty'],
                'price' => $item['price'],
                'subtotal' => $item['price'] * $item['qty']
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', 'Order placed successfully ✅');
    }

    public function cart()
    {
        // session()->forget('cart');

        $cart = session('cart', []);
        return view('cart', compact('cart'));
    }

    public function removeCart(Request $request)
    {
        $cart = session()->get('cart', []);

        unset($cart[$request->product_id]);

        session()->put('cart', $cart);

        return response()->json([
            'status' => true,
            'cart_count' => count($cart)
        ]);
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$request->product_id])) {
            $cart[$request->product_id]['qty'] = $request->qty;
        }

        session()->put('cart', $cart);

        return response()->json([
            'status' => true
        ]);
    }
}
