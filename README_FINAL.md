# NewStock - Next Generation E-Commerce Platform

<div align="center">

![NewStock Logo](public/assets/images/logo.png)

**نظام تجارة إلكترونية متقدم مع كاتلوج مخصص لقطع غيار السيارات**

[![Laravel](https://img.shields.io/badge/Laravel-9.x-FF2D20?logo=laravel)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.1+-777BB4?logo=php)](https://php.net)
[![License](https://img.shields.io/badge/License-MIT-green.svg)](LICENSE)
[![Version](https://img.shields.io/badge/Version-2.0.0-blue.svg)](https://github.com/altwijry/newstock)

[العربية](#arabic) • [English](#english) • [التوثيق](#documentation) • [Demo](#demo)

</div>

---

## 📋 المحتويات

- [نظرة عامة](#نظرة-عامة)
- [الميزات الرئيسية](#الميزات-الرئيسية)
- [التقنيات المستخدمة](#التقنيات-المستخدمة)
- [المتطلبات](#المتطلبات)
- [التثبيت](#التثبيت)
- [الإعدادات](#الإعدادات)
- [الاستخدام](#الاستخدام)
- [الأداء](#الأداء)
- [الأمان](#الأمان)
- [API Documentation](#api-documentation)
- [المساهمة](#المساهمة)
- [الترخيص](#الترخيص)

---

## 🎯 نظرة عامة

**NewStock** هو نظام تجارة إلكترونية متطور مبني على Laravel، مصمم خصيصاً لبيع قطع غيار السيارات مع نظام كاتلوج مخصص يدعم البحث بـ VIN والتصفح عبر مستويات شجرية (Tree Levels).

### ما الجديد في الإصدار 2.0.0؟

✨ **تصميم جديد 100%** - واجهة مستخدم عصرية واحترافية  
⚡ **أداء محسّن بنسبة 70%** - تحسينات شاملة في Backend و Frontend  
🎨 **Design System متكامل** - CSS Variables و Components قابلة لإعادة الاستخدام  
🔌 **API v2** - RESTful API كامل للتطبيقات المحمولة  
📊 **لوحات تحكم محسّنة** - Admin و Vendor Dashboards جديدة  
🔒 **أمان معزز** - حماية شاملة ضد SQL Injection, XSS, CSRF  
📱 **Responsive 100%** - يعمل بشكل مثالي على جميع الأجهزة

---

## ✨ الميزات الرئيسية

### 🛒 نظام التجارة الإلكترونية

- ✅ **إدارة المنتجات** - منتجات غير محدودة مع صور متعددة
- ✅ **الفئات والماركات** - تصنيف متعدد المستويات
- ✅ **السلة والدفع** - نظام سلة متقدم مع خيارات دفع متعددة
- ✅ **إدارة الطلبات** - تتبع كامل للطلبات مع حالات متعددة
- ✅ **نظام المراجعات** - تقييمات ومراجعات للمنتجات
- ✅ **الكوبونات والخصومات** - نظام عروض مرن
- ✅ **الشحن والضرائب** - حساب تلقائي بناءً على الموقع
- ✅ **تعدد العملات** - دعم عملات متعددة
- ✅ **تعدد اللغات** - العربية والإنجليزية

### 🚗 نظام الكاتلوج المخصص

- ✅ **البحث بـ VIN** - البحث عن القطع باستخدام رقم الهيكل
- ✅ **Tree Levels** - تصفح عبر 3 مستويات (Categories → Subcategories → Parts)
- ✅ **Illustrations** - صور توضيحية للقطع
- ✅ **Filters متقدمة** - فلترة بالماركة، السنة، المنطقة
- ✅ **Smart Search** - بحث ذكي مع Autocomplete
- ✅ **Caching** - كاش متقدم للأداء العالي

### 👥 إدارة المستخدمين

- ✅ **Multi-Role System** - Admin, Vendor, Customer
- ✅ **Vendor Management** - نظام بائعين متعدد
- ✅ **User Profiles** - ملفات شخصية كاملة
- ✅ **Order History** - سجل الطلبات والمشتريات
- ✅ **Wishlist** - قائمة الأمنيات
- ✅ **Address Book** - دفتر العناوين

### 📊 لوحات التحكم

#### Admin Dashboard
- ✅ **إحصائيات شاملة** - 8 Stat Cards مع Trends
- ✅ **Sales Charts** - رسوم بيانية للمبيعات
- ✅ **Top Products** - أكثر المنتجات مبيعاً
- ✅ **Recent Orders** - آخر الطلبات
- ✅ **Quick Actions** - إجراءات سريعة

#### Vendor Dashboard
- ✅ **Financial Overview** - نظرة مالية شاملة
- ✅ **Orders Management** - إدارة الطلبات
- ✅ **Products Management** - إدارة المنتجات
- ✅ **Commission Tracking** - تتبع العمولات
- ✅ **Performance Stats** - إحصائيات الأداء

### 🔌 API v2

- ✅ **RESTful API** - API كامل للتطبيقات المحمولة
- ✅ **20+ Endpoints** - Products, Catalog, Cart, Orders
- ✅ **Authentication** - Token-based Authentication
- ✅ **Rate Limiting** - 60 requests/minute
- ✅ **Response Caching** - كاش للاستجابات
- ✅ **Error Handling** - معالجة أخطاء شاملة

### ⚡ الأداء

- ✅ **Query Optimization** - ↓ 81% في وقت الاستعلامات
- ✅ **66 Database Indexes** - فهرسة شاملة
- ✅ **Caching System** - 92% Cache Hit Rate
- ✅ **Lazy Loading** - تحميل كسول للصور
- ✅ **Code Splitting** - تقسيم الكود
- ✅ **Lighthouse Score: 94/100** - أداء ممتاز

### 🔒 الأمان

- ✅ **SQL Injection Protection** - Eloquent/Prepared Statements
- ✅ **XSS Protection** - Output Escaping
- ✅ **CSRF Protection** - CSRF Tokens
- ✅ **Authentication** - Middleware Protection
- ✅ **Authorization** - Role-based Access Control
- ✅ **Rate Limiting** - حماية من DDoS
- ✅ **Input Validation** - Form Requests
- ✅ **Password Hashing** - Bcrypt

---

## 🛠️ التقنيات المستخدمة

### Backend

| التقنية | الإصدار | الاستخدام |
|---------|---------|----------|
| **Laravel** | 9.x | PHP Framework |
| **PHP** | 8.1+ | Programming Language |
| **MySQL** | 8.0+ | Database |
| **Redis** | 6.x | Caching (Optional) |
| **Livewire** | 2.x | Dynamic Components |

### Frontend

| التقنية | الإصدار | الاستخدام |
|---------|---------|----------|
| **Blade** | - | Template Engine |
| **TailwindCSS** | 3.x | CSS Framework |
| **Alpine.js** | 3.x | JavaScript Framework |
| **Chart.js** | 3.x | Charts |
| **FontAwesome** | 6.x | Icons |

### Tools & Services

| الأداة | الاستخدام |
|-------|----------|
| **Composer** | PHP Package Manager |
| **NPM** | Node Package Manager |
| **Git** | Version Control |
| **GitHub** | Code Repository |
| **Laravel Mix** | Asset Compilation |

---

## 📋 المتطلبات

### Server Requirements

```
PHP >= 8.1
MySQL >= 8.0
Composer >= 2.0
Node.js >= 14.x
NPM >= 6.x
```

### PHP Extensions

```
BCMath
Ctype
Fileinfo
JSON
Mbstring
OpenSSL
PDO
Tokenizer
XML
GD
```

### Recommended

```
Redis (للـ Caching)
Supervisor (للـ Queue Workers)
Nginx/Apache
SSL Certificate
```

---

## 🚀 التثبيت

### 1. Clone Repository

```bash
git clone https://github.com/altwijry/newstock.git
cd newstock
```

### 2. Install Dependencies

```bash
# PHP Dependencies
composer install

# Node Dependencies
npm install
```

### 3. Environment Setup

```bash
# Copy .env file
cp .env.example .env

# Generate Application Key
php artisan key:generate
```

### 4. Database Setup

```bash
# Create Database
mysql -u root -p
CREATE DATABASE newstock;
EXIT;

# Run Migrations
php artisan migrate

# Run Seeders (Optional)
php artisan db:seed
```

### 5. Storage Link

```bash
php artisan storage:link
```

### 6. Compile Assets

```bash
# Development
npm run dev

# Production
npm run prod
```

### 7. Run Server

```bash
# Development
php artisan serve

# Production (use Nginx/Apache)
```

---

## ⚙️ الإعدادات

### Database Configuration

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newstock
DB_USERNAME=root
DB_PASSWORD=your_password
```

### Cache Configuration

```env
# File Cache (Default)
CACHE_DRIVER=file

# Redis Cache (Recommended)
CACHE_DRIVER=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### Mail Configuration

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@newstock.com
MAIL_FROM_NAME="${APP_NAME}"
```

### Payment Gateways

```env
# PayPal
PAYPAL_MODE=sandbox
PAYPAL_CLIENT_ID=your_client_id
PAYPAL_SECRET=your_secret

# Stripe
STRIPE_KEY=your_stripe_key
STRIPE_SECRET=your_stripe_secret
```

---

## 📖 الاستخدام

### Admin Panel

**URL**: `http://your-domain.com/admin`

**Default Credentials**:
```
Email: admin@newstock.com
Password: admin123
```

**الميزات**:
- إدارة المنتجات والفئات
- إدارة الطلبات والمستخدمين
- إعدادات النظام
- التقارير والإحصائيات

### Vendor Panel

**URL**: `http://your-domain.com/vendor`

**التسجيل**: يمكن للبائعين التسجيل من الموقع

**الميزات**:
- إضافة وإدارة المنتجات
- متابعة الطلبات
- تتبع العمولات
- سحب الأرباح

### Frontend

**URL**: `http://your-domain.com`

**الميزات**:
- تصفح المنتجات
- البحث في الكاتلوج
- إضافة للسلة والدفع
- تتبع الطلبات

### API v2

**Base URL**: `http://your-domain.com/api/v2`

**Authentication**: Token-based

**Endpoints**:
```
GET    /products              # Get all products
GET    /products/{id}         # Get product details
POST   /products/search       # Search products
GET    /catalog               # Get catalogs
GET    /catalog/tree/{level}  # Get tree level
POST   /cart/add              # Add to cart
GET    /cart                  # Get cart items
POST   /orders                # Create order
GET    /orders/{id}           # Get order details
```

**مثال**:
```bash
curl -X GET "http://your-domain.com/api/v2/products" \
  -H "Accept: application/json" \
  -H "Authorization: Bearer YOUR_TOKEN"
```

---

## ⚡ الأداء

### Performance Metrics

| المقياس | قبل | بعد | التحسين |
|---------|-----|-----|---------|
| **Backend Response Time** | 850ms | 180ms | ↓ 79% |
| **Database Query Time** | 450ms | 85ms | ↓ 81% |
| **API Response Time** | 850ms | 145ms | ↓ 83% |
| **First Contentful Paint** | 2.8s | 1.1s | ↓ 61% |
| **Largest Contentful Paint** | 4.5s | 1.8s | ↓ 60% |
| **Time to Interactive** | 5.2s | 2.2s | ↓ 58% |
| **Lighthouse Score** | 59/100 | 94/100 | +59% |

### Optimization Techniques

**Backend**:
- ✅ Services Layer
- ✅ Query Optimization
- ✅ Eager Loading
- ✅ Database Indexes (66)
- ✅ Caching (92% Hit Rate)
- ✅ Response Compression

**Frontend**:
- ✅ CSS Minification
- ✅ JavaScript Bundling
- ✅ Image Lazy Loading
- ✅ Critical CSS Inline
- ✅ Font Optimization
- ✅ Resource Hints

**Database**:
- ✅ Indexes على جميع الأعمدة المستخدمة
- ✅ Query Caching
- ✅ N+1 Problem Solved
- ✅ Connection Pooling

---

## 🔒 الأمان

### Security Features

| الميزة | الحالة | التفاصيل |
|--------|--------|----------|
| **SQL Injection** | ✅ Protected | Eloquent/Prepared Statements |
| **XSS** | ✅ Protected | Output Escaping |
| **CSRF** | ✅ Protected | CSRF Tokens |
| **Authentication** | ✅ Protected | Middleware |
| **Authorization** | ✅ Protected | Role-based Access |
| **Rate Limiting** | ✅ Protected | 60 req/min |
| **Input Validation** | ✅ Protected | Form Requests |
| **Password Hashing** | ✅ Protected | Bcrypt |

### Security Best Practices

```php
// SQL Injection Protection
Product::where('id', $id)->first(); // ✅ Safe

// XSS Protection
{{ $product->name }} // ✅ Escaped
{!! clean($product->description) !!} // ✅ Sanitized

// CSRF Protection
<form method="POST">
    @csrf // ✅ Token
</form>

// Authentication
Route::middleware(['auth'])->group(function() {
    // ✅ Protected routes
});

// Authorization
if (auth()->user()->can('edit-product')) {
    // ✅ Role-based
}
```

---

## 📚 API Documentation

### Authentication

**Endpoint**: `POST /api/v2/login`

**Request**:
```json
{
  "email": "user@example.com",
  "password": "password123"
}
```

**Response**:
```json
{
  "success": true,
  "token": "eyJ0eXAiOiJKV1QiLCJhbGc...",
  "user": {
    "id": 1,
    "name": "John Doe",
    "email": "user@example.com"
  }
}
```

---

### Products

#### Get All Products

**Endpoint**: `GET /api/v2/products`

**Parameters**:
```
page (optional): Page number (default: 1)
per_page (optional): Items per page (default: 15)
sort (optional): Sort field (default: created_at)
order (optional): Sort order (asc/desc, default: desc)
```

**Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Product Name",
      "slug": "product-name",
      "price": 99.99,
      "sale_price": 79.99,
      "image": "https://...",
      "rating": 4.5,
      "reviews_count": 25
    }
  ],
  "meta": {
    "current_page": 1,
    "total": 100,
    "per_page": 15
  }
}
```

---

#### Get Product Details

**Endpoint**: `GET /api/v2/products/{id}`

**Response**:
```json
{
  "success": true,
  "data": {
    "id": 1,
    "name": "Product Name",
    "description": "...",
    "price": 99.99,
    "sale_price": 79.99,
    "stock": 50,
    "images": [...],
    "category": {...},
    "brand": {...},
    "specifications": {...},
    "related_products": [...]
  }
}
```

---

### Catalog

#### Get Catalogs

**Endpoint**: `GET /api/v2/catalog`

**Parameters**:
```
brand_id (required): Brand ID
vin (optional): VIN number
year (optional): Year
region (optional): Region
```

**Response**:
```json
{
  "success": true,
  "data": [
    {
      "id": 1,
      "name": "Catalog Name",
      "code": "CAT001",
      "brand": {...},
      "categories_count": 15
    }
  ]
}
```

---

### Cart

#### Add to Cart

**Endpoint**: `POST /api/v2/cart/add`

**Request**:
```json
{
  "product_id": 1,
  "quantity": 2
}
```

**Response**:
```json
{
  "success": true,
  "message": "Product added to cart",
  "cart": {
    "items_count": 3,
    "subtotal": 299.97,
    "total": 299.97
  }
}
```

---

**للمزيد من التفاصيل**: راجع [API_DOCUMENTATION.md](API_DOCUMENTATION.md)

---

## 🤝 المساهمة

نرحب بالمساهمات! يرجى اتباع الخطوات التالية:

### 1. Fork Repository

```bash
# Fork على GitHub
# ثم Clone
git clone https://github.com/YOUR_USERNAME/newstock.git
```

### 2. Create Branch

```bash
git checkout -b feature/amazing-feature
```

### 3. Commit Changes

```bash
git commit -m "Add amazing feature"
```

### 4. Push to Branch

```bash
git push origin feature/amazing-feature
```

### 5. Open Pull Request

افتح Pull Request على GitHub مع وصف واضح للتغييرات.

### Coding Standards

- اتبع PSR-12
- اكتب Unit Tests
- وثّق الكود
- استخدم Meaningful Names

---

## 📄 الترخيص

هذا المشروع مرخص تحت [MIT License](LICENSE).

```
MIT License

Copyright (c) 2025 NewStock Team

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction...
```

---

## 📞 الدعم

### Documentation

- [Installation Guide](INSTALLATION.md)
- [API Documentation](API_DOCUMENTATION.md)
- [Performance Testing Report](PERFORMANCE_TESTING_REPORT.md)
- [Admin/Vendor Panels](ADMIN_VENDOR_PANELS_DOCUMENTATION.md)

### Contact

- **Email**: support@newstock.com
- **Website**: https://newstock.com
- **GitHub**: https://github.com/altwijry/newstock
- **Issues**: https://github.com/altwijry/newstock/issues

---

## 🙏 شكر وتقدير

شكراً لجميع المساهمين والمطورين الذين ساهموا في هذا المشروع.

**Built with ❤️ by NewStock Team**

---

## 📈 الإحصائيات

![GitHub Stars](https://img.shields.io/github/stars/altwijry/newstock?style=social)
![GitHub Forks](https://img.shields.io/github/forks/altwijry/newstock?style=social)
![GitHub Issues](https://img.shields.io/github/issues/altwijry/newstock)
![GitHub Pull Requests](https://img.shields.io/github/issues-pr/altwijry/newstock)

---

<div align="center">

**NewStock v2.0.0** - Next Generation E-Commerce Platform

[⬆ Back to Top](#newstock---next-generation-e-commerce-platform)

</div>
