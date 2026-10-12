<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductRoleAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_and_editor_can_open_product_management_but_user_cannot(): void
    {
        $this->get('/admin/products')->assertRedirect('/login');

        $this->actingAs(User::factory()->create(['role' => 'user']))
            ->get('/admin/products')
            ->assertForbidden();

        $this->actingAs(User::factory()->create(['role' => 'editor']))
            ->get('/admin/products')
            ->assertOk();

        $this->actingAs(User::factory()->create(['role' => 'admin']))
            ->get('/admin/products')
            ->assertOk();
    }

    public function test_editor_can_manage_owned_products_but_not_another_editors_products(): void
    {
        $category = Category::factory()->create();
        $editor = User::factory()->create(['role' => 'editor']);
        $otherEditor = User::factory()->create(['role' => 'editor']);
        $ownedProduct = Product::factory()->for($category)->for($editor, 'creator')->create();
        $otherProduct = Product::factory()->for($category)->for($otherEditor, 'creator')->create();

        $this->actingAs($editor)
            ->get(route('admin.products.edit', $ownedProduct))
            ->assertOk();

        $this->get(route('admin.products.edit', $otherProduct))->assertForbidden();
        $this->delete(route('admin.products.destroy', $otherProduct))->assertForbidden();

        $this->put(route('admin.products.update', $ownedProduct), [
            'category_id' => $category->id,
            'name' => 'Produk editor diperbarui',
            'slug' => 'produk-editor-diperbarui',
            'sku' => 'SKU-EDITOR-001',
            'description' => 'Produk yang dikelola pemiliknya.',
            'price' => 125000,
            'stock' => 8,
        ])->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'id' => $ownedProduct->id,
            'name' => 'Produk editor diperbarui',
            'created_by' => $editor->id,
        ]);
    }

    public function test_editor_cannot_assign_a_product_to_another_creator(): void
    {
        $category = Category::factory()->create();
        $editor = User::factory()->create(['role' => 'editor']);
        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($editor)
            ->post(route('admin.products.store'), [
                'category_id' => $category->id,
                'name' => 'Produk baru editor',
                'slug' => 'produk-baru-editor',
                'sku' => 'SKU-EDITOR-NEW',
                'price' => 99000,
                'stock' => 4,
                'created_by' => $admin->id,
            ])
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseHas('products', [
            'slug' => 'produk-baru-editor',
            'created_by' => $editor->id,
        ]);
    }

    public function test_admin_can_delete_a_product_owned_by_another_user(): void
    {
        $category = Category::factory()->create();
        $creator = User::factory()->create(['role' => 'editor']);
        $admin = User::factory()->create(['role' => 'admin']);
        $product = Product::factory()->for($category)->for($creator, 'creator')->create();

        $this->actingAs($admin)
            ->delete(route('admin.products.destroy', $product))
            ->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }

    public function test_public_catalog_only_shows_active_products(): void
    {
        $category = Category::factory()->create();
        $activeProduct = Product::factory()->for($category)->create(['is_active' => true]);
        $inactiveProduct = Product::factory()->for($category)->create(['is_active' => false]);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee($activeProduct->name)
            ->assertDontSee($inactiveProduct->name);

        $this->get(route('products.show', $inactiveProduct))->assertForbidden();
    }

    public function test_deleting_a_customer_keeps_order_history(): void
    {
        $customer = User::factory()->create(['role' => 'user']);
        $order = Order::query()->create([
            'user_id' => $customer->id,
            'order_number' => 'TEST-ORDER-001',
            'status' => 'processing',
            'subtotal' => 250000,
            'total' => 250000,
            'shipping_address' => 'Alamat pengujian',
        ]);

        $this->actingAs($customer)
            ->delete(route('profile.destroy'), ['password' => 'password'])
            ->assertRedirect('/');

        $this->assertDatabaseMissing('users', ['id' => $customer->id]);
        $this->assertDatabaseHas('orders', ['id' => $order->id, 'user_id' => null]);
    }
}
