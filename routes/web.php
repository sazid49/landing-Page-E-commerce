<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', [LandingController::class, 'index']);
Route::get('/product/{id}', [LandingController::class, 'singleProduct']);

Route::post('/order/single', [OrderController::class, 'singleOrder']);
Route::post('/cart/add', [OrderController::class, 'addToCart']);
Route::get('/checkout', [OrderController::class, 'checkout']);
Route::post('/order/multi', [OrderController::class, 'multiOrder']);


Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');

Route::post('/orders/{id}/status', [AdminOrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

Route::delete('/orders/{id}', [AdminOrderController::class, 'destroy'])->name('admin.orders.destroy');
Route::get('/orders/{id}', [AdminOrderController::class, 'show'])->name('admin.orders.show');


Route::get('/cart/count', function () {
    return response()->json([
        'count' => count(session('cart', []))
    ]);
});

Route::get('/cart', [OrderController::class, 'cart']);
Route::post('/cart/remove', [OrderController::class, 'removeCart']);
Route::post('/cart/update', [OrderController::class, 'updateCart']);
Route::resource('products', ProductController::class);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
