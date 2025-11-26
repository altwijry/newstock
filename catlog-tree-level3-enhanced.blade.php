<div class="catalog-tree-level3">
    
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
                    <li class="breadcrumb-item d-none d-md-block">
                        <a href="{{ route('tree.level1', [
                            'id' => $brand->name,
                            'data' => $catalog->code,
                            'vin' => Session::get('vin')
                        ]) }}">
                            <i class="fas fa-barcode me-1"></i>
                            {{ Session::get('vin') }}
                        </a>
                    </li>
                    @endif

                    {{-- Catalog (Level 1) --}}
                    <li class="breadcrumb-item d-none d-md-block">
                        <a href="{{ route('tree.level1', [
                            'id' => $brand->name,
                            'data' => $catalog->code
                        ]) }}">
                            {{ strtoupper($catalog->shortName ?? $catalog->name ?? $catalog->code) }}
                        </a>
                    </li>

                    {{-- Parent Category 1 --}}
                    @if($parentCategory1)
                    <li class="breadcrumb-item d-none d-lg-block">
                        <a href="{{ route('tree.level2', [
                            'id' => $brand->name,
                            'data' => $catalog->code,
                            'key1' => $parentCategory1->full_code
                        ]) }}">
                            {{ strtoupper($parentCategory1->slug ?? $parentCategory1->full_code) }}
                        </a>
                    </li>
                    @endif

                    {{-- Parent Category 2 (Current) --}}
                    @if($parentCategory2)
                    <li class="breadcrumb-item active" aria-current="page">
                        <strong>{{ strtoupper($parentCategory2->slug ?? $parentCategory2->full_code) }}</strong>
                    </li>
                    @endif
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
                        <a href="{{ route('tree.level2', [
                            'id' => $brand->name,
                            'data' => $catalog->code,
                            'key1' => $parentCategory1->full_code
                        ]) }}" class="btn btn-sm btn-outline-light">
                            <i class="fas fa-arrow-left me-1"></i>
                            {{ __('Back to Subcategories') }}
                        </a>
                    </div>
                    <h1 class="page-title">
                        <i class="fas fa-cog me-2"></i>
                        {{ $parentCategory2->label_ar ?? $parentCategory2->label_en ?? $parentCategory2->full_code }}
                    </h1>
                    <p class="page-subtitle">
                        {{ __('Select Part Group') }} - {{ $parentCategory1->label_ar ?? $parentCategory1->label_en ?? $parentCategory1->full_code }}
                    </p>
                </div>
                <div class="col-md-4 text-md-end">
                    <div class="catalog-info">
                        <span class="badge bg-primary me-2">
                            <i class="fas fa-boxes me-1"></i>
                            {{ $categories ? $categories->count() : 0 }} {{ __('Part Groups') }}
                        </span>
                        @if(Session::get('vin'))
                        <span class="badge bg-success">
                            <i class="fas fa-filter me-1"></i>
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
                @php
                    $allowedCodes = collect($categories ?? [])
                        ->map(function($item) {
                            return is_array($item) ? ($item['full_code'] ?? null) : ($item->full_code ?? null);
                        })
                        ->filter()
                        ->map(fn($v) => (string) $v)
                        ->values()
                        ->all();
                @endphp
                <livewire:vehicle-search-box 
                    :catalog="$catalog->code" 
                    :allowed-codes-override="$allowedCodes" />
            </div>
        </div>
    </div>

    {{-- Parts Groups Grid --}}
    <div class="parts-groups-wrapper">
        <div class="container">
            
            @if($categories && $categories->count() > 0)
            
            {{-- Auto-redirect if only one category --}}
            @if($categories->count() === 1)
                @php
                    $category = $categories->first();
                    $redirectUrl = route('illustrations', [
                        'id' => $brand->name,
                        'data' => $catalog->code,
                        'key1' => $parentCategory1->full_code,
                        'key2' => $parentCategory2->full_code,
                        'key3' => $category->full_code,
                        'vin' => Session::get('vin')
                    ]);
                @endphp
                <div class="auto-redirect-notice">
                    <div class="alert alert-info text-center">
                        <div class="spinner-border spinner-border-sm me-2" role="status">
                            <span class="visually-hidden">{{ __('Loading...') }}</span>
                        </div>
                        {{ __('Redirecting to parts illustration...') }}
                    </div>
                </div>
                <script>
                    setTimeout(function() {
                        window.location.href = "{{ $redirectUrl }}";
                    }, 1000);
                </script>
            @else
            
            {{-- Toolbar --}}
            <div class="parts-toolbar mb-3">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">
                            {{ __('Showing') }} <strong>{{ $categories->count() }}</strong> {{ __('part groups') }}
                        </p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <button class="btn btn-sm btn-outline-primary" onclick="toggleViewMode()">
                            <i class="fas fa-th-large me-1"></i>
                            <span id="viewModeText">{{ __('Grid View') }}</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Parts Groups Grid --}}
            <div class="row g-3 g-md-4" id="partsGroupsGrid">
                @foreach($categories as $partGroup)
                <div class="col-6 col-sm-6 col-md-4 col-lg-3">
                    <a href="{{ route('illustrations', [
                        'id' => $brand->name,
                        'data' => $catalog->code,
                        'key1' => $parentCategory1->full_code,
                        'key2' => $parentCategory2->full_code,
                        'key3' => $partGroup->full_code,
                        'vin' => Session::get('vin')
                    ]) }}" class="part-group-link">
                        <div class="part-group-card">
                            
                            {{-- Image --}}
                            <div class="part-group-image">
                                @if($partGroup->thumbnail)
                                <img src="{{ Storage::url($partGroup->thumbnail) }}" 
                                     alt="{{ $partGroup->full_code }}"
                                     loading="lazy"
                                     onerror="this.onerror=null; this.src='{{ asset('assets/images/no-image.png') }}';">
                                @else
                                <div class="no-image">
                                    <i class="fas fa-cogs fa-3x"></i>
                                </div>
                                @endif
                                
                                {{-- Code Badge --}}
                                <div class="code-badge">
                                    <span class="badge bg-dark">{{ $partGroup->full_code }}</span>
                                </div>
                            </div>

                            {{-- Info --}}
                            <div class="part-group-info">
                                <h6 class="part-group-code">{{ $partGroup->full_code }}</h6>
                                @if($partGroup->label_ar || $partGroup->label_en)
                                <p class="part-group-label">{{ $partGroup->label_ar ?? $partGroup->label_en }}</p>
                                @endif
                                
                                {{-- View Parts Button --}}
                                <div class="view-parts-btn">
                                    <span class="btn btn-sm btn-primary">
                                        <i class="fas fa-eye me-1"></i>
                                        {{ __('View Parts') }}
                                    </span>
                                </div>
                            </div>

                            {{-- Hover Indicator --}}
                            <div class="hover-indicator">
                                <i class="fas fa-arrow-right"></i>
                            </div>

                        </div>
                    </a>
                </div>
                @endforeach
            </div>

            @endif

            @else
            
            {{-- Empty State --}}
            <div class="empty-state text-center py-5">
                <div class="empty-icon mb-3">
                    <i class="fas fa-box-open fa-4x text-muted"></i>
                </div>
                <h4>{{ __('No part groups available') }}</h4>
                <p class="text-muted">{{ __('There are no part groups in this category.') }}</p>
                <div class="empty-actions mt-4">
                    <a href="{{ route('tree.level2', [
                        'id' => $brand->name,
                        'data' => $catalog->code,
                        'key1' => $parentCategory1->full_code
                    ]) }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left me-2"></i>
                        {{ __('Back to Subcategories') }}
                    </a>
                    @if(Session::get('vin'))
                    <a href="{{ route('catlogs.index', $brand->name) }}" class="btn btn-outline-secondary ms-2">
                        <i class="fas fa-redo me-2"></i>
                        {{ __('Reset Filters') }}
                    </a>
                    @endif
                </div>
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
    background: linear-gradient(135deg, var(--primary-700) 0%, var(--primary-900) 100%);
    color: var(--white);
    padding: var(--space-6) 0;
    border-radius: var(--radius-lg);
}

/* Part Group Card */
.part-group-link {
    text-decoration: none;
    display: block;
}

.part-group-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    overflow: hidden;
    box-shadow: var(--shadow-md);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    height: 100%;
    border: 2px solid transparent;
}

.part-group-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: var(--shadow-2xl);
    border-color: var(--primary-500);
}

.part-group-image {
    height: 240px;
    background: linear-gradient(135deg, var(--gray-100) 0%, var(--gray-200) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    position: relative;
}

.part-group-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.part-group-card:hover .part-group-image img {
    transform: scale(1.2) rotate(2deg);
}

.code-badge {
    position: absolute;
    top: var(--space-3);
    left: var(--space-3);
    z-index: 2;
}

.code-badge .badge {
    font-size: 0.875rem;
    padding: var(--space-2) var(--space-4);
    font-weight: 700;
    letter-spacing: 0.5px;
}

.part-group-info {
    padding: var(--space-5);
    text-align: center;
}

.part-group-code {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: var(--space-3);
    text-transform: uppercase;
    letter-spacing: 1px;
}

.part-group-label {
    font-size: 0.9375rem;
    color: var(--gray-700);
    margin-bottom: var(--space-4);
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    line-height: 1.5;
    min-height: 3em;
}

.view-parts-btn {
    opacity: 0;
    transform: translateY(10px);
    transition: all 0.3s ease;
}

.part-group-card:hover .view-parts-btn {
    opacity: 1;
    transform: translateY(0);
}

.view-parts-btn .btn {
    font-weight: 600;
}

/* Hover Indicator */
.hover-indicator {
    position: absolute;
    bottom: var(--space-3);
    right: var(--space-3);
    width: 40px;
    height: 40px;
    background: var(--primary-500);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
    opacity: 0;
    transform: scale(0);
    transition: all 0.3s ease;
}

.part-group-card:hover .hover-indicator {
    opacity: 1;
    transform: scale(1);
}

/* List View Mode */
.view-mode-list .part-group-card {
    display: flex;
    flex-direction: row;
}

.view-mode-list .part-group-image {
    width: 200px;
    height: 200px;
    flex-shrink: 0;
}

.view-mode-list .part-group-info {
    text-align: left;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

/* Auto Redirect Notice */
.auto-redirect-notice {
    max-width: 500px;
    margin: var(--space-8) auto;
}

/* Responsive */
@media (max-width: 768px) {
    .part-group-image {
        height: 180px;
    }
    
    .part-group-code {
        font-size: 1rem;
    }
    
    .part-group-label {
        font-size: 0.8125rem;
        -webkit-line-clamp: 1;
        min-height: auto;
    }
    
    .code-badge .badge {
        font-size: 0.75rem;
        padding: var(--space-1) var(--space-2);
    }
}
</style>
@endpush

@push('scripts')
<script>
let isListView = false;

function toggleViewMode() {
    const grid = document.getElementById('partsGroupsGrid');
    const text = document.getElementById('viewModeText');
    
    isListView = !isListView;
    
    if (isListView) {
        grid.classList.add('view-mode-list');
        grid.classList.remove('row');
        text.textContent = '{{ __("List View") }}';
    } else {
        grid.classList.remove('view-mode-list');
        grid.classList.add('row');
        text.textContent = '{{ __("Grid View") }}';
    }
}
</script>
@endpush
