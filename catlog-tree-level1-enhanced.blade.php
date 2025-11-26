<div class="catalog-tree-level1">
    
    {{-- Breadcrumb Navigation --}}
    <div class="breadcrumb-wrapper mb-4">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    {{-- Home --}}
                    <li class="breadcrumb-item">
                        <a href="{{ route('front.index') }}">
                            <i class="fas fa-home me-1"></i>
                            <span class="d-none d-md-inline">{{ __('Home') }}</span>
                        </a>
                    </li>

                    {{-- Brand --}}
                    <li class="breadcrumb-item">
                        <a href="{{ route('catlogs.index', $brand->name) }}">
                            <i class="fas fa-car me-1"></i>
                            {{ strtoupper($brand->name) }}
                        </a>
                    </li>

                    {{-- VIN (if exists) --}}
                    @if(Session::get('vin'))
                    <li class="breadcrumb-item">
                        <a href="{{ route('tree.level1', [
                            'id' => $brand->name,
                            'data' => $catalog,
                            'vin' => Session::get('vin')
                        ]) }}">
                            <i class="fas fa-barcode me-1"></i>
                            <span class="d-none d-md-inline">{{ Session::get('vin') }}</span>
                            <span class="d-md-none">VIN</span>
                        </a>
                    </li>
                    @endif

                    {{-- Current Catalog --}}
                    <li class="breadcrumb-item active" aria-current="page">
                        <strong>{{ strtoupper($catalog->shortName ?? $catalog->name ?? $catalog->code) }}</strong>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    {{-- Page Header --}}
    <div class="page-header mb-4">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="page-title">
                        <i class="fas fa-sitemap me-2"></i>
                        {{ __('Select Category') }}
                    </h1>
                    <p class="page-subtitle">
                        {{ $catalog->name ?? $catalog->code }} - {{ $brand->name }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="catalog-info">
                        <span class="badge bg-primary me-2">
                            <i class="fas fa-layer-group me-1"></i>
                            {{ count($categories) }} {{ __('Categories') }}
                        </span>
                        @if(Session::get('vin'))
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ __('VIN Matched') }}
                        </span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Vehicle Search Box --}}
    <div class="search-box-wrapper mb-4">
        <div class="container">
            <div class="search-box-card">
                <livewire:vehicle-search-box 
                    :catalog="$catalog->code" 
                    :spec="Session::get('attributes')" />
            </div>
        </div>
    </div>

    {{-- Categories Grid --}}
    <div class="categories-grid-wrapper">
        <div class="container">
            
            @if($categories && count($categories) > 0)
            
            {{-- Categories Count --}}
            <div class="categories-toolbar mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            {{ __('Showing') }} <strong>{{ count($categories) }}</strong> {{ __('categories') }}
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="view-options">
                            <button class="btn btn-sm btn-outline-secondary active" onclick="setGridView('grid')">
                                <i class="fas fa-th"></i>
                            </button>
                            <button class="btn btn-sm btn-outline-secondary" onclick="setGridView('list')">
                                <i class="fas fa-list"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Categories Grid --}}
            <div class="row g-3 g-md-4" id="categoriesGrid">
                @foreach($categories as $category)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('tree.level2', [
                        'id' => $brand->name,
                        'data' => $catalog->code,
                        'key1' => $category->full_code,
                        'vin' => Session::get('vin')
                    ]) }}" class="category-card-link">
                        <div class="category-card">
                            
                            {{-- Image --}}
                            <div class="category-image">
                                @if($category->thumbnail)
                                <img src="{{ Storage::url($category->thumbnail) }}" 
                                     alt="{{ $category->full_code }}"
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}';">
                                @else
                                <div class="no-image">
                                    <i class="fas fa-folder fa-3x"></i>
                                </div>
                                @endif
                            </div>

                            {{-- Info --}}
                            <div class="category-info">
                                <h6 class="category-code">{{ $category->full_code }}</h6>
                                @if($category->label)
                                <p class="category-label">{{ $category->label }}</p>
                                @endif
                            </div>

                            {{-- Hover Overlay --}}
                            <div class="category-overlay">
                                <i class="fas fa-arrow-right fa-2x"></i>
                            </div>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            @else
            
            {{-- Empty State --}}
            <div class="empty-state text-center py-5">
                <div class="empty-icon mb-3">
                    <i class="fas fa-folder-open fa-4x text-muted"></i>
                </div>
                <h4>{{ __('No categories available') }}</h4>
                <p class="text-muted">{{ __('Try adjusting your search criteria or filters') }}</p>
                @if(Session::get('vin'))
                <a href="{{ route('catlogs.index', $brand->name) }}" class="btn btn-primary mt-3">
                    <i class="fas fa-redo me-2"></i>
                    {{ __('Reset Filters') }}
                </a>
                @endif
            </div>

            @endif

        </div>
    </div>

    {{-- Loading Indicator --}}
    <div wire:loading class="loading-overlay">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">{{ __('Loading...') }}</span>
        </div>
    </div>

</div>

@push('styles')
<style>
/* Breadcrumb */
.breadcrumb-wrapper {
    background: var(--white);
    padding: var(--space-3) 0;
    border-bottom: 1px solid var(--gray-200);
}

.breadcrumb {
    background: transparent;
    padding: 0;
}

.breadcrumb-item a {
    color: var(--gray-600);
    text-decoration: none;
    transition: color var(--transition-base);
}

.breadcrumb-item a:hover {
    color: var(--primary-500);
}

.breadcrumb-item.active {
    color: var(--primary-500);
}

/* Page Header */
.page-header {
    background: linear-gradient(135deg, var(--primary-500) 0%, var(--primary-700) 100%);
    color: var(--white);
    padding: var(--space-6) 0;
    border-radius: var(--radius-lg);
}

.page-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: var(--space-2);
}

.page-subtitle {
    font-size: 1.125rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.catalog-info .badge {
    font-size: 0.875rem;
    padding: var(--space-2) var(--space-3);
}

/* Search Box */
.search-box-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-4);
    box-shadow: var(--shadow-md);
}

/* Categories Toolbar */
.categories-toolbar {
    padding: var(--space-3);
    background: var(--gray-50);
    border-radius: var(--radius-md);
}

.view-options .btn {
    margin-left: var(--space-2);
}

.view-options .btn.active {
    background: var(--primary-500);
    color: var(--white);
    border-color: var(--primary-500);
}

/* Category Card */
.category-card-link {
    text-decoration: none;
    display: block;
}

.category-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-base);
    position: relative;
    height: 100%;
}

.category-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.category-image {
    height: 200px;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

.category-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--transition-base);
}

.category-card:hover .category-image img {
    transform: scale(1.1);
}

.no-image {
    color: var(--gray-400);
    display: flex;
    align-items: center;
    justify-content: center;
    width: 100%;
    height: 100%;
}

.category-info {
    padding: var(--space-4);
    text-align: center;
}

.category-code {
    font-size: 1rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: var(--space-2);
    text-transform: uppercase;
}

.category-label {
    font-size: 0.875rem;
    color: var(--gray-600);
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Category Overlay */
.category-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.7);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity var(--transition-base);
}

.category-card:hover .category-overlay {
    opacity: 1;
}

.category-overlay i {
    color: var(--white);
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

/* Loading Overlay */
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.9);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 9999;
}

/* List View */
.grid-view-list .category-card {
    display: flex;
    flex-direction: row;
}

.grid-view-list .category-image {
    width: 150px;
    height: 150px;
    flex-shrink: 0;
}

.grid-view-list .category-info {
    text-align: left;
    flex: 1;
}

/* Responsive */
@media (max-width: 768px) {
    .page-title {
        font-size: 1.5rem;
    }
    
    .page-subtitle {
        font-size: 0.875rem;
    }
    
    .catalog-info {
        margin-top: var(--space-3);
    }
    
    .category-image {
        height: 150px;
    }
    
    .category-label {
        display: none;
    }
}
</style>
@endpush

@push('scripts')
<script>
function setGridView(view) {
    const grid = document.getElementById('categoriesGrid');
    const buttons = document.querySelectorAll('.view-options .btn');
    
    buttons.forEach(btn => btn.classList.remove('active'));
    event.target.closest('.btn').classList.add('active');
    
    if (view === 'list') {
        grid.classList.add('grid-view-list');
        grid.classList.remove('row');
    } else {
        grid.classList.remove('grid-view-list');
        grid.classList.add('row');
    }
}
</script>
@endpush
