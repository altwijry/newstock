<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\CatalogService;
use App\Models\Catlog;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;

/**
 * Catalog Service Test
 *
 * Unit tests for CatalogService class to ensure
 * all catalog-related methods work correctly.
 *
 * @package Tests\Unit\Services
 * @author NewStock Team
 * @version 2.0.0
 */
class CatalogServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Catalog Service instance
     *
     * @var CatalogService
     */
    protected CatalogService $service;

    /**
     * Setup the test environment
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new CatalogService();
        Cache::flush();
    }

    /**
     * Test get catalogs by brand
     *
     * @return void
     */
    public function test_get_catalogs_by_brand(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        Catlog::factory()->count(5)->create(['brand_id' => $brand->id]);
        Catlog::factory()->count(3)->create();
        
        // Act
        $catalogs = $this->service->getCatalogsByBrand($brand->id);
        
        // Assert
        $this->assertCount(5, $catalogs);
        $this->assertTrue($catalogs->every(fn($c) => $c->brand_id == $brand->id));
    }

    /**
     * Test get catalogs uses cache
     *
     * @return void
     */
    public function test_get_catalogs_uses_cache(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        Catlog::factory()->count(3)->create(['brand_id' => $brand->id]);
        
        // Act - First call
        $catalogs1 = $this->service->getCatalogsByBrand($brand->id);
        
        // Delete all catalogs
        Catlog::query()->delete();
        
        // Act - Second call (should return cached results)
        $catalogs2 = $this->service->getCatalogsByBrand($brand->id);
        
        // Assert
        $this->assertCount(3, $catalogs2);
        $this->assertEquals($catalogs1->pluck('id'), $catalogs2->pluck('id'));
    }

    /**
     * Test search catalogs by VIN
     *
     * @return void
     */
    public function test_search_catalogs_by_vin(): void
    {
        // Arrange
        Catlog::factory()->create([
            'vin' => 'ABC123XYZ',
            'status' => 1
        ]);
        
        Catlog::factory()->create([
            'vin' => 'DEF456UVW',
            'status' => 1
        ]);
        
        // Act
        $catalogs = $this->service->searchByVIN('ABC123');
        
        // Assert
        $this->assertCount(1, $catalogs);
        $this->assertStringContainsString('ABC123', $catalogs->first()->vin);
    }

    /**
     * Test get available years
     *
     * @return void
     */
    public function test_get_available_years(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        Catlog::factory()->create(['brand_id' => $brand->id, 'year' => 2020]);
        Catlog::factory()->create(['brand_id' => $brand->id, 'year' => 2021]);
        Catlog::factory()->create(['brand_id' => $brand->id, 'year' => 2022]);
        
        // Act
        $years = $this->service->getAvailableYears($brand->id);
        
        // Assert
        $this->assertCount(3, $years);
        $this->assertTrue(in_array(2020, $years));
        $this->assertTrue(in_array(2021, $years));
        $this->assertTrue(in_array(2022, $years));
    }

    /**
     * Test get catalog tree level 1
     *
     * @return void
     */
    public function test_get_catalog_tree_level_1(): void
    {
        // Arrange
        $catalog = Catlog::factory()->create();
        
        // Create level 1 categories
        $categories = collect([
            ['code' => 'CAT01', 'name' => 'Category 1'],
            ['code' => 'CAT02', 'name' => 'Category 2'],
        ]);
        
        // Act
        $tree = $this->service->getTreeLevel1($catalog->id);
        
        // Assert
        $this->assertIsArray($tree);
    }

    /**
     * Test get catalog statistics
     *
     * @return void
     */
    public function test_get_catalog_statistics(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        Catlog::factory()->count(10)->create(['brand_id' => $brand->id]);
        
        // Act
        $stats = $this->service->getCatalogStatistics($brand->id);
        
        // Assert
        $this->assertIsArray($stats);
        $this->assertArrayHasKey('total_catalogs', $stats);
        $this->assertEquals(10, $stats['total_catalogs']);
    }

    /**
     * Test filter catalogs by year
     *
     * @return void
     */
    public function test_filter_catalogs_by_year(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        Catlog::factory()->count(3)->create([
            'brand_id' => $brand->id,
            'year' => 2023
        ]);
        Catlog::factory()->count(2)->create([
            'brand_id' => $brand->id,
            'year' => 2024
        ]);
        
        // Act
        $catalogs = $this->service->getCatalogsByBrand($brand->id, ['year' => 2023]);
        
        // Assert
        $this->assertCount(3, $catalogs);
        $this->assertTrue($catalogs->every(fn($c) => $c->year == 2023));
    }

    /**
     * Test filter catalogs by region
     *
     * @return void
     */
    public function test_filter_catalogs_by_region(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        Catlog::factory()->count(4)->create([
            'brand_id' => $brand->id,
            'region' => 'USA'
        ]);
        Catlog::factory()->count(3)->create([
            'brand_id' => $brand->id,
            'region' => 'EUR'
        ]);
        
        // Act
        $catalogs = $this->service->getCatalogsByBrand($brand->id, ['region' => 'USA']);
        
        // Assert
        $this->assertCount(4, $catalogs);
        $this->assertTrue($catalogs->every(fn($c) => $c->region == 'USA'));
    }

    /**
     * Test get catalog by ID
     *
     * @return void
     */
    public function test_get_catalog_by_id(): void
    {
        // Arrange
        $catalog = Catlog::factory()->create(['name' => 'Test Catalog']);
        
        // Act
        $result = $this->service->getCatalogById($catalog->id);
        
        // Assert
        $this->assertNotNull($result);
        $this->assertEquals('Test Catalog', $result->name);
    }

    /**
     * Test get catalog by ID with invalid ID returns null
     *
     * @return void
     */
    public function test_get_catalog_by_invalid_id_returns_null(): void
    {
        // Act
        $result = $this->service->getCatalogById(99999);
        
        // Assert
        $this->assertNull($result);
    }

    /**
     * Test cache is cleared after catalog update
     *
     * @return void
     */
    public function test_cache_cleared_after_update(): void
    {
        // Arrange
        $brand = Brand::factory()->create();
        $catalog = Catlog::factory()->create(['brand_id' => $brand->id]);
        
        // Cache the results
        $this->service->getCatalogsByBrand($brand->id);
        
        // Act
        $this->service->clearCache($brand->id);
        
        // Assert
        $this->assertFalse(Cache::has("catalogs_brand_{$brand->id}"));
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
