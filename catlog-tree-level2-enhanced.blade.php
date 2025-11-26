<div class="catalog-tree-level2">
    
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
                            'data' => $catalog->code,
                            'vin' => Session::get('vin')
                        ]) }}">
                            <i class="fas fa-barcode me-1"></i>
                            <span class="d-none d-md-inline">{{ Session::get('vin') }}</span>
                            <span class="d-md-none">VIN</span>
                        </a>
                    </li>
                    @endif

                    {{-- Catalog (Level 1) --}}
                    <li class="breadcrumb-item">
                        <a href="{{ route('tree.level1', [
                            'id' => $brand->name,
                            'data' => $catalog->code
                        ]) }}">
                            {{ strtoupper($catalog->shortName ?? $catalog->name ?? $catalog->code) }}
                        </a>
                    </li>

                    {{-- Current Category (Level 2) --}}
                    <li class="breadcrumb-item active" aria-current="page">
                        <strong>{{ strtoupper($category->slug ?? $category->full_code) }}</strong>
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
                    <div class="back-button mb-2">
                        <a href="{{ route('tree.level1', [
                            'id' => $brand->name,
                            'data' => $catalog->code
                        ]) }}" class="btn btn-sm btn-outline-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            {{ __('Back to Categories') }}
                        </a>
                    </div>
                    <h1 class="page-title">
                        <i class="fas fa-layer-group me-2"></i>
                        {{ $category->label_ar ?? $category->label_en ?? $category->full_code }}
                    </h1>
                    <p class="page-subtitle">
                        {{ __('Select Subcategory') }} - {{ $catalog->name ?? $catalog->code }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="catalog-info">
                        <span class="badge bg-primary me-2">
                            <i class="fas fa-folder me-1"></i>
                            {{ count($categories) }} {{ __('Subcategories') }}
                        </span>
                        @if(Session::get('vin'))
                        <span class="badge bg-success">
                            <i class="fas fa-check-circle me-1"></i>
                            {{ __('Filtered') }}
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
                    :allowed-codes-override="$allowedCodes" />
            </div>
        </div>
    </div>

    {{-- Subcategories Grid --}}
    <div class="subcategories-grid-wrapper">
        <div class="container">
            
            @if($categories && count($categories) > 0)
            
            {{-- Toolbar --}}
            <div class="categories-toolbar mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            {{ __('Showing') }} <strong>{{ count($categories) }}</strong> {{ __('subcategories') }}
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <div class="sort-options">
                            <select class="form-select form-select-sm" onchange="sortCategories(this.value)" style="width: auto; display: inline-block;">
                                <option value="code_asc">{{ __('Code') }} (A-Z)</option>
                                <option value="code_desc">{{ __('Code') }} (Z-A)</option>
                                <option value="label_asc">{{ __('Name') }} (A-Z)</option>
                                <option value="label_desc">{{ __('Name') }} (Z-A)</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            @php
                // Sort categories by numeric code if exists
                $sortedCategories = collect($categories)->sortBy(function($c) {
                    $code = is_array($c) ? ($c['full_code'] ?? '') : ($c->full_code ?? '');
                    if (preg_match('/\d+/', $code, $m)) {
                        return (int) $m[0];
                    }
                    return PHP_INT_MAX;
                })->values();
            @endphp

            {{-- Subcategories Grid --}}
            <div class="row g-3 g-md-4" id="subcategoriesGrid">
                @foreach($sortedCategories as $subcat)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('tree.level3', [
                        'id' => $brand->name,
                        'data' => $catalog->code,
                        'key1' => $category->full_code,
                        'key2' => $subcat->full_code,
                        'vin' => Session::get('vin')
                    ]) }}" class="subcategory-card-link">
                        <div class="subcategory-card">
                            
                            {{-- Image --}}
                            <div class="subcategory-image">
                                @if($subcat->thumbnail)
                                <img src="{{ Storage::url($subcat->thumbnail) }}" 
                                     alt="{{ $subcat->full_code }}"
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}';">
                                @else
                                <div class="no-image">
                                    <i class="fas fa-folder-open fa-3x"></i>
                                </div>
                                @endif
                                
                                {{-- Badge --}}
                                <div class="subcategory-badge">
                                    <span class="badge bg-primary">{{ $subcat->full_code }}</span>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="subcategory-info">
                                <h6 class="subcategory-code">{{ $subcat->full_code }}</h6>
                                @php
                                    $label = $subcat->label_ar ?? $subcat->label_en ?? null;
                                @endphp
                                @if(!empty($label))
                                <p class="subcategory-label">{{ $label }}</p>
                                @endif
                            </div>

                            {{-- Hover Effect --}}
                            <div class="subcategory-hover">
                                <div class="hover-content">
                                    <i class="fas fa-search-plus fa-2x mb-2"></i>
                                    <p class="mb-0">{{ __('View Parts') }}</p>
                                </div>
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
                <h4>{{ __('No subcategories available') }}</h4>
                <p class="text-muted">{{ __('Try adjusting your search criteria or filters') }}</p>
                <a href="{{ route('tree.level1', [
                    'id' => $brand->name,
                    'data' => $catalog->code
                ]) }}" class="btn btn-primary mt-3">
                    <i class="fas fa-arrow-left me-2"></i>
                    {{ __('Back to Categories') }}
                </a>
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
/* Page Header */
.page-header {
    background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-800) 100%);
    color: var(--white);
    padding: var(--space-6) 0;
    border-radius: var(--radius-lg);
}

.back-button .btn {
    border-color: rgba(255, 255, 255, 0.3);
    color: var(--white);
}

.back-button .btn:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: var(--white);
}

/* Subcategory Card */
.subcategory-card-link {
    text-decoration: none;
    display: block;
}

.subcategory-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all var(--transition-base);
    position: relative;
    height: 100%;
}

.subcategory-card:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-xl);
}

.subcategory-image {
    height: 220px;
    background: var(--gray-100);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

.subcategory-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.subcategory-card:hover .subcategory-image img {
    transform: scale(1.15);
}

.subcategory-badge {
    position: absolute;
    top: var(--space-2);
    right: var(--space-2);
}

.subcategory-badge .badge {
    font-size: 0.75rem;
    padding: var(--space-2) var(--space-3);
    font-weight: 600;
}

.subcategory-info {
    padding: var(--space-4);
    text-align: center;
}

.subcategory-code {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: var(--space-2);
    text-transform: uppercase;
}

.subcategory-label {
    font-size: 0.875rem;
    color: var(--gray-600);
    margin-bottom: 0;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.4;
}

/* Hover Effect */
.subcategory-hover {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(var(--primary-500-rgb), 0.95) 0%, rgba(var(--primary-700-rgb), 0.95) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.subcategory-card:hover .subcategory-hover {
    opacity: 1;
}

.hover-content {
    color: var(--white);
    text-align: center;
}

.hover-content i {
    animation: pulse 1.5s infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Sort Options */
.sort-options .form-select {
    border-color: var(--gray-300);
    font-size: 0.875rem;
}

/* Responsive */
@media (max-width: 768px) {
    .subcategory-image {
        height: 160px;
    }
    
    .subcategory-code {
        font-size: 0.875rem;
    }
    
    .subcategory-label {
        font-size: 0.75rem;
        -webkit-line-clamp: 1;
    }
}
</style>
@endpush

@push('scripts')
<script>
function sortCategories(sortBy) {
    const grid = document.getElementById('subcategoriesGrid');
    const cards = Array.from(grid.children);
    
    cards.sort((a, b) => {
        const codeA = a.querySelector('.subcategory-code').textContent.trim();
        const codeB = b.querySelector('.subcategory-code').textContent.trim();
        const labelA = a.querySelector('.subcategory-label')?.textContent.trim() || '';
        const labelB = b.querySelector('.subcategory-label')?.textContent.trim() || '';
        
        switch(sortBy) {
            case 'code_asc':
                return codeA.localeCompare(codeB);
            case 'code_desc':
                return codeB.localeCompare(codeA);
            case 'label_asc':
                return labelA.localeCompare(labelB);
            case 'label_desc':
                return labelB.localeCompare(labelA);
            default:
                return 0;
        }
    });
    
    cards.forEach(card => grid.appendChild(card));
}
</script>
@endpush
