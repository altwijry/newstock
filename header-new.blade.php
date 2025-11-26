{{-- NewStock Modern Header --}}

<style>
.header-new {
    background: var(--white);
    box-shadow: var(--shadow-sm);
    position: sticky;
    top: 0;
    z-index: var(--z-sticky);
    transition: all var(--transition-base);
}

.header-new.scrolled {
    box-shadow: var(--shadow-md);
}

/* Top Bar */
.top-bar {
    background: var(--gray-900);
    color: var(--white);
    padding: var(--space-2) 0;
    font-size: var(--text-sm);
}

.top-bar a {
    color: var(--white);
    text-decoration: none;
    transition: color var(--transition-base);
}

.top-bar a:hover {
    color: var(--primary-300);
}

.top-bar-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.top-bar-left, .top-bar-right {
    display: flex;
    align-items: center;
    gap: var(--space-4);
}

/* Main Header */
.main-header {
    padding: var(--space-4) 0;
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--space-6);
}

/* Logo */
.header-logo img {
    height: 50px;
    width: auto;
}

/* Search Bar */
.header-search {
    flex: 1;
    max-width: 600px;
}

.search-form {
    position: relative;
    display: flex;
}

.search-input {
    flex: 1;
    padding: var(--space-3) var(--space-4);
    padding-right: 120px;
    border: var(--border-2) solid var(--gray-300);
    border-radius: var(--radius-lg);
    font-size: var(--text-base);
    transition: all var(--transition-base);
}

[dir="rtl"] .search-input {
    padding-right: var(--space-4);
    padding-left: 120px;
}

.search-input:focus {
    outline: none;
    border-color: var(--primary-500);
    box-shadow: 0 0 0 3px rgba(33, 150, 243, 0.1);
}

.search-btn {
    position: absolute;
    right: var(--space-2);
    top: 50%;
    transform: translateY(-50%);
    background: var(--primary-500);
    color: var(--white);
    border: none;
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-md);
    cursor: pointer;
    transition: all var(--transition-base);
}

[dir="rtl"] .search-btn {
    right: auto;
    left: var(--space-2);
}

.search-btn:hover {
    background: var(--primary-600);
}

/* Header Actions */
.header-actions {
    display: flex;
    align-items: center;
    gap: var(--space-4);
}

.header-action-item {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: var(--space-1);
    color: var(--gray-700);
    text-decoration: none;
    transition: color var(--transition-base);
}

.header-action-item:hover {
    color: var(--primary-500);
}

.header-action-icon {
    font-size: var(--text-2xl);
    position: relative;
}

.header-action-badge {
    position: absolute;
    top: -8px;
    right: -8px;
    background: var(--error-500);
    color: var(--white);
    font-size: var(--text-xs);
    font-weight: var(--font-bold);
    padding: 2px 6px;
    border-radius: var(--radius-full);
    min-width: 18px;
    text-align: center;
}

.header-action-text {
    font-size: var(--text-xs);
    font-weight: var(--font-medium);
}

/* Navigation */
.main-nav {
    background: var(--gray-50);
    border-top: var(--border-1) solid var(--gray-200);
    border-bottom: var(--border-1) solid var(--gray-200);
}

.nav-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.nav-menu {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    list-style: none;
    margin: 0;
    padding: 0;
}

.nav-item {
    position: relative;
}

.nav-link {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-4);
    color: var(--gray-700);
    text-decoration: none;
    font-weight: var(--font-medium);
    transition: all var(--transition-base);
    border-radius: var(--radius-md);
}

.nav-link:hover {
    background: var(--white);
    color: var(--primary-500);
}

.nav-link.active {
    background: var(--primary-500);
    color: var(--white);
}

/* Dropdown */
.nav-dropdown {
    position: absolute;
    top: 100%;
    left: 0;
    min-width: 200px;
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-xl);
    padding: var(--space-2);
    opacity: 0;
    visibility: hidden;
    transform: translateY(-10px);
    transition: all var(--transition-base);
    z-index: var(--z-dropdown);
}

.nav-item:hover .nav-dropdown {
    opacity: 1;
    visibility: visible;
    transform: translateY(0);
}

.nav-dropdown-item {
    display: block;
    padding: var(--space-2) var(--space-3);
    color: var(--gray-700);
    text-decoration: none;
    border-radius: var(--radius-md);
    transition: all var(--transition-base);
}

.nav-dropdown-item:hover {
    background: var(--gray-100);
    color: var(--primary-500);
}

/* Mobile Menu Toggle */
.mobile-menu-toggle {
    display: none;
    background: none;
    border: none;
    font-size: var(--text-2xl);
    color: var(--gray-700);
    cursor: pointer;
}

/* Responsive */
@media (max-width: 1024px) {
    .header-search {
        max-width: 400px;
    }
}

@media (max-width: 768px) {
    .top-bar {
        display: none;
    }

    .header-content {
        flex-wrap: wrap;
    }

    .header-logo img {
        height: 40px;
    }

    .header-search {
        order: 3;
        width: 100%;
        max-width: 100%;
        margin-top: var(--space-3);
    }

    .header-actions {
        gap: var(--space-3);
    }

    .header-action-text {
        display: none;
    }

    .mobile-menu-toggle {
        display: block;
    }

    .main-nav {
        display: none;
    }

    .main-nav.active {
        display: block;
    }

    .nav-menu {
        flex-direction: column;
        width: 100%;
    }

    .nav-item {
        width: 100%;
    }

    .nav-link {
        width: 100%;
    }

    .nav-dropdown {
        position: static;
        opacity: 1;
        visibility: visible;
        transform: none;
        box-shadow: none;
        margin-left: var(--space-4);
    }
}
</style>

{{-- Top Bar --}}
<div class="top-bar">
    <div class="container">
        <div class="top-bar-content">
            <div class="top-bar-left">
                <a href="tel:{{ $ps->phone }}">
                    <i class="fas fa-phone"></i>
                    {{ $ps->phone }}
                </a>
                <a href="mailto:{{ $ps->email }}">
                    <i class="fas fa-envelope"></i>
                    {{ $ps->email }}
                </a>
            </div>
            <div class="top-bar-right">
                {{-- Language Selector --}}
                <div style="position: relative;">
                    <select class="select-newstock" style="background: transparent; border: none; color: var(--white); padding: var(--space-1) var(--space-6) var(--space-1) var(--space-2); font-size: var(--text-sm);" onchange="window.location.href=this.value">
                        @foreach ($languges as $language)
                            <option value="{{ route('front.language', $language->id) }}" {{ Session::has('language') ? (Session::get('language') == $language->id ? 'selected' : '') : ($languges->where('is_default', '=', 1)->first()->id == $language->id ? 'selected' : '') }}>
                                {{ $language->language }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Currency Selector --}}
                @if ($gs->is_currency == 1)
                    <div style="position: relative;">
                        <select class="select-newstock" style="background: transparent; border: none; color: var(--white); padding: var(--space-1) var(--space-6) var(--space-1) var(--space-2); font-size: var(--text-sm);" onchange="window.location.href=this.value">
                            @foreach ($currencies as $currency)
                                <option value="{{ route('front.currency', $currency->id) }}" {{ Session::has('currency') ? (Session::get('currency') == $currency->id ? 'selected' : '') : ($currencies->where('is_default', '=', 1)->first()->id == $currency->id ? 'selected' : '') }}>
                                    {{ $currency->sign }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                @endif

                {{-- Vendor Login --}}
                @if (Auth::guard('web')->check() && Auth::guard('web')->user()->is_vendor == 2)
                    <a href="{{ route('vendor.dashboard') }}">
                        <i class="fas fa-store"></i>
                        {{ __('Vendor Panel') }}
                    </a>
                @else
                    <a href="{{ route('vendor.login') }}">
                        <i class="fas fa-store"></i>
                        {{ __('Vendor Login') }}
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- Main Header --}}
<header class="header-new" id="mainHeader">
    <div class="main-header">
        <div class="container">
            <div class="header-content">
                {{-- Logo --}}
                <div class="header-logo">
                    <a href="{{ route('front.index') }}">
                        <img src="{{ asset('assets/images/' . $gs->logo) }}" alt="{{ $gs->title }}">
                    </a>
                </div>

                {{-- Search Bar --}}
                <div class="header-search">
                    <form class="search-form" action="{{ route('front.category', [Request::route('category'), Request::route('subcategory'), Request::route('childcategory')]) }}" method="GET">
                        <input 
                            type="text" 
                            name="search" 
                            class="search-input" 
                            placeholder="{{ __('Search for products...') }}"
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="search-btn">
                            <i class="fas fa-search"></i>
                            {{ __('Search') }}
                        </button>
                    </form>
                </div>

                {{-- Header Actions --}}
                <div class="header-actions">
                    {{-- User Account --}}
                    @if(Auth::guard('web')->check())
                        <a href="{{ route('user.dashboard') }}" class="header-action-item">
                            <span class="header-action-icon">
                                <i class="fas fa-user-circle"></i>
                            </span>
                            <span class="header-action-text">{{ __('Account') }}</span>
                        </a>
                    @else
                        <a href="{{ route('user.login') }}" class="header-action-item">
                            <span class="header-action-icon">
                                <i class="fas fa-user"></i>
                            </span>
                            <span class="header-action-text">{{ __('Login') }}</span>
                        </a>
                    @endif

                    {{-- Wishlist --}}
                    <a href="{{ route('user.wishlist') }}" class="header-action-item">
                        <span class="header-action-icon">
                            <i class="far fa-heart"></i>
                            @if(Auth::guard('web')->check() && Auth::guard('web')->user()->wishlists->count() > 0)
                                <span class="header-action-badge">{{ Auth::guard('web')->user()->wishlists->count() }}</span>
                            @endif
                        </span>
                        <span class="header-action-text">{{ __('Wishlist') }}</span>
                    </a>

                    {{-- Cart --}}
                    <a href="{{ route('front.cart') }}" class="header-action-item">
                        <span class="header-action-icon">
                            <i class="fas fa-shopping-cart"></i>
                            @if(Session::has('cart'))
                                <span class="header-action-badge cart-count">{{ count(Session::get('cart')) }}</span>
                            @endif
                        </span>
                        <span class="header-action-text">{{ __('Cart') }}</span>
                    </a>

                    {{-- Mobile Menu Toggle --}}
                    <button class="mobile-menu-toggle" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="main-nav" id="mainNav">
        <div class="container">
            <div class="nav-content">
                <ul class="nav-menu">
                    <li class="nav-item">
                        <a href="{{ route('front.index') }}" class="nav-link {{ request()->routeIs('front.index') ? 'active' : '' }}">
                            <i class="fas fa-home"></i>
                            {{ __('Home') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('front.category', '') }}" class="nav-link {{ request()->routeIs('front.category') ? 'active' : '' }}">
                            <i class="fas fa-th"></i>
                            {{ __('Categories') }}
                            <i class="fas fa-chevron-down" style="font-size: var(--text-xs);"></i>
                        </a>
                        <div class="nav-dropdown">
                            @foreach($categories->take(8) as $category)
                                <a href="{{ route('front.category', $category->slug) }}" class="nav-dropdown-item">
                                    {{ $category->name }}
                                </a>
                            @endforeach
                        </div>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('catlogs.index', 'nissan') }}" class="nav-link">
                            <i class="fas fa-car"></i>
                            {{ __('Catalogs') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('front.blog') }}" class="nav-link {{ request()->routeIs('front.blog') ? 'active' : '' }}">
                            <i class="fas fa-newspaper"></i>
                            {{ __('Blog') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('front.contact') }}" class="nav-link {{ request()->routeIs('front.contact') ? 'active' : '' }}">
                            <i class="fas fa-envelope"></i>
                            {{ __('Contact') }}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>

<script>
// Sticky Header on Scroll
window.addEventListener('scroll', function() {
    const header = document.getElementById('mainHeader');
    if (window.scrollY > 100) {
        header.classList.add('scrolled');
    } else {
        header.classList.remove('scrolled');
    }
});

// Mobile Menu Toggle
function toggleMobileMenu() {
    const nav = document.getElementById('mainNav');
    nav.classList.toggle('active');
}

// Update cart count dynamically
function updateCartCount(count) {
    const cartBadge = document.querySelector('.cart-count');
    if (cartBadge) {
        cartBadge.textContent = count;
    }
}
</script>
