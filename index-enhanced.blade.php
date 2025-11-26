@extends('layouts.vendor')

@section('content')
<div class="vendor-dashboard-enhanced">
    
    {{-- Page Header --}}
    <div class="dashboard-header mb-4">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="dashboard-title">
                    <i class="fas fa-store me-2"></i>
                    {{ __('Dashboard Overview') }}
                </h1>
                <p class="dashboard-subtitle">
                    {{ __('Welcome back,') }} <strong>{{ auth()->user()->name }}</strong>! 
                    {{ __('Here is your store performance.') }}
                </p>
            </div>
            <div class="col-md-4 text-md-end">
                <div class="dashboard-date">
                    <i class="fas fa-calendar-alt me-2"></i>
                    {{ now()->format('F d, Y') }}
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards Row 1 - Orders --}}
    <div class="stats-section mb-4">
        <h5 class="section-title mb-3">
            <i class="fas fa-shopping-bag me-2"></i>
            {{ __('Orders Status') }}
        </h5>
        <div class="row g-3 g-md-4">
            {{-- Order Pending --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-pending">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Order Pending') }}</p>
                        <h2 class="stat-value">
                            <span class="counter">{{ count($pending) }}</span>
                        </h2>
                        <div class="stat-footer">
                            <span class="stat-badge badge bg-warning">{{ __('Needs Action') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Order Processing --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-processing">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-spinner"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Order Processing') }}</p>
                        <h2 class="stat-value">
                            <span class="counter">{{ count($processing) }}</span>
                        </h2>
                        <div class="stat-footer">
                            <span class="stat-badge badge bg-info">{{ __('In Progress') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Orders Completed --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-completed">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Orders Completed') }}</p>
                        <h2 class="stat-value">
                            <span class="counter">{{ count($completed) }}</span>
                        </h2>
                        <div class="stat-footer">
                            <span class="stat-badge badge bg-success">{{ __('Done') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Products --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-products">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-box"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Total Products') }}</p>
                        <h2 class="stat-value">
                            <span class="counter">{{ $user->merchantProducts()->count() }}</span>
                        </h2>
                        <div class="stat-footer">
                            <a href="#" class="stat-link">{{ __('Manage') }} <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Stats Cards Row 2 - Financial --}}
    <div class="stats-section mb-4">
        <h5 class="section-title mb-3">
            <i class="fas fa-chart-line me-2"></i>
            {{ __('Financial Overview') }}
        </h5>
        <div class="row g-3 g-md-4">
            {{-- Total Item Sold --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-sales">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Total Item Sold') }}</p>
                        <h2 class="stat-value">
                            <span class="counter">{{ App\Models\VendorOrder::where('user_id', '=', $user->id)->where('status', '=', 'completed')->sum('qty') }}</span>
                        </h2>
                        <div class="stat-footer">
                            <span class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i> 8.5%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Current Balance --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-balance">
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Current Balance') }}</p>
                        <h2 class="stat-value">
                            {{ $curr->sign }}<span class="counter">{{ App\Models\Product::vendorConvertWithoutCurrencyPrice(auth()->user()->current_balance) }}</span>
                        </h2>
                        <div class="stat-footer">
                            <a href="#" class="stat-link">{{ __('Withdraw') }} <i class="fas fa-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Earning --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-earning">
                    @php
                        $datas = App\Models\VendorOrder::with('order')->where('user_id', Auth::user()->id);
                        $totalPrice = $datas->count() > 0 ? $datas->sum('price') : 0;
                    @endphp
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Total Earning') }}</p>
                        <h2 class="stat-value">
                            {{ $curr->sign }}<span class="counter">{{ App\Models\Product::vendorConvertWithoutCurrencyPrice($totalPrice) }}</span>
                        </h2>
                        <div class="stat-footer">
                            <span class="stat-trend trend-up">
                                <i class="fas fa-arrow-up"></i> 12.3%
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Pending Commission --}}
            <div class="col-12 col-sm-6 col-lg-3">
                <div class="vendor-stat-card stat-commission">
                    @php
                        $totalPrice = $user->vendororders->where('status', 'completed')->sum(function ($order) {
                            return $order->price * $order->qty;
                        });
                        $commission = $totalPrice * (auth()->user()->commission / 100);
                    @endphp
                    <div class="stat-icon-wrapper">
                        <div class="stat-icon">
                            <i class="fas fa-percentage"></i>
                        </div>
                    </div>
                    <div class="stat-content">
                        <p class="stat-label">{{ __('Pending Commission') }}</p>
                        <h2 class="stat-value">
                            {{ $curr->sign }}<span class="counter">{{ App\Models\Product::vendorConvertWithoutCurrencyPrice($commission) }}</span>
                        </h2>
                        <div class="stat-footer">
                            <span class="text-muted small">{{ auth()->user()->commission }}% {{ __('rate') }}</span>
                        </div>
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
                        {{ __('Sales Performance') }}
                    </h5>
                    <div class="chart-actions">
                        <select class="form-select form-select-sm">
                            <option value="7">{{ __('Last 7 Days') }}</option>
                            <option value="30" selected>{{ __('Last 30 Days') }}</option>
                            <option value="90">{{ __('Last 90 Days') }}</option>
                        </select>
                    </div>
                </div>
                <div class="chart-body">
                    <canvas id="vendorSalesChart" height="300"></canvas>
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="col-12 col-lg-4">
            <div class="chart-card">
                <div class="chart-header">
                    <h5 class="chart-title">
                        <i class="fas fa-tachometer-alt me-2"></i>
                        {{ __('Quick Stats') }}
                    </h5>
                </div>
                <div class="chart-body">
                    <div class="quick-stats-list">
                        <div class="quick-stat-item">
                            <div class="quick-stat-icon bg-primary">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div class="quick-stat-info">
                                <p class="quick-stat-label">{{ __('Store Views') }}</p>
                                <h4 class="quick-stat-value">1,234</h4>
                            </div>
                        </div>
                        <div class="quick-stat-item">
                            <div class="quick-stat-icon bg-success">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="quick-stat-info">
                                <p class="quick-stat-label">{{ __('Average Rating') }}</p>
                                <h4 class="quick-stat-value">4.8/5</h4>
                            </div>
                        </div>
                        <div class="quick-stat-item">
                            <div class="quick-stat-icon bg-warning">
                                <i class="fas fa-comments"></i>
                            </div>
                            <div class="quick-stat-info">
                                <p class="quick-stat-label">{{ __('Total Reviews') }}</p>
                                <h4 class="quick-stat-value">89</h4>
                            </div>
                        </div>
                        <div class="quick-stat-item">
                            <div class="quick-stat-icon bg-info">
                                <i class="fas fa-redo"></i>
                            </div>
                            <div class="quick-stat-info">
                                <p class="quick-stat-label">{{ __('Return Rate') }}</p>
                                <h4 class="quick-stat-value">2.1%</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Recent Orders --}}
    <div class="table-card mb-4">
        <div class="table-header">
            <h5 class="table-title">
                <i class="fas fa-list me-2"></i>
                {{ __('Recent Orders') }}
            </h5>
            <a href="#" class="btn btn-sm btn-outline-primary">
                {{ __('View All') }}
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>{{ __('Order ID') }}</th>
                        <th>{{ __('Customer') }}</th>
                        <th>{{ __('Product') }}</th>
                        <th>{{ __('Qty') }}</th>
                        <th>{{ __('Price') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Date') }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center py-4">
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
                <a href="#" class="vendor-quick-action">
                    <i class="fas fa-plus-circle"></i>
                    <span>{{ __('Add Product') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="#" class="vendor-quick-action">
                    <i class="fas fa-shopping-bag"></i>
                    <span>{{ __('View Orders') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="#" class="vendor-quick-action">
                    <i class="fas fa-chart-bar"></i>
                    <span>{{ __('Reports') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="#" class="vendor-quick-action">
                    <i class="fas fa-cog"></i>
                    <span>{{ __('Settings') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="#" class="vendor-quick-action">
                    <i class="fas fa-wallet"></i>
                    <span>{{ __('Withdraw') }}</span>
                </a>
            </div>
            <div class="col-6 col-md-4 col-lg-3 col-xl-2">
                <a href="#" class="vendor-quick-action">
                    <i class="fas fa-question-circle"></i>
                    <span>{{ __('Help') }}</span>
                </a>
            </div>
        </div>
    </div>

</div>

@push('styles')
<style>
/* Dashboard Header */
.dashboard-header {
    background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);
    color: var(--white);
    padding: var(--space-6);
    border-radius: var(--radius-lg);
}

.dashboard-title {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: var(--space-2);
}

.dashboard-subtitle {
    font-size: 1rem;
    opacity: 0.95;
    margin-bottom: 0;
}

.dashboard-date {
    background: rgba(255, 255, 255, 0.2);
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    display: inline-block;
}

/* Section Title */
.section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: var(--gray-900);
}

/* Vendor Stat Card */
.vendor-stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-5);
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.vendor-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
}

.stat-pending::before { background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%); }
.stat-processing::before { background: linear-gradient(90deg, #3b82f6 0%, #2563eb 100%); }
.stat-completed::before { background: linear-gradient(90deg, #10b981 0%, #059669 100%); }
.stat-products::before { background: linear-gradient(90deg, #8b5cf6 0%, #7c3aed 100%); }
.stat-sales::before { background: linear-gradient(90deg, #06b6d4 0%, #0891b2 100%); }
.stat-balance::before { background: linear-gradient(90deg, #10b981 0%, #059669 100%); }
.stat-earning::before { background: linear-gradient(90deg, #f59e0b 0%, #d97706 100%); }
.stat-commission::before { background: linear-gradient(90deg, #ec4899 0%, #db2777 100%); }

.vendor-stat-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-xl);
}

.stat-icon-wrapper {
    margin-bottom: var(--space-4);
}

.stat-icon {
    width: 56px;
    height: 56px;
    border-radius: 50%;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(79, 70, 229, 0.2) 100%);
    display: flex;
    align-items: center;
    justify-content: center;
}

.stat-icon i {
    font-size: 1.5rem;
    color: #6366f1;
}

.stat-label {
    font-size: 0.875rem;
    color: var(--gray-600);
    margin-bottom: var(--space-2);
    font-weight: 600;
}

.stat-value {
    font-size: 2.25rem;
    font-weight: 800;
    color: var(--gray-900);
    margin-bottom: var(--space-3);
    line-height: 1;
}

.stat-footer {
    margin-top: var(--space-3);
}

.stat-link {
    color: #6366f1;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.875rem;
}

.stat-link:hover {
    color: #4f46e5;
}

.stat-trend {
    font-weight: 700;
    font-size: 0.875rem;
}

.trend-up {
    color: #10b981;
}

/* Chart Card */
.chart-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    box-shadow: var(--shadow-md);
    overflow: hidden;
    height: 100%;
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

/* Quick Stats */
.quick-stats-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.quick-stat-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-3);
    background: var(--gray-50);
    border-radius: var(--radius-md);
}

.quick-stat-icon {
    width: 48px;
    height: 48px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--white);
}

.quick-stat-icon i {
    font-size: 1.25rem;
}

.quick-stat-info {
    flex: 1;
}

.quick-stat-label {
    font-size: 0.8125rem;
    color: var(--gray-600);
    margin-bottom: var(--space-1);
}

.quick-stat-value {
    font-size: 1.25rem;
    font-weight: 700;
    margin-bottom: 0;
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

/* Vendor Quick Actions */
.vendor-quick-action {
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

.vendor-quick-action:hover {
    border-color: #6366f1;
    background: rgba(99, 102, 241, 0.05);
    color: #6366f1;
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
}

.vendor-quick-action i {
    font-size: 2rem;
    margin-bottom: var(--space-2);
}

.vendor-quick-action span {
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
        font-size: 1.75rem;
    }
    
    .stat-icon {
        width: 48px;
        height: 48px;
    }
    
    .stat-icon i {
        font-size: 1.25rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Counter animation
document.querySelectorAll('.counter').forEach(counter => {
    const target = parseInt(counter.textContent);
    let current = 0;
    const increment = target / 50;
    const timer = setInterval(() => {
        current += increment;
        if (current >= target) {
            counter.textContent = target;
            clearInterval(timer);
        } else {
            counter.textContent = Math.floor(current);
        }
    }, 20);
});
</script>
@endpush

@endsection
