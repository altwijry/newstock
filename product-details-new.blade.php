@extends('layouts.front-new')

@section('title', $product->name . ' - ' . $gs->title)

@section('meta_description', strip_tags($product->details))

@section('content')

<!-- Breadcrumb -->
<section class="breadcrumb-section">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('front.index') }}">{{ __('Home') }}</a></li>
                <li class="breadcrumb-item"><a href="{{ route('front.products') }}">{{ __('Products') }}</a></li>
                @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('front.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
                @endif
                <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>
</section>

<!-- Product Details -->
<section class="product-details-section py-5">
    <div class="container">
        <div class="row">
            
            <!-- Product Images -->
            <div class="col-lg-6 mb-4">
                <div class="product-images">
                    <!-- Main Image -->
                    <div class="main-image mb-3">
                        <img src="{{ $product->photo ? asset('assets/images/products/' . $product->photo) : asset('assets/images/no-image.png') }}" 
                             alt="{{ $product->name }}"
                             class="img-fluid rounded"
                             id="mainProductImage">
                        
                        @if($product->previous_price && $product->previous_price > $product->price)
                        <span class="badge-sale">{{ __('Sale') }}</span>
                        @endif
                        
                        @if($product->featured)
                        <span class="badge-featured">{{ __('Featured') }}</span>
                        @endif
                    </div>
                    
                    <!-- Thumbnail Gallery -->
                    @if($product->galleries && count($product->galleries) > 0)
                    <div class="thumbnail-gallery">
                        <div class="row g-2">
                            <div class="col-3">
                                <img src="{{ asset('assets/images/products/' . $product->photo) }}" 
                                     alt="{{ $product->name }}"
                                     class="img-fluid rounded thumbnail-image active"
                                     onclick="changeMainImage(this.src)">
                            </div>
                            @foreach($product->galleries as $gallery)
                            <div class="col-3">
                                <img src="{{ asset('assets/images/galleries/' . $gallery->photo) }}" 
                                     alt="{{ $product->name }}"
                                     class="img-fluid rounded thumbnail-image"
                                     onclick="changeMainImage(this.src)">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-lg-6">
                <div class="product-info">
                    
                    <!-- Product Name -->
                    <h1 class="product-name">{{ $product->name }}</h1>
                    
                    <!-- Rating -->
                    <div class="product-rating mb-3">
                        <div class="stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <= floor($averageRating))
                                <i class="fas fa-star text-warning"></i>
                                @elseif($i == ceil($averageRating) && $averageRating - floor($averageRating) >= 0.5)
                                <i class="fas fa-star-half-alt text-warning"></i>
                                @else
                                <i class="far fa-star text-warning"></i>
                                @endif
                            @endfor
                            <span class="rating-text ms-2">
                                {{ number_format($averageRating, 1) }} 
                                ({{ $totalReviews }} {{ __('reviews') }})
                            </span>
                        </div>
                    </div>

                    <!-- Price -->
                    <div class="product-price mb-4">
                        @if($product->previous_price && $product->previous_price > $product->price)
                        <span class="price-old">{{ $product->previous_price }} {{ $gs->currency }}</span>
                        <span class="price-current">{{ $product->price }} {{ $gs->currency }}</span>
                        <span class="price-discount">
                            {{ __('Save') }} {{ round((($product->previous_price - $product->price) / $product->previous_price) * 100) }}%
                        </span>
                        @else
                        <span class="price-current">{{ $product->price }} {{ $gs->currency }}</span>
                        @endif
                    </div>

                    <!-- Short Description -->
                    <div class="product-short-description mb-4">
                        <p>{{ Str::limit(strip_tags($product->details), 200) }}</p>
                    </div>

                    <!-- Product Meta -->
                    <div class="product-meta mb-4">
                        <ul class="list-unstyled">
                            @if($product->sku)
                            <li><strong>{{ __('SKU') }}:</strong> {{ $product->sku }}</li>
                            @endif
                            @if($product->category)
                            <li><strong>{{ __('Category') }}:</strong> 
                                <a href="{{ route('front.category', $product->category->slug) }}">{{ $product->category->name }}</a>
                            </li>
                            @endif
                            @if($product->brand)
                            <li><strong>{{ __('Brand') }}:</strong> 
                                <a href="{{ route('front.brand', $product->brand->slug) }}">{{ $product->brand->name }}</a>
                            </li>
                            @endif
                            <li><strong>{{ __('Availability') }}:</strong> 
                                @if($product->stock > 0)
                                <span class="text-success">{{ __('In Stock') }} ({{ $product->stock }})</span>
                                @else
                                <span class="text-danger">{{ __('Out of Stock') }}</span>
                                @endif
                            </li>
                        </ul>
                    </div>

                    <!-- Add to Cart Form -->
                    <form id="addToCartForm" class="mb-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        
                        <div class="quantity-selector mb-3">
                            <label class="form-label">{{ __('Quantity') }}</label>
                            <div class="input-group" style="max-width: 150px;">
                                <button class="btn btn-outline-secondary" type="button" onclick="decreaseQuantity()">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <input type="number" 
                                       name="quantity" 
                                       class="form-control text-center" 
                                       value="1" 
                                       min="1" 
                                       max="{{ $product->stock }}"
                                       id="quantityInput">
                                <button class="btn btn-outline-secondary" type="button" onclick="increaseQuantity()">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>

                        <div class="product-actions">
                            <button type="submit" class="btn btn-primary btn-lg me-2" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                <i class="fas fa-shopping-cart me-2"></i>
                                {{ __('Add to Cart') }}
                            </button>
                            <button type="button" class="btn btn-outline-danger btn-lg" onclick="addToWishlist({{ $product->id }})">
                                <i class="far fa-heart"></i>
                            </button>
                        </div>
                    </form>

                    <!-- Social Share -->
                    <div class="product-share">
                        <p class="mb-2"><strong>{{ __('Share') }}:</strong></p>
                        <div class="share-buttons">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-primary">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ $product->name }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-info">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ $product->name }} {{ url()->current() }}" 
                               target="_blank" 
                               class="btn btn-sm btn-outline-success">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <!-- Product Details Tabs -->
        <div class="product-tabs mt-5">
            <ul class="nav nav-tabs" id="productTabs" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" 
                            id="description-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#description" 
                            type="button">
                        {{ __('Description') }}
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" 
                            id="reviews-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#reviews" 
                            type="button">
                        {{ __('Reviews') }} ({{ $totalReviews }})
                    </button>
                </li>
            </ul>
            <div class="tab-content p-4 bg-white rounded-bottom" id="productTabsContent">
                
                <!-- Description Tab -->
                <div class="tab-pane fade show active" id="description" role="tabpanel">
                    <div class="product-description">
                        {!! $product->details !!}
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div class="tab-pane fade" id="reviews" role="tabpanel">
                    
                    <!-- Reviews List -->
                    @if($product->ratings && $product->ratings->count() > 0)
                    <div class="reviews-list mb-4">
                        @foreach($product->ratings as $rating)
                        <div class="review-item mb-3 pb-3 border-bottom">
                            <div class="review-header d-flex justify-content-between mb-2">
                                <div>
                                    <strong>{{ $rating->user->name ?? __('Anonymous') }}</strong>
                                    <div class="stars">
                                        @for($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $rating->rating ? 'text-warning' : 'text-muted' }}"></i>
                                        @endfor
                                    </div>
                                </div>
                                <small class="text-muted">{{ $rating->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="review-text mb-0">{{ $rating->review }}</p>
                        </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-muted">{{ __('No reviews yet') }}</p>
                    @endif

                    <!-- Add Review Form -->
                    @auth
                    <div class="add-review-form">
                        <h5 class="mb-3">{{ __('Write a Review') }}</h5>
                        <form id="reviewForm">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            
                            <div class="mb-3">
                                <label class="form-label">{{ __('Rating') }}</label>
                                <div class="rating-input">
                                    <input type="radio" name="rating" value="5" id="star5">
                                    <label for="star5"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="rating" value="4" id="star4">
                                    <label for="star4"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="rating" value="3" id="star3">
                                    <label for="star3"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="rating" value="2" id="star2">
                                    <label for="star2"><i class="fas fa-star"></i></label>
                                    <input type="radio" name="rating" value="1" id="star1">
                                    <label for="star1"><i class="fas fa-star"></i></label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">{{ __('Review') }}</label>
                                <textarea name="review" 
                                          class="form-control" 
                                          rows="4" 
                                          required
                                          placeholder="{{ __('Share your experience with this product...') }}"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary">
                                {{ __('Submit Review') }}
                            </button>
                        </form>
                    </div>
                    @else
                    <p class="text-muted">
                        <a href="{{ route('user.login') }}">{{ __('Login') }}</a> {{ __('to write a review') }}
                    </p>
                    @endauth

                </div>

            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts && $relatedProducts->count() > 0)
        <div class="related-products mt-5">
            <h3 class="section-title mb-4">{{ __('Related Products') }}</h3>
            <div class="row g-4">
                @foreach($relatedProducts->take(4) as $relatedProduct)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <x-product-card-new :product="$relatedProduct" />
                </div>
                @endforeach
            </div>
        </div>
        @endif

    </div>
</section>

@endsection

@push('styles')
<style>
/* Product Images */
.product-images {
    position: relative;
}

.main-image {
    position: relative;
    overflow: hidden;
    border-radius: var(--radius-lg);
}

.main-image img {
    width: 100%;
    height: auto;
    transition: transform var(--transition-base);
}

.main-image:hover img {
    transform: scale(1.05);
}

.badge-sale,
.badge-featured {
    position: absolute;
    top: var(--space-3);
    right: var(--space-3);
    background: var(--error-500);
    color: var(--white);
    padding: var(--space-2) var(--space-3);
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 600;
    z-index: 10;
}

.badge-featured {
    top: calc(var(--space-3) + 40px);
    background: var(--warning-500);
}

.thumbnail-image {
    cursor: pointer;
    border: 2px solid transparent;
    transition: all var(--transition-base);
}

.thumbnail-image:hover,
.thumbnail-image.active {
    border-color: var(--primary-500);
}

/* Product Info */
.product-name {
    font-size: 2rem;
    font-weight: 700;
    color: var(--gray-900);
    margin-bottom: var(--space-3);
}

.product-rating .stars i {
    font-size: 1.125rem;
}

.rating-text {
    color: var(--gray-600);
    font-size: 0.875rem;
}

.product-price {
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.price-old {
    font-size: 1.25rem;
    color: var(--gray-500);
    text-decoration: line-through;
}

.price-current {
    font-size: 2rem;
    font-weight: 700;
    color: var(--primary-500);
}

.price-discount {
    background: var(--error-100);
    color: var(--error-700);
    padding: var(--space-1) var(--space-2);
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 600;
}

.product-meta ul li {
    padding: var(--space-2) 0;
    border-bottom: 1px solid var(--gray-200);
}

.product-meta ul li:last-child {
    border-bottom: none;
}

/* Rating Input */
.rating-input {
    display: flex;
    flex-direction: row-reverse;
    justify-content: flex-end;
    gap: var(--space-1);
}

.rating-input input {
    display: none;
}

.rating-input label {
    cursor: pointer;
    font-size: 1.5rem;
    color: var(--gray-300);
    transition: color var(--transition-base);
}

.rating-input label:hover,
.rating-input label:hover ~ label,
.rating-input input:checked ~ label {
    color: var(--warning-500);
}

/* Responsive */
@media (max-width: 768px) {
    .product-name {
        font-size: 1.5rem;
    }
    
    .price-current {
        font-size: 1.5rem;
    }
}
</style>
@endpush

@push('scripts')
<script>
// Change main image
function changeMainImage(src) {
    document.getElementById('mainProductImage').src = src;
    
    // Update active thumbnail
    document.querySelectorAll('.thumbnail-image').forEach(img => {
        img.classList.remove('active');
        if (img.src === src) {
            img.classList.add('active');
        }
    });
}

// Quantity controls
function increaseQuantity() {
    const input = document.getElementById('quantityInput');
    const max = parseInt(input.max);
    const current = parseInt(input.value);
    if (current < max) {
        input.value = current + 1;
    }
}

function decreaseQuantity() {
    const input = document.getElementById('quantityInput');
    const current = parseInt(input.value);
    if (current > 1) {
        input.value = current - 1;
    }
}

// Add to cart
document.getElementById('addToCartForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/cart/add', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert(data.message);
            // Update cart count if exists
            if (document.getElementById('cartCount')) {
                document.getElementById('cartCount').textContent = data.cart_count;
            }
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    });
});

// Submit review
@auth
document.getElementById('reviewForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    
    fetch('/product/{{ $product->id }}/review', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    });
});
@endauth

// Add to wishlist
function addToWishlist(productId) {
    @guest
    alert('{{ __("Please login to add to wishlist") }}');
    window.location.href = '{{ route("user.login") }}';
    return;
    @endguest
    
    fetch('/wishlist/add', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ product_id: productId })
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => {
        console.error('Error:', error);
        alert('{{ __("An error occurred") }}');
    });
}
</script>
@endpush
