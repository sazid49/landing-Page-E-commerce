<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Smart Watch Pro',
                'slug' => Str::slug('Smart Watch Pro'),
                'description' => 'Premium smart watch with health tracking features.',
                'price' => 1200,
                'discount_price' => 999,
                'image' => 'https://via.placeholder.com/300',
                'stock' => 50,
                'is_featured' => 1,
                'status' => 1,
            ],
            [
                'name' => 'Wireless Earbuds',
                'slug' => Str::slug('Wireless Earbuds'),
                'description' => 'High quality sound with noise cancellation.',
                'price' => 800,
                'discount_price' => 650,
                'image' => 'https://via.placeholder.com/300',
                'stock' => 100,
                'is_featured' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Bluetooth Speaker',
                'slug' => Str::slug('Bluetooth Speaker'),
                'description' => 'Portable speaker with deep bass sound.',
                'price' => 1500,
                'discount_price' => 1200,
                'image' => 'https://via.placeholder.com/300',
                'stock' => 30,
                'is_featured' => 0,
                'status' => 1,
            ],
            [
                'name' => 'Gaming Headset',
                'slug' => Str::slug('Gaming Headset'),
                'description' => 'RGB gaming headset with surround sound.',
                'price' => 2000,
                'discount_price' => 1700,
                'image' => 'https://via.placeholder.com/300',
                'stock' => 20,
                'is_featured' => 0,
                'status' => 1,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
