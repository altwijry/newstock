@extends('layouts.front-new')

@section('title', __('Products') . ' - ' . $gs->title)

@section('meta_description', $gs->meta_description)

@section('content')

<!-- Breadcrumb Section -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Products') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Products Section -->
<section class="products-section py-5">
    <div class="container">
        <div class="row">
            
            <!-- Sidebar Filters -->
            <div class="col-lg-3 col-md-4 mb-4">
                <div class="filters-sidebar">
                    
                    <!-- Search Box -->
                    <div class="filter-box mb-4">
                        <h5 class="filter-title">{{ __('Search') }}</h5>
                        <form action="{{ route('front.products') }}" method="GET" id="searchForm">
                            <div class="input-group">
                                <input type="text" 
                                       name="search" 
                                       class="form-control" 
                                       placeholder="{{ __('Search products...') }}"
                                       value="{{ request('search') }}">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Categories Filter -->
                    <div class="filter-box mb-4">
                        <h5 class="filter-title">{{ __('Categories') }}</h5>
                        <div class="filter-list">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="category" 
                                       id="cat-all" 
                                       value="" 
                                       {{ !request('category') ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <label class="form-check-label" for="cat-all">
                                    {{ __('All Categories') }}
                                </label>
                            </div>
                            @foreach($categories as $category)
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="category" 
                                       id="cat-{{ $category->id }}" 
                                       value="{{ $category->id }}"
                                       {{ request('category') == $category->id ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <label class="form-check-label" for="cat-{{ $category->id }}">
                                    {{ $category->name }}
                                    <span class="badge bg-secondary">{{ $category->products_count }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Brands Filter -->
                    <div class="filter-box mb-4">
                        <h5 class="filter-title">{{ __('Brands') }}</h5>
                        <div class="filter-list">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="brand" 
                                       id="brand-all" 
                                       value="" 
                                       {{ !request('brand') ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <label class="form-check-label" for="brand-all">
                                    {{ __('All Brands') }}
                                </label>
                            </div>
                            @foreach($brands as $brand)
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="radio" 
                                       name="brand" 
                                       id="brand-{{ $brand->id }}" 
                                       value="{{ $brand->id }}"
                                       {{ request('brand') == $brand->id ? 'checked' : '' }}
                                       onchange="applyFilters()">
                                <label class="form-check-label" for="brand-{{ $brand->id }}">
                                    {{ $brand->name }}
                                    <span class="badge bg-secondary">{{ $brand->products_count }}</span>
                                </label>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Price Range Filter -->
                    <div class="filter-box mb-4">
                        <h5 class="filter-title">{{ __('Price Range') }}</h5>
                        <div class="price-range-inputs">
                            <div class="row g-2 mb-3">
                                <div class="col-6">
                                    <input type="number" 
                                           name="min_price" 
                                           class="form-control" 
                                           placeholder="{{ __('Min') }}"
                                           value="{{ request('min_price') }}"
                                           min="{{ $priceRange['min'] }}"
                                           max="{{ $priceRange['max'] }}">
                                </div>
                                <div class="col-6">
                                    <input type="number" 
                                           name="max_price" 
                                           class="form-control" 
                                           placeholder="{{ __('Max') }}"
                                           value="{{ request('max_price') }}"
                                           min="{{ $priceRange['min'] }}"
                                           max="{{ $priceRange['max'] }}">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-sm w-100" onclick="applyFilters()">
                                {{ __('Apply Price Filter') }}
                            </button>
                        </div>
                        <div class="price-range-display mt-2">
                            <small class="text-muted">
                                {{ __('Range') }}: {{ $priceRange['min'] }} - {{ $priceRange['max'] }} {{ $gs->currency }}
                            </small>
                        </div>
                    </div>

                    <!-- Clear Filters -->
                    <div class="filter-box">
                        <button class="btn btn-outline-secondary w-100" onclick="clearFilters()">
                            <i class="fas fa-times"></i> {{ __('Clear All Filters') }}
                        </button>
                    </div>

                </div>
            </div>

            <!-- Products Grid -->
            <div class="col-lg-9 col-md-8">
                
                <!-- Toolbar -->
                <div class="products-toolbar mb-4">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <div class="products-count">
                                <p class="mb-0">
                                    {{ __('Showing') }} 
                                    <strong>{{ $products->firstItem() ?? 0 }}</strong> - 
                                    <strong>{{ $products->lastItem() ?? 0 }}</strong> 
                                    {{ __('of') }} 
                                    <strong>{{ $products->total() }}</strong> 
                                    {{ __('products') }}
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="products-sort d-flex justify-content-end align-items-center">
                                <label class="me-2 mb-0">{{ __('Sort by') }}:</label>
                                <select name="sort_by" class="form-select form-select-sm" style="width: auto;" onchange="applyFilters()">
                                    <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>
                                        {{ __('Latest') }}
                                    </option>
                                    <option value="price_low" {{ request('sort_by') == 'price_low' ? 'selected' : '' }}>
                                        {{ __('Price: Low to High') }}
                                    </option>
                                    <option value="price_high" {{ request('sort_by') == 'price_high' ? 'selected' : '' }}>
                                        {{ __('Price: High to Low') }}
                                    </option>
                                    <option value="name_asc" {{ request('sort_by') == 'name_asc' ? 'selected' : '' }}>
                                        {{ __('Name: A-Z') }}
                                    </option>
                                    <option value="name_desc" {{ request('sort_by') == 'name_desc' ? 'selected' : '' }}>
                                        {{ __('Name: Z-A') }}
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Products Grid -->
                @if($products->count() > 0)
                <div class="row g-4" id="productsGrid">
                    @foreach($products as $product)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <x-product-card-new :product="$product" />
                    </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="pagination-wrapper mt-5">
                    {{ $products->appends(request()->query())->links() }}
                </div>
                @else
                <!-- Empty State -->
                <div class="empty-state text-center py-5">
                    <div class="empty-icon mb-3">
                        <i class="fas fa-box-open fa-4x text-muted"></i>
                    </div>
                    <h4>{{ __('No products found') }}</h4>
                    <p class="text-muted">{{ __('Try adjusting your filters or search terms') }}</p>
                    <button class="btn btn-primary mt-3" onclick="clearFilters()">
                        {{ __('Clear Filters') }}
                    </button>
                </div>
                @endif

            </div>

        </div>
    </div>
</section>

@endsection

@push('styles')
<style>
/* Filters Sidebar */
.filters-sidebar {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
}

.filter-box {
    border-bottom: 1px solid var(--gray-200);
    padding-bottom: var(--space-4);
}

.filter-box:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

.filter-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: var(--space-3);
}

.filter-list {
    max-height: 300px;
    overflow-y: auto;
}

.filter-list .form-check {
    padding: var(--space-2) 0;
}

.filter-list .form-check-label {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    cursor: pointer;
}

/* Products Toolbar */
.products-toolbar {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-4);
    box-shadow: var(--shadow-sm);
}

/* Empty State */
.empty-state {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-8);
}

.empty-icon i {
    opacity: 0.3;
}

/* Responsive */
@media (max-width: 768px) {
    .filters-sidebar {
        margin-bottom: var(--space-4);
    }
    
    .products-sort {
        margin-top: var(--space-3);
    }
}
</style>
@endpush

@push('scripts')
<script>
function applyFilters() {
    const form = document.createElement('form');
    form.method = 'GET';
    form.action = '{{ route("front.products") }}';
    
    // Get all filter values
    const search = document.querySelector('input[name="search"]')?.value || '';
    const category = document.querySelector('input[name="category"]:checked')?.value || '';
    const brand = document.querySelector('input[name="brand"]:checked')?.value || '';
    const minPrice = document.querySelector('input[name="min_price"]')?.value || '';
    const maxPrice = document.querySelector('input[name="max_price"]')?.value || '';
    const sortBy = document.querySelector('select[name="sort_by"]')?.value || 'latest';
    
    // Add inputs to form
    if (search) addInput(form, 'search', search);
    if (category) addInput(form, 'category', category);
    if (brand) addInput(form, 'brand', brand);
    if (minPrice) addInput(form, 'min_price', minPrice);
    if (maxPrice) addInput(form, 'max_price', maxPrice);
    addInput(form, 'sort_by', sortBy);
    
    document.body.appendChild(form);
    form.submit();
}

function addInput(form, name, value) {
    const input = document.createElement('input');
    input.type = 'hidden';
    input.name = name;
    input.value = value;
    form.appendChild(input);
}

function clearFilters() {
    window.location.href = '{{ route("front.products") }}';
}
</script>
@endpush
