@props([
    'title',
    'value',
    'icon',
    'color' => 'primary',
    'link' => '#',
    'badge' => null,
    'trend' => null
])

<div class="admin-stat-card stat-card-{{ $color }}">
    <div class="stat-icon">
        <i class="{{ $icon }}"></i>
    </div>
    <div class="stat-content">
        <h6 class="stat-label">{{ $title }}</h6>
        <h2 class="stat-value">{{ $value }}</h2>
        <a href="{{ $link }}" class="stat-link">
            {{ __('View All') }} <i class="fas fa-arrow-right ms-1"></i>
        </a>
    </div>
    
    @if($badge)
    <div class="stat-badge">
        <span class="badge bg-{{ $color }}">{{ $badge }}</span>
    </div>
    @endif
    
    @if($trend)
    <div class="stat-trend">
        <span class="trend-{{ $trend > 0 ? 'up' : 'down' }}">
            <i class="fas fa-arrow-{{ $trend > 0 ? 'up' : 'down' }}"></i>
            {{ abs($trend) }}%
        </span>
    </div>
    @endif
</div>

@push('styles')
<style>
.admin-stat-card {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-5);
    box-shadow: var(--shadow-md);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
}

.admin-stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-500) 0%, var(--primary-700) 100%);
}

.admin-stat-card:hover {
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

.trend-down {
    color: #ef4444;
    font-weight: 700;
    font-size: 0.875rem;
}
</style>
@endpush
