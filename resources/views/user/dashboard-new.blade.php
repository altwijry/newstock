@extends('layouts.front-new')

@section('title', __('My Dashboard') . ' - ' . $gs->title)

@section('content')

{{-- Page Header --}}
<div class="page-header bg-gradient-to-r from-primary-600 to-primary-800 text-white py-12">
    <div class="container mx-auto px-4">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold mb-2">{{ __('My Dashboard') }}</h1>
                <p class="text-primary-100">{{ __('Welcome back') }}, {{ auth()->user()->name }}!</p>
            </div>
            <div class="hidden md:flex items-center space-x-4">
                <i class="fas fa-tachometer-alt text-5xl opacity-20"></i>
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
            <span class="text-primary-600 font-medium">{{ __('Dashboard') }}</span>
        </nav>
    </div>
</div>

{{-- Main Content --}}
<div class="container mx-auto px-4 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        
        {{-- Sidebar --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-sm p-6 sticky top-4">
                {{-- User Info --}}
                <div class="text-center mb-6 pb-6 border-b">
                    <div class="w-20 h-20 bg-primary-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        @if(auth()->user()->photo)
                            <img src="{{ asset('assets/images/users/' . auth()->user()->photo) }}" 
                                 alt="{{ auth()->user()->name }}"
                                 class="w-20 h-20 rounded-full object-cover">
                        @else
                            <i class="fas fa-user text-3xl text-primary-600"></i>
                        @endif
                    </div>
                    <h3 class="font-bold text-gray-900">{{ auth()->user()->name }}</h3>
                    <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
                </div>
                
                {{-- Navigation Menu --}}
                <nav class="space-y-2">
                    <a href="{{ route('user.dashboard') }}" 
                       class="flex items-center space-x-3 px-4 py-3 bg-primary-50 text-primary-600 rounded-lg font-medium">
                        <i class="fas fa-tachometer-alt w-5"></i>
                        <span>{{ __('Dashboard') }}</span>
                    </a>
                    
                    <a href="{{ route('user.orders') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-shopping-bag w-5"></i>
                        <span>{{ __('My Orders') }}</span>
                    </a>
                    
                    <a href="{{ route('user.wishlist') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-heart w-5"></i>
                        <span>{{ __('Wishlist') }}</span>
                    </a>
                    
                    <a href="{{ route('user.addresses') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-map-marker-alt w-5"></i>
                        <span>{{ __('Addresses') }}</span>
                    </a>
                    
                    <a href="{{ route('user.profile') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-user-edit w-5"></i>
                        <span>{{ __('Profile Settings') }}</span>
                    </a>
                    
                    <a href="{{ route('user.password') }}" 
                       class="flex items-center space-x-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-lock w-5"></i>
                        <span>{{ __('Change Password') }}</span>
                    </a>
                    
                    <form action="{{ route('user.logout') }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="w-full flex items-center space-x-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-lg">
                            <i class="fas fa-sign-out-alt w-5"></i>
                            <span>{{ __('Logout') }}</span>
                        </button>
                    </form>
                </nav>
            </div>
        </div>
        
        {{-- Main Content --}}
        <div class="lg:col-span-3">
            
            {{-- Stats Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                {{-- Total Orders --}}
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">{{ __('Total Orders') }}</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $totalOrders ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-shopping-bag text-xl text-primary-600"></i>
                        </div>
                    </div>
                </div>
                
                {{-- Pending Orders --}}
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">{{ __('Pending Orders') }}</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $pendingOrders ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-warning-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-xl text-warning-600"></i>
                        </div>
                    </div>
                </div>
                
                {{-- Wishlist Items --}}
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">{{ __('Wishlist Items') }}</p>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $wishlistCount ?? 0 }}</h3>
                        </div>
                        <div class="w-12 h-12 bg-accent-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-heart text-xl text-accent-600"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Recent Orders --}}
            <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-bold text-gray-900">
                        <i class="fas fa-shopping-bag text-primary-600 mr-2"></i>
                        {{ __('Recent Orders') }}
                    </h2>
                    <a href="{{ route('user.orders') }}" class="text-primary-600 hover:underline text-sm font-medium">
                        {{ __('View All') }} <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>
                
                @if(isset($recentOrders) && count($recentOrders) > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">{{ __('Order ID') }}</th>
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">{{ __('Date') }}</th>
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">{{ __('Status') }}</th>
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">{{ __('Total') }}</th>
                                    <th class="text-left py-3 px-4 text-sm font-medium text-gray-600">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr class="border-b hover:bg-gray-50">
                                    <td class="py-4 px-4">
                                        <span class="font-medium text-gray-900">#{{ $order->order_number }}</span>
                                    </td>
                                    <td class="py-4 px-4 text-gray-600">
                                        {{ $order->created_at->format('d M, Y') }}
                                    </td>
                                    <td class="py-4 px-4">
                                        @if($order->status == 'pending')
                                            <span class="px-3 py-1 bg-warning-100 text-warning-700 text-xs font-medium rounded-full">
                                                {{ __('Pending') }}
                                            </span>
                                        @elseif($order->status == 'processing')
                                            <span class="px-3 py-1 bg-info-100 text-info-700 text-xs font-medium rounded-full">
                                                {{ __('Processing') }}
                                            </span>
                                        @elseif($order->status == 'completed')
                                            <span class="px-3 py-1 bg-success-100 text-success-700 text-xs font-medium rounded-full">
                                                {{ __('Completed') }}
                                            </span>
                                        @else
                                            <span class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-4 px-4 font-bold text-gray-900">
                                        {{ $gs->currency_sign }}{{ number_format($order->total, 2) }}
                                    </td>
                                    <td class="py-4 px-4">
                                        <a href="{{ route('user.order', $order->id) }}" 
                                           class="text-primary-600 hover:underline text-sm font-medium">
                                            {{ __('View') }}
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12">
                        <i class="fas fa-shopping-bag text-5xl text-gray-300 mb-4"></i>
                        <p class="text-gray-500 mb-4">{{ __('No orders yet') }}</p>
                        <a href="{{ route('front.products') }}" 
                           class="inline-flex items-center space-x-2 bg-primary-600 hover:bg-primary-700 text-white px-6 py-3 rounded-lg transition-colors">
                            <i class="fas fa-shopping-cart"></i>
                            <span>{{ __('Start Shopping') }}</span>
                        </a>
                    </div>
                @endif
            </div>
            
            {{-- Quick Actions --}}
            <div class="bg-white rounded-lg shadow-sm p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">
                    <i class="fas fa-bolt text-primary-600 mr-2"></i>
                    {{ __('Quick Actions') }}
                </h2>
                
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <a href="{{ route('user.orders') }}" 
                       class="flex flex-col items-center justify-center p-6 border-2 border-gray-200 rounded-lg hover:border-primary-500 hover:bg-primary-50 transition-colors">
                        <i class="fas fa-shopping-bag text-3xl text-primary-600 mb-3"></i>
                        <span class="text-sm font-medium text-gray-900">{{ __('View Orders') }}</span>
                    </a>
                    
                    <a href="{{ route('user.wishlist') }}" 
                       class="flex flex-col items-center justify-center p-6 border-2 border-gray-200 rounded-lg hover:border-accent-500 hover:bg-accent-50 transition-colors">
                        <i class="fas fa-heart text-3xl text-accent-600 mb-3"></i>
                        <span class="text-sm font-medium text-gray-900">{{ __('Wishlist') }}</span>
                    </a>
                    
                    <a href="{{ route('user.addresses') }}" 
                       class="flex flex-col items-center justify-center p-6 border-2 border-gray-200 rounded-lg hover:border-info-500 hover:bg-info-50 transition-colors">
                        <i class="fas fa-map-marker-alt text-3xl text-info-600 mb-3"></i>
                        <span class="text-sm font-medium text-gray-900">{{ __('Addresses') }}</span>
                    </a>
                    
                    <a href="{{ route('user.profile') }}" 
                       class="flex flex-col items-center justify-center p-6 border-2 border-gray-200 rounded-lg hover:border-success-500 hover:bg-success-50 transition-colors">
                        <i class="fas fa-user-edit text-3xl text-success-600 mb-3"></i>
                        <span class="text-sm font-medium text-gray-900">{{ __('Edit Profile') }}</span>
                    </a>
                </div>
            </div>
            
        </div>
        
    </div>
</div>

@endsection
