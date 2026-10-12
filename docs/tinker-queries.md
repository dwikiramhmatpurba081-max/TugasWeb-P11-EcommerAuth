# Bukti query Tinker

Jalankan `php artisan migrate --seed`, lalu buka `php artisan tinker`. Jalankan lima query berikut satu per satu; hasil aktual di terminal dapat di-screenshot untuk lampiran tugas.

1. **Jumlah produk per kategori**

   ```php
   App\Models\Category::withCount('products')->orderBy('name')->get(['name', 'products_count']);
   ```

2. **Produk aktif yang masih tersedia**

   ```php
   App\Models\Product::active()->inStock()->orderBy('price')->limit(5)->get(['name', 'price', 'stock']);
   ```

3. **Relasi produk, kategori, dan pembuat**

   ```php
   App\Models\Product::with(['category:id,name', 'creator:id,name'])->first();
   ```

4. **Jumlah produk yang dibuat setiap akun**

   ```php
   App\Models\User::withCount('products')->orderBy('role')->get(['name', 'role', 'products_count']);
   ```

5. **Relasi pesanan, item, dan produk** (menampilkan pesanan demo dari seeder)

   ```php
   App\Models\Order::with('items.product')->latest()->first();
   ```
