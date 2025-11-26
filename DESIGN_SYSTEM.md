# نظام التصميم الجديد - NewStock Design System

## تاريخ الإنشاء: 27 نوفمبر 2025

---

## 🎨 نظام الألوان (Color Palette)

### الألوان الأساسية (Primary Colors)

```css
/* Primary - الأزرق الداكن الاحترافي */
--primary-50: #E3F2FD;
--primary-100: #BBDEFB;
--primary-200: #90CAF9;
--primary-300: #64B5F6;
--primary-400: #42A5F5;
--primary-500: #2196F3;  /* اللون الأساسي */
--primary-600: #1E88E5;
--primary-700: #1976D2;
--primary-800: #1565C0;
--primary-900: #0D47A1;

/* Secondary - البرتقالي الدافئ */
--secondary-50: #FFF3E0;
--secondary-100: #FFE0B2;
--secondary-200: #FFCC80;
--secondary-300: #FFB74D;
--secondary-400: #FFA726;
--secondary-500: #FF9800;  /* اللون الثانوي */
--secondary-600: #FB8C00;
--secondary-700: #F57C00;
--secondary-800: #EF6C00;
--secondary-900: #E65100;
```

### الألوان المحايدة (Neutral Colors)

```css
/* Gray Scale */
--gray-50: #FAFAFA;
--gray-100: #F5F5F5;
--gray-200: #EEEEEE;
--gray-300: #E0E0E0;
--gray-400: #BDBDBD;
--gray-500: #9E9E9E;
--gray-600: #757575;
--gray-700: #616161;
--gray-800: #424242;
--gray-900: #212121;

/* Black & White */
--white: #FFFFFF;
--black: #000000;
```

### ألوان الحالة (Status Colors)

```css
/* Success - الأخضر */
--success-50: #E8F5E9;
--success-500: #4CAF50;
--success-700: #388E3C;

/* Warning - الأصفر */
--warning-50: #FFF8E1;
--warning-500: #FFC107;
--warning-700: #F57F17;

/* Error - الأحمر */
--error-50: #FFEBEE;
--error-500: #F44336;
--error-700: #C62828;

/* Info - الأزرق الفاتح */
--info-50: #E1F5FE;
--info-500: #03A9F4;
--info-700: #0277BD;
```

---

## 📝 الخطوط (Typography)

### خطوط النظام

```css
/* الخط الأساسي للعربية */
--font-arabic: 'Cairo', 'Tajawal', -apple-system, BlinkMacSystemFont, sans-serif;

/* الخط الأساسي للإنجليزية */
--font-english: 'Inter', 'Roboto', -apple-system, BlinkMacSystemFont, sans-serif;

/* خط الأرقام */
--font-numbers: 'Roboto', 'Inter', monospace;

/* خط الكود */
--font-code: 'Fira Code', 'Courier New', monospace;
```

### أحجام الخطوط (Font Sizes)

```css
--text-xs: 0.75rem;      /* 12px */
--text-sm: 0.875rem;     /* 14px */
--text-base: 1rem;       /* 16px */
--text-lg: 1.125rem;     /* 18px */
--text-xl: 1.25rem;      /* 20px */
--text-2xl: 1.5rem;      /* 24px */
--text-3xl: 1.875rem;    /* 30px */
--text-4xl: 2.25rem;     /* 36px */
--text-5xl: 3rem;        /* 48px */
```

### أوزان الخطوط (Font Weights)

```css
--font-light: 300;
--font-regular: 400;
--font-medium: 500;
--font-semibold: 600;
--font-bold: 700;
--font-extrabold: 800;
```

### ارتفاع الأسطر (Line Heights)

```css
--leading-tight: 1.25;
--leading-normal: 1.5;
--leading-relaxed: 1.75;
--leading-loose: 2;
```

---

## 📐 المسافات (Spacing)

```css
--space-0: 0;
--space-1: 0.25rem;   /* 4px */
--space-2: 0.5rem;    /* 8px */
--space-3: 0.75rem;   /* 12px */
--space-4: 1rem;      /* 16px */
--space-5: 1.25rem;   /* 20px */
--space-6: 1.5rem;    /* 24px */
--space-8: 2rem;      /* 32px */
--space-10: 2.5rem;   /* 40px */
--space-12: 3rem;     /* 48px */
--space-16: 4rem;     /* 64px */
--space-20: 5rem;     /* 80px */
--space-24: 6rem;     /* 96px */
```

---

## 🔲 الحدود والزوايا (Borders & Radius)

### سماكة الحدود (Border Width)

```css
--border-0: 0;
--border-1: 1px;
--border-2: 2px;
--border-4: 4px;
```

### نصف القطر (Border Radius)

```css
--radius-none: 0;
--radius-sm: 0.25rem;    /* 4px */
--radius-md: 0.375rem;   /* 6px */
--radius-lg: 0.5rem;     /* 8px */
--radius-xl: 0.75rem;    /* 12px */
--radius-2xl: 1rem;      /* 16px */
--radius-3xl: 1.5rem;    /* 24px */
--radius-full: 9999px;   /* دائري كامل */
```

---

## 🌑 الظلال (Shadows)

```css
/* Elevation Shadows */
--shadow-xs: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
--shadow-sm: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
--shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
--shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
--shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
--shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);

/* Inner Shadow */
--shadow-inner: inset 0 2px 4px 0 rgba(0, 0, 0, 0.06);

/* No Shadow */
--shadow-none: none;
```

---

## 🎭 التأثيرات (Effects)

### الشفافية (Opacity)

```css
--opacity-0: 0;
--opacity-10: 0.1;
--opacity-20: 0.2;
--opacity-30: 0.3;
--opacity-40: 0.4;
--opacity-50: 0.5;
--opacity-60: 0.6;
--opacity-70: 0.7;
--opacity-80: 0.8;
--opacity-90: 0.9;
--opacity-100: 1;
```

### الانتقالات (Transitions)

```css
--transition-fast: 150ms cubic-bezier(0.4, 0, 0.2, 1);
--transition-base: 300ms cubic-bezier(0.4, 0, 0.2, 1);
--transition-slow: 500ms cubic-bezier(0.4, 0, 0.2, 1);
```

### التحويلات (Transforms)

```css
--scale-90: scale(0.9);
--scale-95: scale(0.95);
--scale-100: scale(1);
--scale-105: scale(1.05);
--scale-110: scale(1.1);
```

---

## 📱 نقاط التوقف (Breakpoints)

```css
/* Mobile First Approach */
--breakpoint-sm: 640px;   /* Small devices */
--breakpoint-md: 768px;   /* Medium devices */
--breakpoint-lg: 1024px;  /* Large devices */
--breakpoint-xl: 1280px;  /* Extra large devices */
--breakpoint-2xl: 1536px; /* 2X Extra large devices */
```

---

## 🧩 المكونات (Components)

### الأزرار (Buttons)

```css
/* Primary Button */
.btn-primary {
  background: var(--primary-500);
  color: var(--white);
  padding: var(--space-3) var(--space-6);
  border-radius: var(--radius-lg);
  font-weight: var(--font-semibold);
  transition: var(--transition-base);
  box-shadow: var(--shadow-sm);
}

.btn-primary:hover {
  background: var(--primary-600);
  box-shadow: var(--shadow-md);
  transform: translateY(-1px);
}

/* Secondary Button */
.btn-secondary {
  background: var(--secondary-500);
  color: var(--white);
  /* ... نفس الخصائص */
}

/* Outline Button */
.btn-outline {
  background: transparent;
  color: var(--primary-500);
  border: var(--border-2) solid var(--primary-500);
  /* ... */
}
```

### البطاقات (Cards)

```css
.card {
  background: var(--white);
  border-radius: var(--radius-xl);
  box-shadow: var(--shadow-md);
  padding: var(--space-6);
  transition: var(--transition-base);
}

.card:hover {
  box-shadow: var(--shadow-lg);
  transform: translateY(-2px);
}
```

### الإدخالات (Inputs)

```css
.input {
  background: var(--white);
  border: var(--border-1) solid var(--gray-300);
  border-radius: var(--radius-lg);
  padding: var(--space-3) var(--space-4);
  font-size: var(--text-base);
  transition: var(--transition-base);
}

.input:focus {
  outline: none;
  border-color: var(--primary-500);
  box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
}
```

---

## 🎯 مبادئ التصميم

### 1. البساطة (Simplicity)
- تصميم نظيف وواضح
- إزالة العناصر غير الضرورية
- التركيز على المحتوى

### 2. الاتساق (Consistency)
- استخدام نفس الأنماط في جميع الصفحات
- توحيد المسافات والأحجام
- نفس السلوك للعناصر المتشابهة

### 3. التسلسل البصري (Visual Hierarchy)
- استخدام الأحجام لتحديد الأهمية
- الألوان لجذب الانتباه
- المسافات لتنظيم المحتوى

### 4. الاستجابة (Responsiveness)
- Mobile First Approach
- تصميم يتكيف مع جميع الأحجام
- تجربة متسقة على جميع الأجهزة

### 5. إمكانية الوصول (Accessibility)
- تباين كافٍ للألوان
- أحجام خطوط مقروءة
- دعم قارئات الشاشة

---

## 📋 قائمة التحقق (Checklist)

### قبل تطبيق التصميم
- [ ] مراجعة نظام الألوان
- [ ] اختبار الخطوط
- [ ] التأكد من التباين
- [ ] مراجعة المسافات

### أثناء التطبيق
- [ ] استخدام CSS Variables
- [ ] اتباع نظام التسمية
- [ ] توثيق التغييرات
- [ ] اختبار على أجهزة مختلفة

### بعد التطبيق
- [ ] مراجعة الاتساق
- [ ] اختبار الأداء
- [ ] اختبار إمكانية الوصول
- [ ] جمع الملاحظات

---

## 🔗 الموارد

### الخطوط
- Cairo: https://fonts.google.com/specimen/Cairo
- Inter: https://fonts.google.com/specimen/Inter
- Roboto: https://fonts.google.com/specimen/Roboto

### الأدوات
- Color Contrast Checker
- Responsive Design Tester
- Accessibility Validator

---

**آخر تحديث**: 27 نوفمبر 2025
**الإصدار**: 1.0.0
