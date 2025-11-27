<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CartService;
use App\Models\Product;
use App\Models\Cart;
use App\Models\User;
use App\Models\Coupon;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Cart Service Test
 *
 * Unit tests for CartService class to ensure
 * all cart-related operations work correctly.
 *
 * @package Tests\Unit\Services
 * @author NewStock Team
 * @version 2.0.0
 */
class CartServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Cart Service instance
     *
     * @var CartService
     */
    protected CartService $service;

    /**
     * Test user
     *
     * @var User
     */
    protected User $user;

    /**
     * Setup the test environment
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CartService();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /**
     * Test add product to cart
     *
     * @return void
     */
    public function test_add_product_to_cart(): void
    {
        // Arrange
        $product = Product::factory()->create(['price' => 100, 'stock' => 10]);
        
        // Act
        $cart = $this->service->addToCart($product->id, 2);
        
        // Assert
        $this->assertNotNull($cart);
        $this->assertEquals($product->id, $cart->product_id);
        $this->assertEquals(2, $cart->quantity);
    }

    /**
     * Test add product with insufficient stock fails
     *
     * @return void
     */
    public function test_add_product_with_insufficient_stock_fails(): void
    {
        // Arrange
        $product = Product::factory()->create(['price' => 100, 'stock' => 5]);
        
        // Act & Assert
        $this->expectException(\Exception::class);
        $this->service->addToCart($product->id, 10);
    }

    /**
     * Test update cart item quantity
     *
     * @return void
     */
    public function test_update_cart_item_quantity(): void
    {
        // Arrange
        $product = Product::factory()->create(['price' => 100, 'stock' => 20]);
        $cart = Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        
        // Act
        $updated = $this->service->updateQuantity($cart->id, 5);
        
        // Assert
        $this->assertEquals(5, $updated->quantity);
    }

    /**
     * Test remove item from cart
     *
     * @return void
     */
    public function test_remove_item_from_cart(): void
    {
        // Arrange
        $product = Product::factory()->create();
        $cart = Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product->id
        ]);
        
        // Act
        $result = $this->service->removeFromCart($cart->id);
        
        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseMissing('carts', ['id' => $cart->id]);
    }

    /**
     * Test get cart items for user
     *
     * @return void
     */
    public function test_get_cart_items_for_user(): void
    {
        // Arrange
        Cart::factory()->count(3)->create(['user_id' => $this->user->id]);
        Cart::factory()->count(2)->create(); // Other user's cart
        
        // Act
        $items = $this->service->getCartItems();
        
        // Assert
        $this->assertCount(3, $items);
        $this->assertTrue($items->every(fn($i) => $i->user_id == $this->user->id));
    }

    /**
     * Test calculate cart total
     *
     * @return void
     */
    public function test_calculate_cart_total(): void
    {
        // Arrange
        $product1 = Product::factory()->create(['price' => 100]);
        $product2 = Product::factory()->create(['price' => 200]);
        
        Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product1->id,
            'quantity' => 2
        ]);
        
        Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product2->id,
            'quantity' => 1
        ]);
        
        // Act
        $total = $this->service->calculateTotal();
        
        // Assert
        $this->assertEquals(400, $total); // (100 * 2) + (200 * 1)
    }

    /**
     * Test apply coupon to cart
     *
     * @return void
     */
    public function test_apply_coupon_to_cart(): void
    {
        // Arrange
        $coupon = Coupon::factory()->create([
            'code' => 'SAVE20',
            'type' => 'percentage',
            'value' => 20,
            'status' => 1
        ]);
        
        $product = Product::factory()->create(['price' => 100]);
        Cart::factory()->create([
            'user_id' => $this->user->id,
            'product_id' => $product->id,
            'quantity' => 1
        ]);
        
        // Act
        $discount = $this->service->applyCoupon('SAVE20');
        
        // Assert
        $this->assertEquals(20, $discount); // 20% of 100
    }

    /**
     * Test apply invalid coupon fails
     *
     * @return void
     */
    public function test_apply_invalid_coupon_fails(): void
    {
        // Act & Assert
        $this->expectException(\Exception::class);
        $this->service->applyCoupon('INVALID');
    }

    /**
     * Test clear cart
     *
     * @return void
     */
    public function test_clear_cart(): void
    {
        // Arrange
        Cart::factory()->count(5)->create(['user_id' => $this->user->id]);
        
        // Act
        $result = $this->service->clearCart();
        
        // Assert
        $this->assertTrue($result);
        $this->assertDatabaseMissing('carts', ['user_id' => $this->user->id]);
    }

    /**
     * Test get cart count
     *
     * @return void
     */
    public function test_get_cart_count(): void
    {
        // Arrange
        Cart::factory()->count(7)->create(['user_id' => $this->user->id]);
        
        // Act
        $count = $this->service->getCartCount();
        
        // Assert
        $this->assertEquals(7, $count);
    }
}
