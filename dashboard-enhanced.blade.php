@extends('layouts.admin')

@section('content')
<div class="admin-dashboard-enhanced">
    
    {{-- Alerts --}}
    @include('alerts.form-success')

    @if($activation_notify != "")
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-exclamation-triangle fa-2x me-3"></i>
            <div>
                <h5 class="alert-heading mb-1">{{ __('Activation Required') }}</h5>
                <p class="mb-0">{!! clean($activation_notify, array('Attr.EnableID' => true)) !!}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(Session::has('cache'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-check-circle fa-2x me-3"></i>
            <div>
                <h5 class="alert-heading mb-1">{{ __('Success') }}</h5>
                <p class="mb-0">{{ Session::get("cache") }}</p>
            </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Page Header --}}
    <div class="dashboard-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h1 class="dashboard-title">
                    <i class="fas fa-chart-line me-2"></i>
                    {{ __('Dashboard Overview') }}
                </h1>
                <p class="dashboard-subtitle">{{ __('Welcome back!') }} {{ __('Here is your store summary.') }}</p>
            </div>
            <div class="col-md-6 text-md-end">
                <div class="dashboard-actions">
                    <button class="btn btn-outline-primary me-2" onclick="refreshDashboard()">
                        <i class="fas fa-sync-alt me-1"></i>
                        {{ __('Refresh') }}
                    </button>
                    <button class="btn btn-primary" onclick="exportReport()">
                        <i class="fas fa-download me-1"></i>
                        {{ __('Export Report') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards Row 1 - Orders --}}
    <div class="stats-section mb-4">
        <h5 class="section-title mb-3">
            <i class="fas fa-shopping-cart me-2"></i>
            {{ __('Orders Overview') }}
        </h5>
        <div class="row g-3 g-md-4">
            {{-- Pending Orders --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-warning">
                    <div class="stat-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Orders Pending') }}</h6>
                        <h2 class="stat-value">{{ count($pending) }}</h2>
                        <a href="{{ route('admin-orders-all') }}?status=pending" class="stat-link">
                            {{ __('View All') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="stat-badge">
                        <span class="badge bg-warning">{{ __('Action Required') }}</span>
                    </div>
                </div>
            </div>

            {{-- Processing Orders --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-info">
                    <div class="stat-icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Orders Processing') }}</h6>
                        <h2 class="stat-value">{{ count($processing) }}</h2>
                        <a href="{{ route('admin-orders-all') }}?status=processing" class="stat-link">
                            {{ __('View All') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="stat-badge">
                        <span class="badge bg-info">{{ __('In Progress') }}</span>
                    </div>
                </div>
            </div>

            {{-- Completed Orders --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-success">
                    <div class="stat-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Orders Completed') }}</h6>
                        <h2 class="stat-value">{{ count($completed) }}</h2>
                        <a href="{{ route('admin-orders-all') }}?status=completed" class="stat-link">
                            {{ __('View All') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="stat-badge">
                        <span class="badge bg-success">{{ __('Done') }}</span>
                    </div>
                </div>
            </div>

            {{-- Total Revenue --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-primary">
                    <div class="stat-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Total Revenue') }}</h6>
                        <h2 class="stat-value">$0</h2>
                        <a href="{{ route('admin-orders-all') }}" class="stat-link">
                            {{ __('View Details') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                    <div class="stat-trend">
                        <span class="trend-up">
                            <i class="fas fa-arrow-up"></i> 12.5%
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards Row 2 - General --}}
    <div class="stats-section mb-4">
        <h5 class="section-title mb-3">
            <i class="fas fa-chart-bar me-2"></i>
            {{ __('General Statistics') }}
        </h5>
        <div class="row g-3 g-md-4">
            {{-- Total Products --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-purple">
                    <div class="stat-icon">
                        <i class="fas fa-box"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Total Products') }}</h6>
                        <h2 class="stat-value">{{ $products }}</h2>
                        <a href="{{ route('admin-prod-index') }}" class="stat-link">
                            {{ __('Manage Products') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Total Customers --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-teal">
                    <div class="stat-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Total Customers') }}</h6>
                        <h2 class="stat-value">{{ $users }}</h2>
                        <a href="{{ route('admin-user-index') }}" class="stat-link">
                            {{ __('Manage Users') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Total Posts --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-orange">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Total Posts') }}</h6>
                        <h2 class="stat-value">{{ $blogs }}</h2>
                        <a href="{{ route('admin-blog-index') }}" class="stat-link">
                            {{ __('Manage Posts') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Total Vendors --}}
            <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                <div class="stat-card stat-card-pink">
                    <div class="stat-icon">
                        <i class="fas fa-store"></i>
                    </div>
                    <div class="stat-content">
                        <h6 class="stat-label">{{ __('Total Vendors') }}</h6>
                        <h2 class="stat-value">0</h2>
                        <a href="#" class="stat-link">
                            {{ __('Manage Vendors') }} <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Charts Row --}}
    <div class="row g-3 g-md-4 mb-4">
        {{-- Sales Chart --}}
        <div class="col-12 col-lg-8">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">
                        <i class="fas fa-chart-area me-2"></i>
                        {{ __('Sales Overview') }}
                    </h5>
                    <div class="chart-actions">
                        <select class="form-select form-select-sm" onchange="updateSalesChart(this.value)">
                            <option value="7">{{ __('Last 7 Days') }}</option>
                            <option value="30" selected>{{ __('Last 30 Days') }}</option>
                            <option value="90">{{ __('Last 90 Days') }}</option>
                            <option value="365">{{ __('Last Year') }}</option>
                        </select>
                    </div>
                </div>
                <div class="chart-body">
                    <canvas id="salesChart" height="300"></canvas>
                </div>
            </div>
        </div>

        {{-- Top Products --}}
        <div class="col-12 col-lg-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">
                        <i class="fas fa-star me-2"></i>
                        {{ __('Top Products') }}
                    </h5>
                </div>
                <div class="chart-body">
                    <div class="top-products-list">
                        @for($i = 1; $i <= 5; $i++)
                        <div class="top-product-item">
                            <div class="product-rank">#{{ $i }}</div>
                            <div class="product-info">
                                <h6 class="product-name">{{ __('Product Name') }} {{ $i }}</h6>
                                <p class="product-sales">{{ rand(100, 500) }} {{ __('sales') }}</p>
                            </div>
                            <div class="product-revenue">
                                ${{ number_format(rand(1000, 5000), 2) }}
                            </div>
                        </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders Table --}}
    <div class="table-card mb-4">
        <div class="table-header">
            <h5 class="table-title">
                <i class="fas fa-list me-2"></i>
                {{ __('Recent Orders') }}
            </h5>
            <a href="{{ route('admin-orders-all') }}" class="btn btn-sm btn-outline-primary">
                {{ __('View All Orders') }}
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Order ID') }}</th>
                        <th>{{ __('Customer') }}</th>
                        <th>{{ __('Date') }}</th>
                        <th>{{ __('Total') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6" class="text-center py-4">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">{{ __('No recent orders') }}</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="quick-actions-section">
        <h5 class="section-title mb-3">
            <i class="fas fa-bolt me-2"></i>
            {{ __('Quick Actions') }}
        </h5>
        <div class="row g-3">
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('admin-prod-create') }}" class="quick-action-btn">
                    <i class="fas fa-plus-circle"></i>
                    <span>{{ __('Add Product') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('admin-orders-all') }}" class="quick-action-btn">
                    <i class="fas fa-shopping-cart"></i>
                    <span>{{ __('View Orders') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('admin-user-index') }}" class="quick-action-btn">
                    <i class="fas fa-users"></i>
                    <span>{{ __('Manage Users') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('admin-blog-create') }}" class="quick-action-btn">
                    <i class="fas fa-pen"></i>
                    <span>{{ __('Write Post') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="{{ route('admin-gs-index') }}" class="quick-action-btn">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('Settings') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="#" onclick="clearCache()" class="quick-action-btn">
                    <i class="fas fa-trash-alt"></i>
                    <span>{{ __('Clear Cache') }}</span>
                </a>
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
/* Dashboard Header */
.dashboard-header {
    background: linear-gradient(135deg, var(--primary-600) 0%, var(--primary-800) 100%);
    color: var(--white);
    padding: var(--space-6);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-6);
}

.dashboard-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: var(--space-2);
}

.dashboard-subtitle {
    font-size: 1rem;
    opacity: 0.9;
    margin-bottom: 0;
}

.dashboard-actions .btn {
    font-weight: 600;
}

/* Section Title */
.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-900);
}

/* Stat Cards */
.stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-5);
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-500) 0%, var(--primary-700) 100%);
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.stat-card-warning::before { background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%); }
.stat-card-info::before { background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%); }
.stat-card-success::before { background: linear-gradient(90deg, #10b981 0%, #059669 100%); }
.stat-card-primary::before { background: linear-gradient(90deg, var(--primary-500) 0%, var(--primary-700) 100%); }
.stat-card-purple::before { background: linear-gradient(90deg, #8b5cf6 0%, #7c3aed 100%); }
.stat-card-teal::before { background: linear-gradient(90deg, #14b8a6 0%, #0d9488 100%); }
.stat-card-orange::before { background: linear-gradient(90deg, #f97316 0%, #ea580c 100%); }
.stat-card-pink::before { background: linear-gradient(90deg, #ec4899 0%, #db2777 100%); }

.stat-icon {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-100) 0%, var(--primary-200) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: var(--space-4);
}

.stat-icon i {
    font-size: 1.75rem;
    color: var(--primary-600);
}

.stat-label {
    font-size: 0.875rem;
    color: var(--gray-600);
    margin-bottom: var(--space-2);
    font-weight: 600;
}

.stat-value {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: var(--space-3);
    line-height: 1;
}

.stat-link {
    color: var(--primary-600);
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
    transition: color 0.2s ease;
}

.stat-link:hover {
    color: var(--primary-800);
}

.stat-badge {
    position: absolute;
    top: var(--space-3);
    right: var(--space-3);
}

.stat-trend {
    position: absolute;
    top: var(--space-3);
    right: var(--space-3);
}

.trend-up {
    color: #10b981;
    font-weight: 700;
    font-size: 0.875rem;
}

/* Chart Card */
.chart-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.chart-header {
    padding: var(--space-4);
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.chart-title {
    font-size: 1.125rem;
    font-weight: 700;
    margin-bottom: 0;
}

.chart-body {
    padding: var(--space-4);
}

/* Top Products */
.top-products-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

.top-product-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-3);
    background: var(--gray-50);
    border-radius: var(--radius-md);
}

.product-rank {
    width: 32px;
    height: 32px;
    border-radius: 50%;
    background: var(--primary-600);
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.875rem;
}

.product-info {
    flex: 1;
}

.product-name {
    font-size: 0.875rem;
    font-weight: 600;
    margin-bottom: var(--space-1);
}

.product-sales {
    font-size: 0.75rem;
    color: var(--gray-600);
    margin-bottom: 0;
}

.product-revenue {
    font-weight: 700;
    color: var(--primary-600);
}

/* Table Card */
.table-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
}

.table-header {
    padding: var(--space-4);
    border-bottom: 1px solid var(--gray-200);
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.table-title {
    font-size: 1.125rem;
    font-weight: 700;
    margin-bottom: 0;
}

/* Quick Actions */
.quick-action-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: var(--space-4);
    background: var(--white);
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-lg);
    text-decoration: none;
    color: var(--gray-700);
    transition: all 0.3s ease;
    height: 100px;
}

.quick-action-btn:hover {
    border-color: var(--primary-500);
    background: var(--primary-50);
    color: var(--primary-700);
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.quick-action-btn i {
    font-size: 2rem;
    margin-bottom: var(--space-2);
}

.quick-action-btn span {
    font-size: 0.875rem;
    font-weight: 600;
    text-align: center;
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-title {
        font-size: 1.5rem;
    }
    
    .stat-value {
        font-size: 2rem;
    }
    
    .stat-icon {
        width: 50px;
        height: 50px;
    }
    
    .stat-icon i {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
function refreshDashboard() {
    location.reload();
}

function exportReport() {
    alert('Export functionality coming soon!');
}

function updateSalesChart(days) {
    console.log('Updating chart for last ' + days + ' days');
}

function clearCache() {
    if(confirm('Are you sure you want to clear cache?')) {
        window.location.href = '{{ route("admin-cache-clear") }}';
    }
}
</script>
@endpush

@endsection
