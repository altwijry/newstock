<div class="catalog-page">
    
    <!-- Page Header -->
    <div class="catalog-header mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h1 class="page-title">{{ __('Auto Parts Catalog') }}</h1>
                    <p class="page-subtitle">{{ __('Find parts for your vehicle') }}</p>
                </div>
                <div class="col-md-6">
                    <div class="catalog-stats">
                        <div class="stat-item">
                            <strong>{{ $totalCatalogs ?? 0 }}</strong>
                            <span>{{ __('Catalogs') }}</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ $totalBrands ?? 0 }}</strong>
                            <span>{{ __('Brands') }}</span>
                        </div>
                        <div class="stat-item">
                            <strong>{{ $totalParts ?? 0 }}</strong>
                            <span>{{ __('Parts') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Section -->
    <div class="catalog-search mb-5">
        <div class="container">
            <div class="search-box">
                <ul class="nav nav-tabs mb-4" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" 
                                id="search-by-brand-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#search-by-brand" 
                                type="button">
                            <i class="fas fa-car me-2"></i>
                            {{ __('Search by Brand') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                id="search-by-vin-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#search-by-vin" 
                                type="button">
                            <i class="fas fa-barcode me-2"></i>
                            {{ __('Search by VIN') }}
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" 
                                id="search-by-part-tab" 
                                data-bs-toggle="tab" 
                                data-bs-target="#search-by-part" 
                                type="button">
                            <i class="fas fa-cog me-2"></i>
                            {{ __('Search by Part Number') }}
                        </button>
                    </li>
                </ul>

                <div class="tab-content">
                    
                    <!-- Search by Brand -->
                    <div class="tab-pane fade show active" id="search-by-brand" role="tabpanel">
                        <form wire:submit.prevent="searchByBrand">
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <select wire:model="selectedBrand" class="form-select" required>
                                        <option value="">{{ __('Select Brand') }}</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->name }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select wire:model="selectedYear" class="form-select">
                                        <option value="">{{ __('All Years') }}</option>
                                        @foreach($availableYears as $year)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <select wire:model="selectedRegion" class="form-select">
                                        <option value="">{{ __('All Regions') }}</option>
                                        @foreach($availableRegions as $region)
                                        <option value="{{ $region }}">{{ $region }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>
                                        {{ __('Search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Search by VIN -->
                    <div class="tab-pane fade" id="search-by-vin" role="tabpanel">
                        <form wire:submit.prevent="searchByVIN">
                            <div class="row g-3">
                                <div class="col-md-9">
                                    <input type="text" 
                                           wire:model="vinNumber" 
                                           class="form-control" 
                                           placeholder="{{ __('Enter 17-digit VIN number') }}"
                                           maxlength="17"
                                           required>
                                    <small class="text-muted">
                                        {{ __('Example') }}: 1HGBH41JXMN109186
                                    </small>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>
                                        {{ __('Decode VIN') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Search by Part Number -->
                    <div class="tab-pane fade" id="search-by-part" role="tabpanel">
                        <form wire:submit.prevent="searchByPartNumber">
                            <div class="row g-3">
                                <div class="col-md-9">
                                    <input type="text" 
                                           wire:model="partNumber" 
                                           class="form-control" 
                                           placeholder="{{ __('Enter part number') }}"
                                           required>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-2"></i>
                                        {{ __('Search') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Catalogs Grid -->
    @if($catalogs && count($catalogs) > 0)
    <div class="catalogs-grid mb-5">
        <div class="container">
            <div class="row g-4">
                @foreach($catalogs as $catalog)
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="catalog-card" wire:click="selectCatalog('{{ $catalog->code }}')">
                        <div class="catalog-image">
                            @if($catalog->image)
                            <img src="{{ asset('assets/images/catalogs/' . $catalog->image) }}" 
                                 alt="{{ $catalog->name }}"
                                 class="img-fluid">
                            @else
                            <div class="no-image">
                                <i class="fas fa-car fa-3x"></i>
                            </div>
                            @endif
                        </div>
                        <div class="catalog-info">
                            <h5 class="catalog-name">{{ $catalog->name }}</h5>
                            <div class="catalog-meta">
                                <span class="badge bg-primary">{{ $catalog->brand }}</span>
                                <span class="badge bg-secondary">{{ $catalog->year }}</span>
                                <span class="badge bg-info">{{ $catalog->region }}</span>
                            </div>
                            <div class="catalog-stats mt-2">
                                <small class="text-muted">
                                    <i class="fas fa-cog me-1"></i>
                                    {{ $catalog->parts_count ?? 0 }} {{ __('parts') }}
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if(method_exists($catalogs, 'links'))
            <div class="pagination-wrapper mt-4">
                {{ $catalogs->links() }}
            </div>
            @endif
        </div>
    </div>
    @else
    <!-- Empty State -->
    <div class="empty-state text-center py-5">
        <div class="container">
            <div class="empty-icon mb-3">
                <i class="fas fa-search fa-4x text-muted"></i>
            </div>
            <h4>{{ __('No catalogs found') }}</h4>
            <p class="text-muted">{{ __('Try adjusting your search criteria') }}</p>
        </div>
    </div>
    @endif

    <!-- Popular Brands -->
    <div class="popular-brands py-5 bg-light">
        <div class="container">
            <h3 class="section-title text-center mb-4">{{ __('Popular Brands') }}</h3>
            <div class="row g-4">
                @foreach($popularBrands ?? [] as $brand)
                <div class="col-lg-2 col-md-3 col-sm-4 col-6">
                    <div class="brand-card" wire:click="selectBrand('{{ $brand->name }}')">
                        @if($brand->logo)
                        <img src="{{ asset('assets/images/brands/' . $brand->logo) }}" 
                             alt="{{ $brand->name }}"
                             class="img-fluid">
                        @else
                        <div class="brand-name">{{ $brand->name }}</div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Loading Indicator -->
    <div wire:loading class="loading-overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">{{ __('Loading...') }}</span>
        </div>
    </div>

</div>

@push('styles')
<style>
/* Catalog Header */
.catalog-header {
    background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
    color: var(--white);
    padding: var(--space-8) 0;
    border-radius: var(--radius-lg);
}

.page-title {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: var(--space-2);
}

.page-subtitle {
    font-size: 1.125rem;
    opacity: 0.9;
}

.catalog-stats {
    display: flex;
    justify-content: flex-end;
    gap: var(--space-6);
}

.stat-item {
    text-align: center;
}

.stat-item strong {
    display: block;
    font-size: 2rem;
    font-weight: 700;
}

.stat-item span {
    font-size: 0.875rem;
    opacity: 0.9;
}

/* Search Box */
.search-box {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-6);
    box-shadow: var(--shadow-lg);
}

.nav-tabs .nav-link {
    border: none;
    color: var(--gray-600);
    font-weight: 600;
}

.nav-tabs .nav-link.active {
    color: var(--primary-500);
    border-bottom: 2px solid var(--primary-500);
}

/* Catalog Card */
.catalog-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-base);
    cursor: pointer;
}

.catalog-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.catalog-image {
    height: 200px;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

.catalog-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.no-image {
    color: var(--gray-400);
}

.catalog-info {
    padding: var(--space-4);
}

.catalog-name {
    font-size: 1rem;
    font-weight: 600;
    color: var(--gray-900);
    margin-bottom: var(--space-2);
}

.catalog-meta {
    display: flex;
    gap: var(--space-2);
    flex-wrap: wrap;
}

/* Brand Card */
.brand-card {
    background: var(--white);
    border-radius: var(--radius-md);
    padding: var(--space-4);
    text-align: center;
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-base);
    cursor: pointer;
    height: 100px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.brand-card:hover {
    box-shadow: var(--shadow-md);
    transform: translateY(-2px);
}

.brand-card img {
    max-width: 100%;
    max-height: 60px;
}

.brand-name {
    font-weight: 600;
    color: var(--gray-700);
}

/* Loading Overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.5);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

/* Responsive */
@media (max-width: 768px) {
    .page-title {
        font-size: 1.75rem;
    }
    
    .catalog-stats {
        justify-content: center;
        margin-top: var(--space-4);
    }
    
    .stat-item strong {
        font-size: 1.5rem;
    }
}
</style>
@endpush
