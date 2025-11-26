@extends('layouts.front-new')

@section('title', __('Shopping Cart') . ' - ' . $gs->title)

@section('content')

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ __('Shopping Cart') }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Cart Section -->
<section class="cart-section py-5">
    <div class="container">
        
        @if($cartItems && count($cartItems) > 0)
        <div class="row">
            
            <!-- Cart Items -->
            <div class="col-lg-8 mb-4">
                <div class="cart-items-wrapper">
                    <h3 class="mb-4">{{ __('Shopping Cart') }} ({{ count($cartItems) }} {{ __('items') }})</h3>
                    
                    <div class="cart-items">
                        @foreach($cartItems as $item)
                        <div class="cart-item" data-item-id="{{ $item->id }}">
                            <div class="row align-items-center">
                                
                                <!-- Product Image -->
                                <div class="col-md-2 col-3">
                                    <div class="item-image">
                                        <img src="{{ $item->product->photo ? asset('assets/images/products/' . $item->product->photo) : asset('assets/images/no-image.png') }}" 
                                             alt="{{ $item->product->name }}"
                                             class="img-fluid rounded">
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="col-md-4 col-9">
                                    <div class="item-info">
                                        <h6 class="item-name">
                                            <a href="{{ route('front.product', $item->product->slug) }}">
                                                {{ $item->product->name }}
                                            </a>
                                        </h6>
                                        <p class="item-meta text-muted mb-0">
                                            {{ __('SKU') }}: {{ $item->product->sku }}
                                        </p>
                                        @if($item->product->stock <= 5)
                                        <p class="text-warning mb-0">
                                            <small>{{ __('Only') }} {{ $item->product->stock }} {{ __('left in stock') }}</small>
                                        </p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Quantity -->
                                <div class="col-md-3 col-6">
                                    <div class="item-quantity">
                                        <div class="input-group">
                                            <button class="btn btn-outline-secondary btn-sm" 
                                                    type="button" 
                                                    onclick="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                            <input type="number" 
                                                   class="form-control form-control-sm text-center" 
                                                   value="{{ $item->quantity }}" 
                                                   min="1" 
                                                   max="{{ $item->product->stock }}"
                                                   id="quantity-{{ $item->id }}"
                                                   onchange="updateQuantity({{ $item->id }}, this.value)">
                                            <button class="btn btn-outline-secondary btn-sm" 
                                                    type="button" 
                                                    onclick="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})">
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price & Remove -->
                                <div class="col-md-3 col-6">
                                    <div class="item-price-remove">
                                        <p class="item-price mb-2">
                                            <strong>{{ $item->price * $item->quantity }} {{ $gs->currency }}</strong>
                                        </p>
                                        <button class="btn btn-sm btn-outline-danger" 
                                                onclick="removeItem({{ $item->id }})">
                                            <i class="fas fa-trash"></i> {{ __('Remove') }}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Cart Actions -->
                    <div class="cart-actions mt-4">
                        <a href="{{ route('front.products') }}" class="btn btn-outline-primary">
                            <i class="fas fa-arrow-left me-2"></i>
                            {{ __('Continue Shopping') }}
                        </a>
                        <button class="btn btn-outline-danger" onclick="clearCart()">
                            <i class="fas fa-trash me-2"></i>
                            {{ __('Clear Cart') }}
                        </button>
                    </div>

                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="cart-summary">
                    <h4 class="mb-4">{{ __('Order Summary') }}</h4>
                    
                    <div class="summary-item">
                        <span>{{ __('Subtotal') }}</span>
                        <strong id="subtotal">{{ $cartTotal['subtotal'] }} {{ $gs->currency }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>{{ __('Tax') }} ({{ $cartTotal['tax_rate'] }}%)</span>
                        <strong id="tax">{{ $cartTotal['tax'] }} {{ $gs->currency }}</strong>
                    </div>

                    <div class="summary-item">
                        <span>{{ __('Shipping') }}</span>
                        <strong id="shipping">{{ $cartTotal['shipping'] }} {{ $gs->currency }}</strong>
                    </div>

                    @if(isset($cartTotal['discount']) && $cartTotal['discount'] > 0)
                    <div class="summary-item text-success">
                        <span>{{ __('Discount') }}</span>
                        <strong id="discount">-{{ $cartTotal['discount'] }} {{ $gs->currency }}</strong>
                    </div>
                    @endif

                    <hr>

                    <div class="summary-total">
                        <span>{{ __('Total') }}</span>
                        <strong id="total">{{ $cartTotal['total'] }} {{ $gs->currency }}</strong>
                    </div>

                    <!-- Coupon Code -->
                    <div class="coupon-section mt-4">
                        <h6 class="mb-3">{{ __('Have a coupon code?') }}</h6>
                        <form id="couponForm">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" 
                                       name="coupon_code" 
                                       class="form-control" 
                                       placeholder="{{ __('Enter coupon code') }}"
                                       id="couponInput">
                                <button class="btn btn-outline-secondary" type="submit">
                                    {{ __('Apply') }}
                                </button>
                            </div>
                        </form>
                        <div id="couponMessage"></div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('front.checkout') }}" class="btn btn-primary btn-lg w-100 mt-4">
                        {{ __('Proceed to Checkout') }}
                        <i class="fas fa-arrow-right ms-2"></i>
                    </a>

                    <!-- Payment Methods -->
                    <div class="payment-methods mt-4">
                        <p class="text-muted text-center mb-2">
                            <small>{{ __('We accept') }}</small>
                        </p>
                        <div class="payment-icons text-center">
                            <i class="fab fa-cc-visa fa-2x me-2"></i>
                            <i class="fab fa-cc-mastercard fa-2x me-2"></i>
                            <i class="fab fa-cc-paypal fa-2x"></i>
                        </div>
                    </div>

                </div>
            </div>

        </div>
        @else
        <!-- Empty Cart -->
        <div class="empty-cart text-center py-5">
            <div class="empty-icon mb-4">
                <i class="fas fa-shopping-cart fa-5x text-muted"></i>
            </div>
            <h3>{{ __('Your cart is empty') }}</h3>
            <p class="text-muted mb-4">{{ __('Add some products to your cart and they will appear here') }}</p>
            <a href="{{ route('front.products') }}" class="btn btn-primary btn-lg">
                <i class="fas fa-shopping-bag me-2"></i>
                {{ __('Start Shopping') }}
            </a>
        </div>
        @endif

    </div>
</section>

<!-- Recently Viewed Products -->
@if(isset($recentlyViewed) && $recentlyViewed->count() > 0)
<section class="recently-viewed-section py-5 bg-light">
    <div class="container">
        <h3 class="section-title mb-4">{{ __('Recently Viewed') }}</h3>
        <div class="row g-4">
            @foreach($recentlyViewed->take(4) as $product)
            <div class="col-lg-3 col-md-6 col-sm-6">
                <x-product-card-new :product="$product" />
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@endsection

@push('styles')
<style>
/* Cart Items */
.cart-items-wrapper {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
}

.cart-item {
    background: var(--gray-50);
    border-radius: var(--radius-md);
    padding: var(--space-4);
    margin-bottom: var(--space-3);
    transition: all var(--transition-base);
}

.cart-item:hover {
    box-shadow: var(--shadow-md);
}

.item-image img {
    width: 100%;
    height: auto;
    border-radius: var(--radius-md);
}

.item-name a {
    color: var(--gray-900);
    text-decoration: none;
    font-weight: 600;
}

.item-name a:hover {
    color: var(--primary-500);
}

.item-meta {
    font-size: 0.875rem;
}

.item-quantity .input-group {
    max-width: 150px;
}

.item-price {
    font-size: 1.125rem;
    color: var(--primary-500);
}

/* Cart Summary */
.cart-summary {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-6);
    box-shadow: var(--shadow-sm);
    position: sticky;
    top: 100px;
}

.summary-item {
    display: flex;
    justify-content: space-between;
    padding: var(--space-3) 0;
    border-bottom: 1px solid var(--gray-200);
}

.summary-total {
    display: flex;
    justify-content: space-between;
    padding: var(--space-3) 0;
    font-size: 1.25rem;
}

.summary-total strong {
    color: var(--primary-500);
    font-size: 1.5rem;
}

/* Empty Cart */
.empty-cart {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: var(--space-8);
}

.empty-icon i {
    opacity: 0.3;
}

/* Cart Actions */
.cart-actions {
    display: flex;
    justify-content: space-between;
    gap: var(--space-3);
}

/* Responsive */
@media (max-width: 768px) {
    .cart-summary {
        position: static;
        margin-top: var(--space-4);
    }
    
    .cart-actions {
        flex-direction: column;
    }
    
    .item-price-remove {
        text-align: right;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Update quantity
function updateQuantity(itemId, quantity) {
    quantity = parseInt(quantity);
    
    if (quantity < 1) {
        removeItem(itemId);
        return;
    }
    
    fetch('/cart/update', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            item_id: itemId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    });
}

// Remove item
function removeItem(itemId) {
    if (!confirm('{{ __("Are you sure you want to remove this item?") }}')) {
        return;
    }
    
    fetch('/cart/remove', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            item_id: itemId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    });
}

// Clear cart
function clearCart() {
    if (!confirm('{{ __("Are you sure you want to clear your cart?") }}')) {
        return;
    }
    
    fetch('/cart/clear', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    });
}

// Apply coupon
document.getElementById('couponForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const couponCode = document.getElementById('couponInput').value;
    
    fetch('/cart/apply-coupon', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            coupon_code: couponCode
        })
    })
    .then(response => response.json())
    .then(data => {
        const messageDiv = document.getElementById('couponMessage');
        if (data.success) {
            messageDiv.innerHTML = '<div class="alert alert-success">' + data.message + '</div>';
            setTimeout(() => location.reload(), 1000);
        } else {
            messageDiv.innerHTML = '<div class="alert alert-danger">' + data.message + '</div>';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    });
});
</script>
@endpush
