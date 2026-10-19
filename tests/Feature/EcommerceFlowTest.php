<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class EcommerceFlowTest extends TestCase
{
    /** 1. Guest dapat membuka homepage */
    public function test_guest_can_access_homepage(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Make Your Space');
        $response->assertSee('AuraSpace');
    }

    /** 2. Guest dapat melihat produk */
    public function test_guest_can_view_shop_catalog(): void
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);
        $response->assertSee('Katalog Produk');
    }

    /** 3. Guest dapat membuka detail produk */
    public function test_guest_can_view_product_detail(): void
    {
        $product = Product::active()->first();
        $this->assertNotNull($product);

        $response = $this->get('/products/' . $product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee($product->formatted_price);
    }

    /** 4 & 5. Guest tidak dapat menambahkan produk ke cart dan diarahkan ke login */
    public function test_guest_cannot_add_to_cart_and_redirects_to_login(): void
    {
        $product = Product::active()->first();

        $response = $this->post('/cart/add/' . $product->id, ['quantity' => 1]);
        $response->assertRedirect('/login');
        $response->assertSessionHas('warning', 'Login dulu untuk mulai belanja ✦');
    }

    /** 6. Customer dapat register */
    public function test_customer_can_register(): void
    {
        $email = 'newcustomer_' . time() . '@example.com';
        $response = $this->post('/register', [
            'name' => 'Testing User',
            'email' => $email,
            'phone' => '081299998888',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('users', [
            'email' => $email,
            'role' => 'customer',
        ]);
        $this->assertAuthenticated();
    }

    /** 7. Customer dapat login */
    public function test_customer_can_login(): void
    {
        $response = $this->post('/login', [
            'email' => 'luna@gmail.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/');
        $this->assertAuthenticated();
    }

    /** 8, 9, 10, 11, 12, 13. Customer Cart, Update, Checkout, Stock Decrement, Order Detail */
    public function test_full_customer_order_journey_and_stock_management(): void
    {
        $customer = User::where('email', 'luna@gmail.com')->first();
        $this->assertNotNull($customer);

        $product = Product::where('stock', '>', 5)->first();
        $initialStock = $product->stock;

        // 8. Tambah ke keranjang
        $response = $this->actingAs($customer)->post('/cart/add/' . $product->id, [
            'quantity' => 2,
        ]);
        $response->assertSessionHas('success');

        // Buka keranjang
        $response = $this->actingAs($customer)->get('/cart');
        $response->assertStatus(200);
        $response->assertSee($product->name);

        // 9. Ubah quantity di keranjang
        $cart = $customer->cart;
        $cartItem = $cart->items()->where('product_id', $product->id)->first();
        $this->assertNotNull($cartItem);

        $response = $this->actingAs($customer)->put('/cart/' . $cartItem->id, [
            'quantity' => 3,
        ]);
        $response->assertSessionHas('success');
        $this->assertEquals(3, $cartItem->fresh()->quantity);

        // 10. Buka halaman checkout
        $response = $this->actingAs($customer)->get('/checkout');
        $response->assertStatus(200);
        $response->assertSee('Konfirmasi Pesanan');

        // 11. Buat pesanan (Place Order)
        $response = $this->actingAs($customer)->post('/checkout', [
            'recipient_name' => 'Luna Stella',
            'phone' => '081987654321',
            'address' => 'Jl. Lavender Pastel No. 42',
            'city' => 'Bandung',
            'postal_code' => '40123',
            'notes' => 'Tolong diantar sebelum jam 5 sore',
            'payment_method' => 'Transfer Bank',
        ]);

        $response->assertSessionHas('success');

        // 12. Cek Order & Order Items tersimpan di DB
        $order = Order::where('user_id', $customer->id)->latest()->first();
        $this->assertNotNull($order);
        $this->assertDatabaseHas('order_items', [
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 3,
        ]);
        $this->assertDatabaseHas('payments', [
            'order_id' => $order->id,
            'payment_method' => 'Transfer Bank',
        ]);

        // 13. Cek stok produk berkurang tepat 3 pcs
        $this->assertEquals($initialStock - 3, $product->fresh()->stock);

        // 14. Customer dapat melihat pesanannya sendiri
        $response = $this->actingAs($customer)->get('/orders');
        $response->assertStatus(200);
        $response->assertSee($order->order_number);

        $response = $this->actingAs($customer)->get('/orders/' . $order->order_number);
        $response->assertStatus(200);
        $response->assertSee($order->order_number);

        // 15. Customer lain tidak dapat melihat order ini
        $otherCustomer = User::where('email', 'cindy@gmail.com')->first();
        $response = $this->actingAs($otherCustomer)->get('/orders/' . $order->order_number);
        $response->assertStatus(404);
    }

    /** 16. Admin login dan akses dashboard */
    public function test_admin_can_access_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
        $response->assertSee('Overview Toko');
    }

    /** 17. Customer tidak dapat mengakses admin dashboard */
    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::where('role', 'customer')->first();
        $response = $this->actingAs($customer)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    /** 18. Admin dapat CRUD kategori */
    public function test_admin_can_crud_category(): void
    {
        $admin = User::where('role', 'admin')->first();

        // Create
        $response = $this->actingAs($admin)->post('/admin/categories', [
            'name' => 'Retro Neon ' . time(),
            'description' => 'Kategori lampu neon retro',
        ]);
        $response->assertRedirect('/admin/categories');

        $category = Category::where('name', 'like', 'Retro Neon%')->first();
        $this->assertNotNull($category);

        // Update
        $response = $this->actingAs($admin)->put('/admin/categories/' . $category->id, [
            'name' => $category->name . ' Updated',
            'description' => 'Updated deskripsi',
        ]);
        $response->assertRedirect('/admin/categories');
        $this->assertStringContainsString('Updated', $category->fresh()->name);

        // Delete
        $response = $this->actingAs($admin)->delete('/admin/categories/' . $category->id);
        $response->assertRedirect('/admin/categories');
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }

    /** 19. Admin dapat mengupdate status order */
    public function test_admin_can_update_order_status(): void
    {
        $admin = User::where('role', 'admin')->first();
        $order = Order::latest()->first();

        if ($order) {
            $response = $this->actingAs($admin)->put('/admin/orders/' . $order->id . '/status', [
                'status' => 'Diproses',
                'payment_status' => 'paid',
            ]);
            $response->assertSessionHas('success');
            $this->assertEquals('Diproses', $order->fresh()->status);
            $this->assertEquals('paid', $order->fresh()->payment->payment_status);
        }
    }
}
