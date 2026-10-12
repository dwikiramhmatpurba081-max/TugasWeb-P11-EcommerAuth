<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        if (Product::query()->exists()) {
            return;
        }

        $catalog = [
            'elektronik' => [
                ['Samsung Galaxy A56 5G', 6499000],
                ['Apple iPhone 16 128GB', 14999000],
                ['Xiaomi Redmi Note 14 Pro', 4299000],
                ['Sony WH-1000XM5 Headphone', 5499000],
                ['JBL Tune 520BT Wireless', 899000],
                ['Logitech MX Master 3S Mouse', 1699000],
                ['ASUS Vivobook 14 OLED', 11999000],
                ['Lenovo IdeaPad Slim 3', 8299000],
                ['Samsung 27 Inch Monitor', 3299000],
                ['Anker Nano Power Bank 10000mAh', 599000],
            ],
            'fashion' => [
                ['Uniqlo Cotton Crew Neck T-Shirt', 199000],
                ['Levis 501 Original Jeans', 1299000],
                ['H&M Relaxed Fit Oxford Shirt', 399000],
                ['Erigo Essential Hoodie', 279000],
                ['Zara Linen Blend Trousers', 899000],
                ['Cotton Ink Oversized Blazer', 799000],
                ['Adidas Essentials Track Pants', 649000],
                ['Nike Dri-FIT Training Tee', 399000],
                ['New Balance Classic Crew Socks', 149000],
                ['Local Brand Denim Jacket', 549000],
            ],
            'rumah-tangga' => [
                ['Philips Essential Air Fryer 4.1L', 1899000],
                ['Miyako Rice Cooker 1.8L', 389000],
                ['IKEA 365 Plus Dinnerware Set', 499000],
                ['LocknLock Glass Food Container Set', 329000],
                ['Krisbow Stainless Steel Kettle', 449000],
                ['Maspion Stand Fan 16 Inch', 599000],
                ['Sharp Compact Microwave Oven', 1399000],
                ['IKEA Markus Office Chair', 2799000],
                ['Oxone Nonstick Cookware Set', 899000],
                ['Informa Cotton Bedsheet Queen', 499000],
            ],
            'kecantikan' => [
                ['Wardah UV Shield Aqua Fresh Essence', 79900],
                ['Somethinc Niacinamide Serum 20ml', 115000],
                ['Skintific 5X Ceramide Barrier Moisturizer', 139000],
                ['Maybelline Fit Me Matte Foundation', 149000],
                ['Emina Bright Stuff Face Wash', 24900],
                ['The Originote Hyalucera Moisturizer', 59900],
                ['Make Over Powerstay Lip Cream', 125000],
                ['Avoskin Miraculous Refining Toner', 189000],
                ['Azarine Hydrasoothe Sunscreen Gel', 65000],
                ['Sensatia Botanicals Body Lotion', 135000],
            ],
            'olahraga' => [
                ['Nike Revolution 7 Running Shoes', 1099000],
                ['Adidas Ultraboost Light Running Shoes', 2999000],
                ['Decathlon Domyos Yoga Mat 8mm', 249000],
                ['Body Sculpture Dumbbell Set 10kg', 499000],
                ['Mizuno Volleyball Knee Support', 189000],
                ['Speedo Biofuse Swimming Goggles', 399000],
                ['Puma Essential Training Duffel Bag', 649000],
                ['Garmin Forerunner 165 GPS Watch', 4499000],
                ['Yonex Mavis 350 Shuttlecock Tube', 189000],
                ['Wilson NBA Basketball Size 7', 499000],
            ],
            'aksesoris' => [
                ['Eiger Adventure Daypack 18L', 499000],
                ['Casio Vintage Digital Watch', 599000],
                ['Fossil Derrick Leather Wallet', 899000],
                ['Tumbler Stainless Steel 750ml', 159000],
                ['Anker Soundcore Mini Bluetooth Speaker', 499000],
                ['Baseus USB-C 100W Charging Cable', 99000],
                ['Samsonite Luggage Tag Set', 199000],
                ['Ray-Ban Classic Aviator Sunglasses', 2399000],
                ['Targus 15.6 Inch Laptop Sleeve', 329000],
                ['Canvas Everyday Tote Bag', 89000],
            ],
        ];

        $adminId = User::query()->where('email', 'admin@shop.test')->value('id');

        foreach ($catalog as $categorySlug => $products) {
            $categoryId = Category::query()->where('slug', $categorySlug)->value('id');

            foreach ($products as $index => [$name, $price]) {
                Product::factory()->create([
                    'category_id' => $categoryId,
                    'created_by' => $adminId,
                    'name' => $name,
                    'slug' => Str::slug($name),
                    'sku' => strtoupper(substr($categorySlug, 0, 3)).'-'.str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT),
                    'price' => $price,
                ]);
            }
        }
    }
}
