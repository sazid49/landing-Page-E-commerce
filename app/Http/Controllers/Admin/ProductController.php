<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get();
        return view('products.index', compact('products'));
    }

    // CREATE FORM
    public function create()
    {
        return view('products.create');
    }

    // STORE
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'price' => 'required|numeric',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'discount_price' => $request->discount_price,
            'stock' => $request->stock ?? 0,
            'image' => $imagePath,
            'status' => 1,
        ]);

        return redirect()->route('products.index')->with('success', 'Product created');
    }

    // EDIT
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image')) {

            // 🔥 OLD IMAGE DELETE
            if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
                unlink(storage_path('app/public/' . $product->image));
            }

            // NEW IMAGE UPLOAD
            $data['image'] = $request->file('image')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Updated');
    }

    // DELETE
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // 🔥 delete image from storage
        if ($product->image && file_exists(storage_path('app/public/' . $product->image))) {
            unlink(storage_path('app/public/' . $product->image));
        }

        $product->delete();

        return back()->with('success', 'Deleted');
    }
}
