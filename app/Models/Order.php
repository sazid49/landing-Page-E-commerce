<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    protected $fillable = [
        'order_code',
        'name',
        'phone',
        'address',
        'type',
        'total_amount',
        'status',
        'delivery_charge',
        'grand_total',
        'delivery_area',
    ];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {

            do {
                $code = 'ORD-' . date('Y') . '-' . strtoupper(Str::random(6));
            } while (Order::where('order_code', $code)->exists());

            $order->order_code = $code;
        });
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}
