<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\ProductService;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

/**
 * Product Service Test
 *
 * Unit tests for ProductService class to ensure
 * all methods work correctly and return expected results.
 *
 * @package Tests\Unit\Services
 * @author NewStock Team
 * @version 2.0.0
 */
class ProductServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Product Service instance
     *
     * @var ProductService
     */
    protected ProductService $service;

    /**
     * Setup the test environment
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new ProductService();
        Cache::flush();
    }

    /**
     * Test get featured products returns correct count
     *
     * @return void
     */
    public function test_get_featured_products_returns_correct_count(): void
    {
        // Arrange
        Product::factory()->count(20)->create(['featured' => 1, 'status' => 1]);
        
        // Act
        $products = $this->service->getFeaturedProducts(12);
        
        // Assert
        $this->assertCount(12, $products);
    }

    /**
     * Test get featured products returns only featured items
     *
     * @return void
     */
    public function test_get_featured_products_returns_only_featured(): void
    {
        // Arrange
        Product::factory()->count(10)->create(['featured' => 1, 'status' => 1]);
        Product::factory()->count(10)->create(['featured' => 0, 'status' => 1]);
        
        // Act
        $products = $this->service->getFeaturedProducts(20);
        
        // Assert
        $this->assertTrue($products->every(fn($p) => $p->featured == 1));
    }

    /**
     * Test get featured products uses cache
     *
     * @return void
     */
    public function test_get_featured_products_uses_cache(): void
    {
        // Arrange
        Product::factory()->count(5)->create(['featured' => 1, 'status' => 1]);
        
        // Act - First call
        $products1 = $this->service->getFeaturedProducts(5);
        
        // Delete all products
        Product::query()->delete();
        
        // Act - Second call (should return cached results)
        $products2 = $this->service->getFeaturedProducts(5);
        
        // Assert
        $this->assertCount(5, $products2);
        $this->assertEquals($products1->pluck('id'), $products2->pluck('id'));
    }

    /**
     * Test get hot products returns correct count
     *
     * @return void
     */
    public function test_get_hot_products_returns_correct_count(): void
    {
        // Arrange
        Product::factory()->count(20)->create(['hot' => 1, 'status' => 1]);
        
        // Act
        $products = $this->service->getHotProducts(10);
        
        // Assert
        $this->assertCount(10, $products);
    }

    /**
     * Test get hot products returns only hot items
     *
     * @return void
     */
    public function test_get_hot_products_returns_only_hot(): void
    {
        // Arrange
        Product::factory()->count(8)->create(['hot' => 1, 'status' => 1]);
        Product::factory()->count(8)->create(['hot' => 0, 'status' => 1]);
        
        // Act
        $products = $this->service->getHotProducts(15);
        
        // Assert
        $this->assertTrue($products->every(fn($p) => $p->hot == 1));
    }

    /**
     * Test get new products returns latest items
     *
     * @return void
     */
    public function test_get_new_products_returns_latest(): void
    {
        // Arrange
        $oldProduct = Product::factory()->create([
            'status' => 1,
            'created_at' => now()->subDays(10)
        ]);
        
        $newProduct = Product::factory()->create([
            'status' => 1,
            'created_at' => now()
        ]);
        
        // Act
        $products = $this->service->getNewProducts(2);
        
        // Assert
        $this->assertEquals($newProduct->id, $products->first()->id);
    }

    /**
     * Test search products with keyword
     *
     * @return void
     */
    public function test_search_products_with_keyword(): void
    {
        // Arrange
        Product::factory()->create([
            'name' => 'iPhone 15 Pro Max',
            'status' => 1
        ]);
        
        Product::factory()->create([
            'name' => 'Samsung Galaxy S24',
            'status' => 1
        ]);
        
        // Act
        $products = $this->service->searchProducts(['keyword' => 'iPhone']);
        
        // Assert
        $this->assertCount(1, $products);
        $this->assertStringContainsString('iPhone', $products->first()->name);
    }

    /**
     * Test search products with category filter
     *
     * @return void
     */
    public function test_search_products_with_category_filter(): void
    {
        // Arrange
        $category = Category::factory()->create();
        
        Product::factory()->count(5)->create([
            'category_id' => $category->id,
            'status' => 1
        ]);
        
        Product::factory()->count(3)->create(['status' => 1]);
        
        // Act
        $products = $this->service->searchProducts(['category_id' => $category->id]);
        
        // Assert
        $this->assertCount(5, $products);
        $this->assertTrue($products->every(fn($p) => $p->category_id == $category->id));
    }

    /**
     * Test search products with brand filter
     *
     * @return void
     */
    public function test_search_products_with_brand_filter(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        
        Product::factory()->count(4)->create([
            'brand_id' => $brand->id,
            'status' => 1
        ]);
        
        Product::factory()->count(6)->create(['status' => 1]);
        
        // Act
        $products = $this->service->searchProducts(['brand_id' => $brand->id]);
        
        // Assert
        $this->assertCount(4, $products);
        $this->assertTrue($products->every(fn($p) => $p->brand_id == $brand->id));
    }

    /**
     * Test search products with price range
     *
     * @return void
     */
    public function test_search_products_with_price_range(): void
    {
        // Arrange
        Product::factory()->create(['price' => 100, 'status' => 1]);
        Product::factory()->create(['price' => 500, 'status' => 1]);
        Product::factory()->create(['price' => 1000, 'status' => 1]);
        
        // Act
        $products = $this->service->searchProducts([
            'price_min' => 200,
            'price_max' => 800
        ]);
        
        // Assert
        $this->assertCount(1, $products);
        $this->assertEquals(500, $products->first()->price);
    }

    /**
     * Tear down the test environment
     *
     * @return void
     */
    protected function tearDown(): void
    {
        Cache::flush();
        parent::tearDown();
    }
}
