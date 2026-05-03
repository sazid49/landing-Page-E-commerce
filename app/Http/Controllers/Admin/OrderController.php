<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('items.product')
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $oldStatus = $order->status;
        $newStatus = $request->status;

        $order->status = $newStatus;


        // dd($order);

        // 🔥 ONLY WHEN CONFIRMED → decrease stock
        if ($oldStatus != 'confirmed' && $newStatus == 'confirmed') {
            foreach ($order->items as $item) {

                $product = Product::find($item->product_id);
                // dd($product);

                if ($product) {
                    $product->stock -= $item->qty;
                    $product->save();
                }
            }
        }
        $order->save();

        return back()->with('success', 'Status updated');
    }

    public function show($id)
    {
        $order = Order::with('items.product')->findOrFail($id);

        return view('orders.show', compact('order'));
    }

    public function destroy($id)
    {
        $order = Order::findOrFail($id);

        // optional: restore stock if needed
        if ($order->status == 'confirmed') {

            foreach ($order->items as $item) {
                $product = Product::find($item->product_id);

                if ($product) {
                    $product->stock += $item->qty;
                    $product->save();
                }
            }
        }

        $order->items()->delete();
        $order->delete();

        return back()->with('success', 'Order deleted');
    }
}
