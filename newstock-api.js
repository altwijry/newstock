/**
 * NewStock API Client
 * Version: 2.0.0
 * 
 * JavaScript library for interacting with NewStock API v2
 */

class NewStockAPI {
    constructor(baseUrl = '/api/v2') {
        this.baseUrl = baseUrl;
        this.csrfToken = document.querySelector('meta[name="csrf-token"]')?.content;
    }

    /**
     * Make API request
     */
    async request(endpoint, options = {}) {
        const url = `${this.baseUrl}${endpoint}`;
        
        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': this.csrfToken
            }
        };

        const config = { ...defaultOptions, ...options };
        
        try {
            const response = await fetch(url, config);
            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'API request failed');
            }
            
            return data;
        } catch (error) {
            console.error('API Error:', error);
            throw error;
        }
    }

    /**
     * GET request
     */
    async get(endpoint, params = {}) {
        const queryString = new URLSearchParams(params).toString();
        const url = queryString ? `${endpoint}?${queryString}` : endpoint;
        
        return this.request(url, {
            method: 'GET'
        });
    }

    /**
     * POST request
     */
    async post(endpoint, data = {}) {
        return this.request(endpoint, {
            method: 'POST',
            body: JSON.stringify(data)
        });
    }

    // ==================== Products API ====================

    /**
     * Get all products
     */
    async getProducts(params = {}) {
        return this.get('/products', params);
    }

    /**
     * Get product by ID
     */
    async getProduct(id) {
        return this.get(`/products/${id}`);
    }

    /**
     * Get featured products
     */
    async getFeaturedProducts(limit = 12) {
        return this.get('/products/featured/list', { limit });
    }

    /**
     * Get hot products
     */
    async getHotProducts(limit = 12) {
        return this.get('/products/hot/list', { limit });
    }

    /**
     * Get new arrivals
     */
    async getNewArrivals(limit = 12) {
        return this.get('/products/new-arrivals/list', { limit });
    }

    /**
     * Get trending products
     */
    async getTrendingProducts(limit = 12) {
        return this.get('/products/trending/list', { limit });
    }

    /**
     * Get best selling products
     */
    async getBestSellingProducts(limit = 12) {
        return this.get('/products/best-selling/list', { limit });
    }

    /**
     * Get sale products
     */
    async getSaleProducts(limit = 12) {
        return this.get('/products/sale/list', { limit });
    }

    /**
     * Get products by category
     */
    async getProductsByCategory(categoryId, limit = 12) {
        return this.get(`/products/category/${categoryId}`, { limit });
    }

    /**
     * Get products by brand
     */
    async getProductsByBrand(brandId, limit = 12) {
        return this.get(`/products/brand/${brandId}`, { limit });
    }

    /**
     * Search products
     */
    async searchProducts(query, params = {}) {
        return this.get('/products/search/query', { q: query, ...params });
    }

    /**
     * Get product statistics
     */
    async getProductStatistics() {
        return this.get('/products/statistics/data');
    }

    // ==================== Catalog API ====================

    /**
     * Get catalogs by brand
     */
    async getCatalogsByBrand(brandName, params = {}) {
        return this.get(`/catalog/brand/${brandName}`, params);
    }

    /**
     * Get catalog tree level 1
     */
    async getCatalogTreeLevel1(catalogCode, params = {}) {
        return this.get(`/catalog/tree/level1/${catalogCode}`, params);
    }

    /**
     * Get catalog tree level 2
     */
    async getCatalogTreeLevel2(level1Code, params = {}) {
        return this.get(`/catalog/tree/level2/${level1Code}`, params);
    }

    /**
     * Get catalog tree level 3 (parts)
     */
    async getCatalogTreeLevel3(level2Code, params = {}) {
        return this.get(`/catalog/tree/level3/${level2Code}`, params);
    }

    /**
     * Search by VIN
     */
    async searchByVIN(vin) {
        return this.post('/catalog/search/vin', { vin });
    }

    /**
     * Get available years for a brand
     */
    async getAvailableYears(brandName) {
        return this.get(`/catalog/years/${brandName}`);
    }

    /**
     * Get available regions for a brand
     */
    async getAvailableRegions(brandName) {
        return this.get(`/catalog/regions/${brandName}`);
    }

    /**
     * Get catalog statistics
     */
    async getCatalogStatistics(brandName) {
        return this.get(`/catalog/statistics/${brandName}`);
    }

    // ==================== Categories API ====================

    /**
     * Get all categories
     */
    async getCategories() {
        return this.get('/categories');
    }

    /**
     * Get category by ID
     */
    async getCategory(id) {
        return this.get(`/categories/${id}`);
    }

    // ==================== Brands API ====================

    /**
     * Get all brands
     */
    async getBrands() {
        return this.get('/brands');
    }

    /**
     * Get brand by ID
     */
    async getBrand(id) {
        return this.get(`/brands/${id}`);
    }

    // ==================== Settings API ====================

    /**
     * Get general settings
     */
    async getSettings() {
        return this.get('/settings/general');
    }

    // ==================== Health Check ====================

    /**
     * Check API health
     */
    async healthCheck() {
        return this.get('/health');
    }
}

// ==================== Helper Functions ====================

/**
 * Format price with currency
 */
function formatPrice(price, currency = 'SAR') {
    return `${parseFloat(price).toFixed(2)} ${currency}`;
}

/**
 * Format date
 */
function formatDate(date) {
    return new Date(date).toLocaleDateString();
}

/**
 * Show loading spinner
 */
function showLoading(element) {
    element.innerHTML = '<div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div>';
}

/**
 * Hide loading spinner
 */
function hideLoading(element) {
    element.innerHTML = '';
}

/**
 * Show error message
 */
function showError(message, container = null) {
    const errorHtml = `
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    if (container) {
        container.innerHTML = errorHtml;
    } else {
        console.error(message);
    }
}

/**
 * Show success message
 */
function showSuccess(message, container = null) {
    const successHtml = `
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    `;
    
    if (container) {
        container.innerHTML = successHtml;
    }
}

/**
 * Render product card
 */
function renderProductCard(product) {
    return `
        <div class="product-card">
            <div class="product-image">
                <img src="${product.photo || '/assets/images/no-image.png'}" alt="${product.name}">
            </div>
            <div class="product-info">
                <h5 class="product-name">${product.name}</h5>
                <div class="product-price">
                    ${product.previous_price ? `<span class="price-old">${formatPrice(product.previous_price)}</span>` : ''}
                    <span class="price-current">${formatPrice(product.price)}</span>
                </div>
                <button class="btn btn-primary btn-sm" onclick="addToCart(${product.id})">
                    Add to Cart
                </button>
            </div>
        </div>
    `;
}

/**
 * Debounce function
 */
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

/**
 * Throttle function
 */
function throttle(func, limit) {
    let inThrottle;
    return function() {
        const args = arguments;
        const context = this;
        if (!inThrottle) {
            func.apply(context, args);
            inThrottle = true;
            setTimeout(() => inThrottle = false, limit);
        }
    };
}

// ==================== Initialize ====================

// Create global API instance
const newStockAPI = new NewStockAPI();

// Export for use in modules
if (typeof module !== 'undefined' && module.exports) {
    module.exports = { NewStockAPI, newStockAPI };
}

// ==================== Usage Examples ====================

/*

// Example 1: Get featured products
async function loadFeaturedProducts() {
    try {
        const response = await newStockAPI.getFeaturedProducts(12);
        console.log(response.data);
    } catch (error) {
        console.error('Error loading featured products:', error);
    }
}

// Example 2: Search products
async function searchProducts(query) {
    try {
        const response = await newStockAPI.searchProducts(query, {
            category_id: 1,
            min_price: 100,
            max_price: 1000,
            sort_by: 'price_low'
        });
        console.log(response.data);
    } catch (error) {
        console.error('Error searching products:', error);
    }
}

// Example 3: Get catalog by brand
async function loadCatalog(brandName) {
    try {
        const response = await newStockAPI.getCatalogsByBrand(brandName, {
            search_year: 2020,
            region: 'USA'
        });
        console.log(response.data);
    } catch (error) {
        console.error('Error loading catalog:', error);
    }
}

// Example 4: Search by VIN
async function searchByVIN(vin) {
    try {
        const response = await newStockAPI.searchByVIN(vin);
        console.log(response.data);
    } catch (error) {
        console.error('Error searching by VIN:', error);
    }
}

// Example 5: Load products with loading indicator
async function loadProductsWithLoading() {
    const container = document.getElementById('productsContainer');
    showLoading(container);
    
    try {
        const response = await newStockAPI.getFeaturedProducts(12);
        container.innerHTML = response.data.map(renderProductCard).join('');
    } catch (error) {
        showError('Failed to load products', container);
    }
}

*/

console.log('NewStock API v2.0.0 loaded successfully');
