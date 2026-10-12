<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommerceDemoSeeder extends Seeder
{
    public function run(): void
    {
        $customer = User::query()->where('email', 'user@shop.test')->firstOrFail();
        $product = Product::query()->where('sku', 'ELE-001')->firstOrFail();

        $cart = Cart::query()->firstOrCreate(
            ['user_id' => $customer->id, 'status' => 'active'],
        );
        $cart->items()->firstOrCreate(
            ['product_id' => $product->id],
            ['quantity' => 1, 'unit_price' => $product->price],
        );

        $order = Order::query()->firstOrCreate(
            ['order_number' => 'DEMO-2026-0001'],
            [
                'user_id' => $customer->id,
                'status' => 'processing',
                'subtotal' => $product->price,
                'total' => $product->price,
                'shipping_address' => 'Jl. Contoh No. 1, Jakarta',
            ],
        );
        $order->items()->firstOrCreate(
            ['product_id' => $product->id],
            [
                'product_name' => $product->name,
                'quantity' => 1,
                'unit_price' => $product->price,
            ],
        );
    }
}
