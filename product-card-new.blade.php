{{--
    Product Card Component - NewStock Design System
    
    Props:
    - $product: Product model instance
    - $showBadge: boolean (optional, default: true)
    - $showQuickView: boolean (optional, default: true)
--}}

@props([
    'product',
    'showBadge' => true,
    'showQuickView' => true,
])

<div class="product-card-new">
    {{-- Product Image --}}
    <div class="product-image">
        @if($showBadge && $product->discount > 0)
            <span class="product-badge">
                -{{ $product->discount }}%
            </span>
        @endif

        @if($showBadge && $product->is_new)
            <span class="product-badge" style="background: var(--success-500); left: var(--space-3);">
                {{ __('New') }}
            </span>
        @endif

        <a href="{{ route('front.product', $product->slug) }}">
            <img 
                src="{{ $product->photo ? \Illuminate\Support\Facades\Storage::url($product->photo) : asset('assets/images/noimage.png') }}" 
                alt="{{ $product->name }}"
                loading="lazy"
                onerror="this.onerror=null; this.src='{{ asset('assets/images/noimage.png') }}';"
            >
        </a>

        {{-- Quick Actions --}}
        <div class="product-actions" style="position: absolute; bottom: var(--space-3); left: 50%; transform: translateX(-50%); opacity: 0; transition: opacity var(--transition-base); display: flex; gap: var(--space-2);">
            @if($showQuickView)
                <button 
                    class="btn-newstock btn-sm" 
                    style="background: var(--white); color: var(--gray-700); box-shadow: var(--shadow-md);"
                    onclick="quickView({{ $product->id }})"
                    title="{{ __('Quick View') }}"
                >
                    <i class="fas fa-eye"></i>
                </button>
            @endif

            <button 
                class="btn-newstock btn-sm" 
                style="background: var(--white); color: var(--gray-700); box-shadow: var(--shadow-md);"
                onclick="addToWishlist({{ $product->id }})"
                title="{{ __('Add to Wishlist') }}"
            >
                <i class="far fa-heart"></i>
            </button>

            <button 
                class="btn-newstock btn-sm" 
                style="background: var(--white); color: var(--gray-700); box-shadow: var(--shadow-md);"
                onclick="addToCompare({{ $product->id }})"
                title="{{ __('Add to Compare') }}"
            >
                <i class="fas fa-exchange-alt"></i>
            </button>
        </div>
    </div>

    {{-- Product Content --}}
    <div class="product-content">
        {{-- Category --}}
        @if($product->category)
            <div style="margin-bottom: var(--space-2);">
                <span class="badge-newstock badge-gray" style="font-size: var(--text-xs);">
                    {{ $product->category->name }}
                </span>
            </div>
        @endif

        {{-- Product Title --}}
        <h3 class="product-title">
            <a href="{{ route('front.product', $product->slug) }}" style="color: inherit; text-decoration: none;">
                {{ $product->name }}
            </a>
        </h3>

        {{-- Rating --}}
        @if($product->ratings_count > 0)
            <div style="display: flex; align-items: center; gap: var(--space-2); margin-bottom: var(--space-2);">
                <div class="rating-stars" style="color: var(--warning-500); font-size: var(--text-sm);">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($product->average_rating))
                            <i class="fas fa-star"></i>
                        @elseif($i - 0.5 <= $product->average_rating)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span style="font-size: var(--text-xs); color: var(--gray-500);">
                    ({{ $product->ratings_count }})
                </span>
            </div>
        @endif

        {{-- Stock Status --}}
        @if($product->stock > 0)
            <div style="margin-bottom: var(--space-3);">
                <span class="badge-newstock badge-success" style="font-size: var(--text-xs);">
                    <i class="fas fa-check-circle"></i> {{ __('In Stock') }}
                </span>
            </div>
        @else
            <div style="margin-bottom: var(--space-3);">
                <span class="badge-newstock badge-error" style="font-size: var(--text-xs);">
                    <i class="fas fa-times-circle"></i> {{ __('Out of Stock') }}
                </span>
            </div>
        @endif

        {{-- Price --}}
        <div class="product-price">
            @if($product->discount > 0)
                <span class="product-old-price">
                    {{ \App\Models\Product::convertPrice($product->price) }}
                </span>
                {{ \App\Models\Product::convertPrice($product->price - ($product->price * $product->discount / 100)) }}
            @else
                {{ \App\Models\Product::convertPrice($product->price) }}
            @endif
        </div>

        {{-- Add to Cart Button --}}
        <button 
            class="btn-newstock btn-primary-new w-full" 
            style="margin-top: var(--space-3);"
            onclick="addToCart({{ $product->id }})"
            {{ $product->stock <= 0 ? 'disabled' : '' }}
        >
            <i class="fas fa-shopping-cart"></i>
            {{ __('Add to Cart') }}
        </button>
    </div>
</div>

<style>
    .product-card-new:hover .product-actions {
        opacity: 1 !important;
    }
</style>

<script>
    function quickView(productId) {
        // Quick view functionality
        console.log('Quick view:', productId);
        // TODO: Implement quick view modal
    }

    function addToWishlist(productId) {
        // Add to wishlist functionality
        console.log('Add to wishlist:', productId);
        // TODO: Implement add to wishlist
    }

    function addToCompare(productId) {
        // Add to compare functionality
        console.log('Add to compare:', productId);
        // TODO: Implement add to compare
    }

    function addToCart(productId) {
        // Add to cart functionality
        console.log('Add to cart:', productId);
        // TODO: Implement add to cart
    }
</script>
