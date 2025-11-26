# NewStock - Auto Parts E-Commerce Platform

![NewStock Logo](public/assets/images/logo.png)

## 📋 نظرة عامة

NewStock هو نظام متكامل لبيع قطع غيار السيارات عبر الإنترنت، مع نظام كاتلوج مخصص للبحث عن القطع الأصلية باستخدام رقم الهيكل (VIN) أو التصفح الشجري.

### المميزات الرئيسية

- ✅ **نظام كاتلوج متقدم** للبحث عن قطع الغيار الأصلية
- ✅ **البحث برقم الهيكل (VIN)** لتحديد القطع المتوافقة
- ✅ **تصفح شجري متعدد المستويات** للكاتلوجات
- ✅ **نظام متعدد البائعين** (Multi-Vendor)
- ✅ **لوحة تحكم شاملة** للإدارة
- ✅ **دعم متعدد اللغات** (عربي/إنجليزي)
- ✅ **دعم متعدد العملات**
- ✅ **نظام دفع متكامل**
- ✅ **تصميم متجاوب** (Responsive Design)

---

## 🚀 التقنيات المستخدمة

### Backend
- **Laravel 10.x** - PHP Framework
- **MySQL** - Database
- **Livewire 3.x** - Dynamic Components

### Frontend
- **Bootstrap 5** - CSS Framework
- **CSS Variables** - Design System
- **Vanilla JavaScript** - Minimal JS
- **Font Awesome 6** - Icons

### Additional Tools
- **Composer** - PHP Dependency Manager
- **NPM** - Node Package Manager
- **Git** - Version Control

---

## 📦 المتطلبات

- PHP >= 8.1
- Composer
- MySQL >= 5.7
- Node.js >= 16.x
- NPM or Yarn

---

## 🔧 التثبيت

### 1. استنساخ المشروع

\`\`\`bash
git clone https://github.com/altwijry/newstock.git
cd newstock
\`\`\`

### 2. تثبيت Dependencies

\`\`\`bash
# PHP Dependencies
composer install

# Node Dependencies
npm install
\`\`\`

### 3. إعداد البيئة

\`\`\`bash
# نسخ ملف البيئة
cp .env.example .env

# توليد مفتاح التطبيق
php artisan key:generate
\`\`\`

### 4. إعداد قاعدة البيانات

قم بتحديث ملف \`.env\` بمعلومات قاعدة البيانات:

\`\`\`env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=newstock
DB_USERNAME=root
DB_PASSWORD=
\`\`\`

ثم قم بتشغيل Migrations:

\`\`\`bash
php artisan migrate --seed
\`\`\`

### 5. إنشاء Symbolic Link للتخزين

\`\`\`bash
php artisan storage:link
\`\`\`

### 6. تشغيل المشروع

\`\`\`bash
# Development Server
php artisan serve

# في نافذة أخرى
npm run dev
\`\`\`

الآن يمكنك الوصول للمشروع على: \`http://localhost:8000\`

---

## 👤 الحسابات الافتراضية

### Admin
- **Email**: admin@newstock.com
- **Password**: admin123

### Vendor
- **Email**: vendor@newstock.com
- **Password**: vendor123

### User
- **Email**: user@newstock.com
- **Password**: user123

---

## 📁 بنية المشروع

\`\`\`
newstock/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/      # Admin Controllers
│   │   │   ├── Vendor/     # Vendor Controllers
│   │   │   └── Front/      # Frontend Controllers
│   │   └── Livewire/       # Livewire Components
│   ├── Models/             # Eloquent Models
│   └── Services/           # Business Logic Services
│
├── resources/
│   └── views/
│       ├── admin/          # Admin Views
│       ├── vendor/         # Vendor Views
│       ├── frontend/       # Frontend Views
│       ├── livewire/       # Livewire Views
│       ├── components/     # Blade Components
│       └── layouts/        # Layout Files
│
├── public/
│   └── assets/
│       ├── admin/          # Admin Assets
│       ├── vendor/         # Vendor Assets
│       └── front/          # Frontend Assets
│           └── css/
│               ├── variables.css          # Design System
│               └── newstock-components.css # UI Components
│
├── database/
│   ├── migrations/         # Database Migrations
│   └── seeders/           # Database Seeders
│
└── routes/
    ├── web.php            # Web Routes
    └── api.php            # API Routes
\`\`\`

---

## 🎨 نظام التصميم

تم إنشاء نظام تصميم متكامل باستخدام CSS Variables:

### الألوان الأساسية
- **Primary**: #2196F3 (أزرق)
- **Secondary**: #FF9800 (برتقالي)
- **Success**: #4CAF50 (أخضر)
- **Error**: #F44336 (أحمر)

### الخطوط
- **العربية**: Cairo
- **الإنجليزية**: Inter

للمزيد من التفاصيل، راجع ملف [DESIGN_SYSTEM.md](DESIGN_SYSTEM.md)

---

## 📚 التوثيق

- [دليل التنفيذ](IMPLEMENTATION_GUIDE.md)
- [نظام التصميم](DESIGN_SYSTEM.md)
- [تحليل Frontend](FRONTEND_ANALYSIS.md)
- [تحليل نظام الكاتلوج](CATALOG_ANALYSIS.md)
- [خطة المشروع](PROJECT_PLAN.md)

---

## 🔐 الأمان

- CSRF Protection
- XSS Protection
- SQL Injection Protection
- Password Hashing (bcrypt)
- Secure Session Management

---

## 🧪 الاختبار

\`\`\`bash
# Run Tests
php artisan test

# Run Specific Test
php artisan test --filter TestName
\`\`\`

---

## 🚢 النشر (Deployment)

### على Shared Hosting

1. رفع الملفات عبر FTP
2. تحديث ملف \`.env\`
3. تشغيل \`composer install --optimize-autoloader --no-dev\`
4. تشغيل \`php artisan migrate\`
5. تشغيل \`php artisan storage:link\`

### على VPS/Cloud

استخدم أدوات مثل:
- Laravel Forge
- Laravel Envoyer
- Deployer

---

## 🤝 المساهمة

نرحب بالمساهمات! يرجى اتباع الخطوات التالية:

1. Fork المشروع
2. إنشاء Branch جديد (\`git checkout -b feature/AmazingFeature\`)
3. Commit التغييرات (\`git commit -m 'Add some AmazingFeature'\`)
4. Push إلى Branch (\`git push origin feature/AmazingFeature\`)
5. فتح Pull Request

---

## 📝 الترخيص

هذا المشروع مرخص تحت [MIT License](LICENSE)

---

## 📞 التواصل

- **الموقع**: [newstock.com](https://newstock.com)
- **البريد الإلكتروني**: support@newstock.com
- **GitHub**: [@altwijry/newstock](https://github.com/altwijry/newstock)

---

## 🙏 شكر وتقدير

- Laravel Framework
- Livewire
- Bootstrap
- Font Awesome
- جميع المساهمين في المشروع

---

**آخر تحديث**: 27 نوفمبر 2025
**الإصدار**: 1.0.0

---

Made with ❤️ by NewStock Team
