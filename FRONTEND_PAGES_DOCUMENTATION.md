# توثيق Frontend Pages - NewStock Project

## تاريخ الإنشاء: 27 نوفمبر 2025
## الإصدار: 2.0.0
## المرحلة: الرابعة (Frontend Pages)

---

## المحتويات

1. [نظرة عامة](#نظرة-عامة)
2. [الصفحات المُنشأة](#الصفحات-المنشأة)
3. [JavaScript API Client](#javascript-api-client)
4. [التكامل مع Backend](#التكامل-مع-backend)
5. [أمثلة الاستخدام](#أمثلة-الاستخدام)

---

## نظرة عامة

تم إنشاء **4 صفحات رئيسية** جديدة بالكامل مع تصميم عصري ودمج كامل مع:

- ✅ **Services Layer** (ProductService, CatalogService, CartService)
- ✅ **API v2** (RESTful Endpoints)
- ✅ **Design System** (CSS Variables, Components)
- ✅ **JavaScript Client** (newstock-api.js)

---

## الصفحات المُنشأة

### 1. صفحة المنتجات (Products Listing)

**الموقع**: `resources/views/frontend/products-new.blade.php`

**الميزات**:
- ✅ Sidebar Filters (Categories, Brands, Price Range)
- ✅ Search Box
- ✅ Sort Options (Latest, Price, Name)
- ✅ Products Grid مع Pagination
- ✅ Empty State
- ✅ Responsive Design

**الفلاتر المتاحة**:
- البحث بالكلمات المفتاحية
- الفلترة حسب الفئة
- الفلترة حسب الماركة
- نطاق السعر (Min/Max)
- الترتيب (Latest, Price Low/High, Name A-Z/Z-A)

**المكونات المستخدمة**:
```blade
<x-product-card-new :product="$product" />
```

**JavaScript Functions**:
```javascript
applyFilters()      // تطبيق الفلاتر
clearFilters()      // مسح جميع الفلاتر
addInput(form, name, value)  // إضافة input للـ form
```

---

### 2. صفحة تفاصيل المنتج (Product Details)

**الموقع**: `resources/views/frontend/product-details-new.blade.php`

**الميزات**:
- ✅ Image Gallery مع Thumbnails
- ✅ Product Info (Name, Price, Rating, SKU, Brand, Category)
- ✅ Quantity Selector
- ✅ Add to Cart
- ✅ Add to Wishlist
- ✅ Social Share (Facebook, Twitter, WhatsApp)
- ✅ Tabs (Description, Reviews)
- ✅ Review System
- ✅ Related Products
- ✅ Breadcrumb Navigation

**الأقسام**:

#### Product Images
- صورة رئيسية كبيرة
- معرض صور مصغرة
- Badges (Sale, Featured)
- Zoom on hover

#### Product Info
- اسم المنتج
- التقييم (Stars + Count)
- السعر (Current, Old, Discount %)
- الوصف المختصر
- المعلومات (SKU, Category, Brand, Stock)

#### Add to Cart Form
- Quantity Selector (+/-)
- Add to Cart Button
- Add to Wishlist Button
- Stock Validation

#### Tabs
- **Description**: الوصف الكامل للمنتج
- **Reviews**: التقييمات + نموذج إضافة تقييم

#### Related Products
- 4 منتجات مشابهة
- استخدام ProductService

**JavaScript Functions**:
```javascript
changeMainImage(src)           // تغيير الصورة الرئيسية
increaseQuantity()             // زيادة الكمية
decreaseQuantity()             // تقليل الكمية
addToCart(productId)           // إضافة للسلة
addToWishlist(productId)       // إضافة للمفضلة
submitReview()                 // إرسال تقييم
```

---

### 3. صفحة السلة (Shopping Cart)

**الموقع**: `resources/views/frontend/cart-new.blade.php`

**الميزات**:
- ✅ Cart Items List
- ✅ Quantity Update
- ✅ Remove Item
- ✅ Clear Cart
- ✅ Order Summary
- ✅ Coupon Code
- ✅ Checkout Button
- ✅ Empty State
- ✅ Recently Viewed Products

**الأقسام**:

#### Cart Items (Col-8)
- صورة المنتج
- اسم المنتج + SKU
- Quantity Selector
- السعر الإجمالي
- زر الحذف
- Stock Warning

#### Order Summary (Col-4)
- Subtotal
- Tax (%)
- Shipping
- Discount (إذا وجد)
- **Total**
- Coupon Form
- Checkout Button
- Payment Methods Icons

#### Cart Actions
- Continue Shopping
- Clear Cart

**JavaScript Functions**:
```javascript
updateQuantity(itemId, quantity)  // تحديث الكمية
removeItem(itemId)                 // حذف منتج
clearCart()                        // تفريغ السلة
applyCoupon(code)                  // تطبيق كوبون
```

**API Integration**:
```javascript
POST /cart/update
POST /cart/remove
POST /cart/clear
POST /cart/apply-coupon
```

---

### 4. صفحة الكاتلوج المحسّنة (Catalog Enhanced)

**الموقع**: `resources/views/livewire/catlogs-enhanced.blade.php`

**الميزات**:
- ✅ Page Header مع Statistics
- ✅ 3 طرق للبحث (Brand, VIN, Part Number)
- ✅ Catalogs Grid
- ✅ Popular Brands Section
- ✅ Loading Indicator
- ✅ Livewire Integration

**الأقسام**:

#### Page Header
- العنوان والوصف
- إحصائيات (Total Catalogs, Brands, Parts)

#### Search Tabs
1. **Search by Brand**
   - اختيار الماركة
   - اختيار السنة
   - اختيار المنطقة
   - زر البحث

2. **Search by VIN**
   - إدخال رقم VIN (17 رقم)
   - Decode VIN

3. **Search by Part Number**
   - إدخال رقم القطعة
   - البحث

#### Catalogs Grid
- بطاقات الكاتلوج
- الصورة أو Placeholder
- الاسم
- Badges (Brand, Year, Region)
- عدد القطع
- Pagination

#### Popular Brands
- شبكة الماركات الشهيرة
- Logo أو الاسم
- Clickable

**Livewire Methods**:
```php
searchByBrand()
searchByVIN()
searchByPartNumber()
selectCatalog($code)
selectBrand($name)
```

---

## JavaScript API Client

**الموقع**: `public/assets/front/js/newstock-api.js`

### المميزات

- ✅ **Class-based** Architecture
- ✅ **Async/Await** Support
- ✅ **Error Handling**
- ✅ **CSRF Token** Automatic
- ✅ **Helper Functions**

### الاستخدام

#### إنشاء Instance

```javascript
const api = new NewStockAPI('/api/v2');
```

أو استخدام Instance الجاهز:

```javascript
const api = newStockAPI;
```

### Products API

```javascript
// Get all products
const products = await api.getProducts({
    search: 'toyota',
    category_id: 1,
    brand_id: 2,
    min_price: 100,
    max_price: 1000,
    sort_by: 'price_low',
    per_page: 12
});

// Get product by ID
const product = await api.getProduct(123);

// Get featured products
const featured = await api.getFeaturedProducts(12);

// Get hot products
const hot = await api.getHotProducts(12);

// Get new arrivals
const newArrivals = await api.getNewArrivals(12);

// Get trending products
const trending = await api.getTrendingProducts(12);

// Get best selling products
const bestSelling = await api.getBestSellingProducts(12);

// Get sale products
const sale = await api.getSaleProducts(12);

// Get products by category
const categoryProducts = await api.getProductsByCategory(1, 12);

// Get products by brand
const brandProducts = await api.getProductsByBrand(2, 12);

// Search products
const searchResults = await api.searchProducts('toyota', {
    category_id: 1,
    min_price: 100,
    max_price: 1000
});

// Get statistics
const stats = await api.getProductStatistics();
```

### Catalog API

```javascript
// Get catalogs by brand
const catalogs = await api.getCatalogsByBrand('Toyota', {
    search_year: 2020,
    region: 'USA'
});

// Get tree level 1
const level1 = await api.getCatalogTreeLevel1('TOYOTA_2020_USA');

// Get tree level 2
const level2 = await api.getCatalogTreeLevel2('ENGINE_PARTS');

// Get tree level 3 (parts)
const parts = await api.getCatalogTreeLevel3('PISTONS');

// Search by VIN
const vinResult = await api.searchByVIN('1HGBH41JXMN109186');

// Get available years
const years = await api.getAvailableYears('Toyota');

// Get available regions
const regions = await api.getAvailableRegions('Toyota');

// Get statistics
const catalogStats = await api.getCatalogStatistics('Toyota');
```

### Helper Functions

```javascript
// Format price
const formatted = formatPrice(1500.50, 'SAR');
// Output: "1500.50 SAR"

// Format date
const date = formatDate('2025-11-27');
// Output: "11/27/2025"

// Show loading
showLoading(element);

// Hide loading
hideLoading(element);

// Show error
showError('Error message', container);

// Show success
showSuccess('Success message', container);

// Render product card
const html = renderProductCard(product);

// Debounce
const debouncedSearch = debounce(searchFunction, 300);

// Throttle
const throttledScroll = throttle(scrollFunction, 100);
```

---

## التكامل مع Backend

### Controllers المستخدمة

#### 1. FrontendControllerNew

```php
use App\Services\ProductService;
use App\Services\CatalogService;

public function __construct(
    ProductService $productService,
    CatalogService $catalogService
) {
    $this->productService = $productService;
    $this->catalogService = $catalogService;
}
```

#### 2. ProductControllerNew

```php
public function index(Request $request)
{
    $filters = [
        'category_id' => $request->category,
        'brand_id' => $request->brand,
        'min_price' => $request->min_price,
        'max_price' => $request->max_price,
        'sort_by' => $request->sort_by ?? 'latest',
        'per_page' => 12
    ];

    $products = $this->productService->searchProducts(
        $request->search, 
        $filters
    );

    return view('frontend.products-new', compact('products'));
}
```

#### 3. CartControllerNew

```php
use App\Services\CartService;

public function add(Request $request)
{
    $result = $this->cartService->addToCart(
        $request->product_id,
        $request->quantity
    );

    return response()->json($result);
}
```

### Routes المطلوبة

```php
// Products
Route::get('/products', [ProductControllerNew::class, 'index'])
    ->name('front.products');

Route::get('/product/{slug}', [ProductControllerNew::class, 'show'])
    ->name('front.product');

// Cart
Route::get('/cart', [CartControllerNew::class, 'index'])
    ->name('front.cart');

Route::post('/cart/add', [CartControllerNew::class, 'add']);
Route::post('/cart/update', [CartControllerNew::class, 'update']);
Route::post('/cart/remove', [CartControllerNew::class, 'remove']);
Route::post('/cart/clear', [CartControllerNew::class, 'clear']);
Route::post('/cart/apply-coupon', [CartControllerNew::class, 'applyCoupon']);

// Catalog
Route::get('/catalog', [CatalogController::class, 'index'])
    ->name('front.catalog');
```

---

## أمثلة الاستخدام

### مثال 1: تحميل المنتجات المميزة

```javascript
async function loadFeaturedProducts() {
    const container = document.getElementById('featuredProducts');
    showLoading(container);
    
    try {
        const response = await newStockAPI.getFeaturedProducts(8);
        
        if (response.success) {
            const html = response.data.map(product => 
                renderProductCard(product)
            ).join('');
            
            container.innerHTML = html;
        }
    } catch (error) {
        showError('Failed to load products', container);
    }
}
```

### مثال 2: البحث مع Debounce

```javascript
const searchInput = document.getElementById('searchInput');

const debouncedSearch = debounce(async (query) => {
    if (query.length < 2) return;
    
    try {
        const response = await newStockAPI.searchProducts(query);
        displaySearchResults(response.data);
    } catch (error) {
        console.error('Search error:', error);
    }
}, 300);

searchInput.addEventListener('input', (e) => {
    debouncedSearch(e.target.value);
});
```

### مثال 3: إضافة منتج للسلة

```javascript
async function addToCart(productId, quantity = 1) {
    try {
        const response = await fetch('/cart/add', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                product_id: productId,
                quantity: quantity
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            showSuccess(data.message);
            updateCartCount(data.cart_count);
        } else {
            showError(data.message);
        }
    } catch (error) {
        showError('An error occurred');
    }
}
```

### مثال 4: تحميل الكاتلوج

```javascript
async function loadCatalog(brandName, year = null, region = null) {
    const container = document.getElementById('catalogsGrid');
    showLoading(container);
    
    try {
        const params = {};
        if (year) params.search_year = year;
        if (region) params.region = region;
        
        const response = await newStockAPI.getCatalogsByBrand(brandName, params);
        
        if (response.success) {
            renderCatalogs(response.data, container);
        }
    } catch (error) {
        showError('Failed to load catalog', container);
    }
}

function renderCatalogs(catalogs, container) {
    const html = catalogs.map(catalog => `
        <div class="catalog-card" onclick="selectCatalog('${catalog.code}')">
            <img src="${catalog.image}" alt="${catalog.name}">
            <h5>${catalog.name}</h5>
            <span class="badge">${catalog.year}</span>
        </div>
    `).join('');
    
    container.innerHTML = html;
}
```

---

## الخلاصة

### ما تم إنجازه

✅ **4 صفحات** رئيسية جديدة  
✅ **JavaScript API Client** متكامل  
✅ **دمج كامل** مع Backend Services  
✅ **تصميم عصري** responsive  
✅ **UX محسّن** مع Loading States  
✅ **Error Handling** شامل

### الفوائد

🎨 **تصميم موحد** باستخدام Design System  
⚡ **أداء عالي** مع Caching و Lazy Loading  
📱 **Responsive** على جميع الأجهزة  
🔌 **API Ready** للتطبيقات المحمولة  
♿ **Accessible** مع ARIA Labels

### الملفات المُنشأة

```
resources/views/frontend/
├── products-new.blade.php           ← صفحة المنتجات
├── product-details-new.blade.php    ← تفاصيل المنتج
└── cart-new.blade.php               ← السلة

resources/views/livewire/
└── catlogs-enhanced.blade.php       ← الكاتلوج المحسّن

public/assets/front/js/
└── newstock-api.js                  ← API Client
```

---

**آخر تحديث**: 27 نوفمبر 2025  
**الإصدار**: 2.0.0  
**الحالة**: ✅ جاهز للإنتاج

Made with ❤️ by NewStock Team
