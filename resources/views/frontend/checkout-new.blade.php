@extends('layouts.front-new')

@section('title', __('Checkout') . ' - ' . $gs->title)

@section('content')

{{-- Page Header --}}
<div class="page-header bg-gradient-to-r from-primary-600 to-primary-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ __('Checkout') }}</h1>
                <p class="text-primary-100">{{ __('Complete your order') }}</p>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <i class="fas fa-shopping-cart text-5xl opacity-20"></i>
            </div>
        </div>
    </div>
</div>

{{-- Breadcrumb --}}
<div class="bg-gray-50 border-b">
    <div class="container mx-auto px-4 py-3">
        <nav class="flex items-center space-x-2 text-sm">
            <a href="{{ route('front.index') }}" class="text-gray-600 hover:text-primary-600">
                <i class="fas fa-home"></i> {{ __('Home') }}
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <a href="{{ route('front.cart') }}" class="text-gray-600 hover:text-primary-600">
                {{ __('Cart') }}
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="text-primary-600 font-medium">{{ __('Checkout') }}</span>
        </nav>
    </div>
</div>

{{-- Main Content --}}
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- Left Column - Checkout Form --}}
        <div class="lg:col-span-2">
            
            {{-- Progress Steps --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between">
                    {{-- Step 1: Shipping --}}
                    <div class="flex-1 text-center">
                        <div class="relative">
                            <div class="w-10 h-10 mx-auto bg-primary-600 text-white rounded-full flex items-center justify-center font-bold">
                                1
                            </div>
                            <p class="text-sm font-medium text-gray-900 mt-2">{{ __('Shipping') }}</p>
                        </div>
                    </div>
                    
                    {{-- Connector --}}
                    <div class="flex-1 h-1 bg-gray-300 -mx-4"></div>
                    
                    {{-- Step 2: Payment --}}
                    <div class="flex-1 text-center">
                        <div class="relative">
                            <div class="w-10 h-10 mx-auto bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                                2
                            </div>
                            <p class="text-sm font-medium text-gray-500 mt-2">{{ __('Payment') }}</p>
                        </div>
                    </div>
                    
                    {{-- Connector --}}
                    <div class="flex-1 h-1 bg-gray-300 -mx-4"></div>
                    
                    {{-- Step 3: Review --}}
                    <div class="flex-1 text-center">
                        <div class="relative">
                            <div class="w-10 h-10 mx-auto bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                                3
                            </div>
                            <p class="text-sm font-medium text-gray-500 mt-2">{{ __('Review') }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('front.checkout.submit') }}" method="POST" id="checkout-form">
                @csrf
                
                {{-- Shipping Information --}}
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-xl font-bold text-gray-900">
                            <i class="fas fa-shipping-fast text-primary-600 mr-2"></i>
                            {{ __('Shipping Information') }}
                        </h2>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- First Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('First Name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="first_name" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   value="{{ auth()->check() ? auth()->user()->first_name : old('first_name') }}"
                                   required>
                            @error('first_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Last Name --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Last Name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="last_name" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   value="{{ auth()->check() ? auth()->user()->last_name : old('last_name') }}"
                                   required>
                            @error('last_name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Email') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="email" name="email" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   value="{{ auth()->check() ? auth()->user()->email : old('email') }}"
                                   required>
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Phone --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Phone') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="phone" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   value="{{ auth()->check() ? auth()->user()->phone : old('phone') }}"
                                   required>
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Address --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Address') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="address" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   value="{{ old('address') }}"
                                   required>
                            @error('address')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Country --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Country') }} <span class="text-red-500">*</span>
                            </label>
                            <select name="country" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    required>
                                <option value="">{{ __('Select Country') }}</option>
                                <option value="SA">{{ __('Saudi Arabia') }}</option>
                                <option value="AE">{{ __('United Arab Emirates') }}</option>
                                <option value="KW">{{ __('Kuwait') }}</option>
                                <option value="QA">{{ __('Qatar') }}</option>
                                <option value="BH">{{ __('Bahrain') }}</option>
                                <option value="OM">{{ __('Oman') }}</option>
                            </select>
                            @error('country')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- City --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('City') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="city" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   value="{{ old('city') }}"
                                   required>
                            @error('city')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        {{-- Zip Code --}}
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Zip Code') }}
                            </label>
                            <input type="text" name="zip" 
                                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   value="{{ old('zip') }}">
                        </div>
                        
                        {{-- Order Notes --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                {{ __('Order Notes') }} ({{ __('Optional') }})
                            </label>
                            <textarea name="order_notes" rows="3"
                                      class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                      placeholder="{{ __('Notes about your order, e.g. special notes for delivery') }}">{{ old('order_notes') }}</textarea>
                        </div>
                    </div>
                </div>
                
                {{-- Payment Method --}}
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-4">
                        <i class="fas fa-credit-card text-primary-600 mr-2"></i>
                        {{ __('Payment Method') }}
                    </h2>
                    
                    <div class="space-y-3">
                        {{-- Cash on Delivery --}}
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-500 transition-colors">
                            <input type="radio" name="payment_method" value="cod" class="w-5 h-5 text-primary-600" checked>
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-900">{{ __('Cash on Delivery') }}</span>
                                    <i class="fas fa-money-bill-wave text-2xl text-gray-400"></i>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Pay with cash upon delivery') }}</p>
                            </div>
                        </label>
                        
                        {{-- PayPal --}}
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-500 transition-colors">
                            <input type="radio" name="payment_method" value="paypal" class="w-5 h-5 text-primary-600">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-900">{{ __('PayPal') }}</span>
                                    <i class="fab fa-paypal text-2xl text-blue-600"></i>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Pay securely with PayPal') }}</p>
                            </div>
                        </label>
                        
                        {{-- Stripe --}}
                        <label class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-primary-500 transition-colors">
                            <input type="radio" name="payment_method" value="stripe" class="w-5 h-5 text-primary-600">
                            <div class="ml-4 flex-1">
                                <div class="flex items-center justify-between">
                                    <span class="font-medium text-gray-900">{{ __('Credit Card') }}</span>
                                    <i class="fab fa-cc-stripe text-2xl text-purple-600"></i>
                                </div>
                                <p class="text-sm text-gray-500 mt-1">{{ __('Pay with Visa, Mastercard, or Amex') }}</p>
                            </div>
                        </label>
                    </div>
                </div>
                
                {{-- Terms & Conditions --}}
                <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
                    <label class="flex items-start cursor-pointer">
                        <input type="checkbox" name="terms" class="w-5 h-5 text-primary-600 mt-1" required>
                        <span class="ml-3 text-gray-700">
                            {{ __('I have read and agree to the') }}
                            <a href="{{ route('front.page', 'terms') }}" target="_blank" class="text-primary-600 hover:underline">
                                {{ __('Terms & Conditions') }}
                            </a>
                            {{ __('and') }}
                            <a href="{{ route('front.page', 'privacy') }}" target="_blank" class="text-primary-600 hover:underline">
                                {{ __('Privacy Policy') }}
                            </a>
                        </span>
                    </label>
                </div>
                
            </form>
        </div>
        
        {{-- Right Column - Order Summary --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                <h2 class="text-xl font-bold text-gray-900 mb-4">
                    <i class="fas fa-receipt text-primary-600 mr-2"></i>
                    {{ __('Order Summary') }}
                </h2>
                
                {{-- Cart Items --}}
                <div class="space-y-4 mb-6 max-h-64 overflow-y-auto">
                    @php
                        $cart = Session::get('cart', []);
                        $subtotal = 0;
                    @endphp
                    
                    @forelse($cart as $item)
                        @php
                            $product = App\Models\Product::find($item['item']['id']);
                            $price = $product->sale_price ?? $product->price;
                            $itemTotal = $price * $item['qty'];
                            $subtotal += $itemTotal;
                        @endphp
                        
                        <div class="flex items-center space-x-3 pb-4 border-b">
                            <img src="{{ asset('assets/images/products/' . $product->photo) }}" 
                                 alt="{{ $product->name }}"
                                 class="w-16 h-16 object-cover rounded">
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500">{{ __('Qty') }}: {{ $item['qty'] }}</p>
                            </div>
                            <p class="text-sm font-bold text-gray-900">
                                {{ $gs->currency_sign }}{{ number_format($itemTotal, 2) }}
                            </p>
                        </div>
                    @empty
                        <div class="text-center py-8">
                            <i class="fas fa-shopping-cart text-4xl text-gray-300 mb-2"></i>
                            <p class="text-gray-500">{{ __('Your cart is empty') }}</p>
                        </div>
                    @endforelse
                </div>
                
                @if(count($cart) > 0)
                    {{-- Pricing Summary --}}
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>{{ __('Subtotal') }}</span>
                            <span class="font-medium">{{ $gs->currency_sign }}{{ number_format($subtotal, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between text-gray-700">
                            <span>{{ __('Shipping') }}</span>
                            <span class="font-medium">{{ $gs->currency_sign }}{{ number_format(10, 2) }}</span>
                        </div>
                        
                        <div class="flex justify-between text-gray-700">
                            <span>{{ __('Tax') }} ({{ $gs->tax }}%)</span>
                            <span class="font-medium">{{ $gs->currency_sign }}{{ number_format($subtotal * $gs->tax / 100, 2) }}</span>
                        </div>
                        
                        <div class="border-t pt-3">
                            <div class="flex justify-between text-lg font-bold text-gray-900">
                                <span>{{ __('Total') }}</span>
                                <span class="text-primary-600">
                                    {{ $gs->currency_sign }}{{ number_format($subtotal + 10 + ($subtotal * $gs->tax / 100), 2) }}
                                </span>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Place Order Button --}}
                    <button type="submit" form="checkout-form"
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center space-x-2">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ __('Place Order') }}</span>
                    </button>
                    
                    {{-- Security Badge --}}
                    <div class="mt-4 text-center">
                        <div class="flex items-center justify-center space-x-2 text-sm text-gray-500">
                            <i class="fas fa-lock"></i>
                            <span>{{ __('Secure Checkout') }}</span>
                        </div>
                        <div class="flex items-center justify-center space-x-3 mt-2">
                            <i class="fab fa-cc-visa text-2xl text-gray-400"></i>
                            <i class="fab fa-cc-mastercard text-2xl text-gray-400"></i>
                            <i class="fab fa-cc-paypal text-2xl text-gray-400"></i>
                            <i class="fab fa-cc-amex text-2xl text-gray-400"></i>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        
    </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.getElementById('checkout-form');
    const termsCheckbox = document.querySelector('input[name="terms"]');
    
    form.addEventListener('submit', function(e) {
        if (!termsCheckbox.checked) {
            e.preventDefault();
            alert('{{ __("Please accept the terms and conditions") }}');
            return false;
        }
    });
    
    // Payment method selection
    const paymentRadios = document.querySelectorAll('input[name="payment_method"]');
    paymentRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            // Remove active class from all labels
            document.querySelectorAll('input[name="payment_method"]').forEach(r => {
                r.closest('label').classList.remove('border-primary-500', 'bg-primary-50');
            });
            // Add active class to selected label
            this.closest('label').classList.add('border-primary-500', 'bg-primary-50');
        });
    });
    
    // Set initial active payment method
    const checkedRadio = document.querySelector('input[name="payment_method"]:checked');
    if (checkedRadio) {
        checkedRadio.closest('label').classList.add('border-primary-500', 'bg-primary-50');
    }
});
</script>
@endsection
