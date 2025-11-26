@extends('layouts.front-new')

@section('title', __('Login / Register') . ' - ' . $gs->title)

@section('content')

{{-- Page Header --}}
<div class="page-header bg-gradient-to-r from-primary-600 to-primary-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ __('My Account') }}</h1>
                <p class="text-primary-100">{{ __('Login or create a new account') }}</p>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <i class="fas fa-user-circle text-5xl opacity-20"></i>
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
            <span class="text-primary-600 font-medium">{{ __('Login / Register') }}</span>
        </nav>
    </div>
</div>

{{-- Main Content --}}
<div class="container mx-auto px-4 py-12">
    <div class="max-w-5xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            
            {{-- Login Section --}}
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-sign-in-alt text-2xl text-primary-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ __('Login') }}</h2>
                    <p class="text-gray-600 mt-2">{{ __('Welcome back! Please login to your account') }}</p>
                </div>
                
                <form action="{{ route('user.login.submit') }}" method="POST">
                    @csrf
                    
                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>
                            {{ __('Email Address') }}
                        </label>
                        <input type="email" name="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                               placeholder="{{ __('Enter your email') }}"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-2"></i>
                            {{ __('Password') }}
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="login-password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                   placeholder="{{ __('Enter your password') }}"
                                   required>
                            <button type="button" onclick="togglePassword('login-password', 'login-eye')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="login-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Remember Me & Forgot Password --}}
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="remember" class="w-4 h-4 text-primary-600 rounded">
                            <span class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</span>
                        </label>
                        <a href="{{ route('user.forgot') }}" class="text-sm text-primary-600 hover:underline">
                            {{ __('Forgot Password?') }}
                        </a>
                    </div>
                    
                    {{-- Login Button --}}
                    <button type="submit" 
                            class="w-full bg-primary-600 hover:bg-primary-700 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center space-x-2">
                        <i class="fas fa-sign-in-alt"></i>
                        <span>{{ __('Login') }}</span>
                    </button>
                </form>
                
                {{-- Social Login --}}
                <div class="mt-6">
                    <div class="relative">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-300"></div>
                        </div>
                        <div class="relative flex justify-center text-sm">
                            <span class="px-2 bg-white text-gray-500">{{ __('Or login with') }}</span>
                        </div>
                    </div>
                    
                    <div class="mt-4 grid grid-cols-2 gap-3">
                        <a href="{{ route('social.login', 'google') }}" 
                           class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fab fa-google text-red-500 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700">Google</span>
                        </a>
                        <a href="{{ route('social.login', 'facebook') }}" 
                           class="flex items-center justify-center px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">
                            <i class="fab fa-facebook text-blue-600 mr-2"></i>
                            <span class="text-sm font-medium text-gray-700">Facebook</span>
                        </a>
                    </div>
                </div>
            </div>
            
            {{-- Register Section --}}
            <div class="bg-white rounded-lg shadow-lg p-8">
                <div class="text-center mb-6">
                    <div class="w-16 h-16 bg-accent-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-user-plus text-2xl text-accent-600"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">{{ __('Register') }}</h2>
                    <p class="text-gray-600 mt-2">{{ __('Create a new account to get started') }}</p>
                </div>
                
                <form action="{{ route('user.register.submit') }}" method="POST">
                    @csrf
                    
                    {{-- Name --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-user text-gray-400 mr-2"></i>
                            {{ __('Full Name') }}
                        </label>
                        <input type="text" name="name" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                               placeholder="{{ __('Enter your full name') }}"
                               value="{{ old('name') }}"
                               required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-envelope text-gray-400 mr-2"></i>
                            {{ __('Email Address') }}
                        </label>
                        <input type="email" name="email" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                               placeholder="{{ __('Enter your email') }}"
                               value="{{ old('email') }}"
                               required>
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Phone --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-phone text-gray-400 mr-2"></i>
                            {{ __('Phone Number') }}
                        </label>
                        <input type="tel" name="phone" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                               placeholder="{{ __('Enter your phone number') }}"
                               value="{{ old('phone') }}">
                        @error('phone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-2"></i>
                            {{ __('Password') }}
                        </label>
                        <div class="relative">
                            <input type="password" name="password" id="register-password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                                   placeholder="{{ __('Enter your password') }}"
                                   required>
                            <button type="button" onclick="togglePassword('register-password', 'register-eye')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="register-eye"></i>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-1">{{ __('Minimum 8 characters') }}</p>
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    {{-- Confirm Password --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <i class="fas fa-lock text-gray-400 mr-2"></i>
                            {{ __('Confirm Password') }}
                        </label>
                        <div class="relative">
                            <input type="password" name="password_confirmation" id="confirm-password"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-accent-500 focus:border-accent-500"
                                   placeholder="{{ __('Confirm your password') }}"
                                   required>
                            <button type="button" onclick="togglePassword('confirm-password', 'confirm-eye')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                                <i class="fas fa-eye" id="confirm-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    {{-- Terms & Conditions --}}
                    <div class="mb-6">
                        <label class="flex items-start cursor-pointer">
                            <input type="checkbox" name="terms" class="w-4 h-4 text-accent-600 mt-1" required>
                            <span class="ml-2 text-sm text-gray-700">
                                {{ __('I agree to the') }}
                                <a href="{{ route('front.page', 'terms') }}" target="_blank" class="text-accent-600 hover:underline">
                                    {{ __('Terms & Conditions') }}
                                </a>
                                {{ __('and') }}
                                <a href="{{ route('front.page', 'privacy') }}" target="_blank" class="text-accent-600 hover:underline">
                                    {{ __('Privacy Policy') }}
                                </a>
                            </span>
                        </label>
                    </div>
                    
                    {{-- Register Button --}}
                    <button type="submit" 
                            class="w-full bg-accent-600 hover:bg-accent-700 text-white font-bold py-3 px-6 rounded-lg transition-colors flex items-center justify-center space-x-2">
                        <i class="fas fa-user-plus"></i>
                        <span>{{ __('Create Account') }}</span>
                    </button>
                </form>
            </div>
            
        </div>
        
        {{-- Benefits Section --}}
        <div class="mt-12 bg-gradient-to-r from-primary-50 to-accent-50 rounded-lg p-8">
            <h3 class="text-2xl font-bold text-gray-900 text-center mb-8">
                {{ __('Why Create an Account?') }}
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-shipping-fast text-2xl text-primary-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ __('Fast Checkout') }}</h4>
                    <p class="text-sm text-gray-600">{{ __('Save your information for faster checkout') }}</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-history text-2xl text-primary-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ __('Order History') }}</h4>
                    <p class="text-sm text-gray-600">{{ __('Track all your orders in one place') }}</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-heart text-2xl text-primary-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ __('Wishlist') }}</h4>
                    <p class="text-sm text-gray-600">{{ __('Save your favorite products') }}</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center mx-auto mb-4 shadow-md">
                        <i class="fas fa-gift text-2xl text-primary-600"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ __('Exclusive Offers') }}</h4>
                    <p class="text-sm text-gray-600">{{ __('Get special discounts and offers') }}</p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Password strength indicator
document.addEventListener('DOMContentLoaded', function() {
    const registerPassword = document.getElementById('register-password');
    if (registerPassword) {
        registerPassword.addEventListener('input', function() {
            const password = this.value;
            const strength = getPasswordStrength(password);
            // You can add visual feedback here
        });
    }
});

function getPasswordStrength(password) {
    let strength = 0;
    if (password.length >= 8) strength++;
    if (password.match(/[a-z]/)) strength++;
    if (password.match(/[A-Z]/)) strength++;
    if (password.match(/[0-9]/)) strength++;
    if (password.match(/[^a-zA-Z0-9]/)) strength++;
    return strength;
}
</script>
@endsection
