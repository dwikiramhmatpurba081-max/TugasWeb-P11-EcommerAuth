<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $accounts = [
            ['name' => 'Store Administrator', 'email' => 'admin@shop.test', 'role' => 'admin'],
            ['name' => 'Store Editor', 'email' => 'editor@shop.test', 'role' => 'editor'],
            ['name' => 'Store Customer', 'email' => 'user@shop.test', 'role' => 'user'],
        ];

        foreach ($accounts as $account) {
            $user = User::query()->firstOrNew(['email' => $account['email']]);
            $user->name = $account['name'];
            $user->role = $account['role'];
            $user->email_verified_at = now();
            $user->password = Hash::make('password');
            $user->save();
        }

        collect([
            ['name' => 'Elektronik', 'slug' => 'elektronik'],
            ['name' => 'Fashion', 'slug' => 'fashion'],
            ['name' => 'Rumah Tangga', 'slug' => 'rumah-tangga'],
            ['name' => 'Kecantikan', 'slug' => 'kecantikan'],
            ['name' => 'Olahraga', 'slug' => 'olahraga'],
            ['name' => 'Aksesoris', 'slug' => 'aksesoris'],
        ])->each(fn (array $category) => Category::query()->updateOrCreate(
            ['slug' => $category['slug']],
            ['name' => $category['name'], 'description' => 'Pilihan produk '.$category['name'], 'is_active' => true],
        ));

        $this->call(ProductSeeder::class);
        $this->call(CommerceDemoSeeder::class);
    }
}
