@extends('layouts.admin')

@section('title', '대시보드')
@section('header', '대시보드')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- 통계 카드들 -->
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-blue-100 rounded-full">
                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">전체 상품</p>
                <p class="text-2xl font-semibold">{{ $stats['total_products'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-green-100 rounded-full">
                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">전체 주문</p>
                <p class="text-2xl font-semibold">{{ $stats['total_orders'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-purple-100 rounded-full">
                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">가입 회원</p>
                <p class="text-2xl font-semibold">{{ $stats['total_users'] }}</p>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center">
            <div class="p-3 bg-red-100 rounded-full">
                <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </div>
            <div class="ml-4">
                <p class="text-gray-500 text-sm">재고 부족</p>
                <p class="text-2xl font-semibold">{{ $stats['low_stock_products']->count() }}</p>
            </div>
        </div>
    </div>
</div>

<!-- 최근 주문 -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold">최근 주문</h3>
        </div>
        <div class="p-6">
            @if($stats['recent_orders']->isEmpty())
                <p class="text-gray-500">최근 주문이 없습니다.</p>
            @else
                <div class="space-y-4">
                    @foreach($stats['recent_orders'] as $order)
                        <div class="border-b pb-4">
                            <div class="flex justify-between items-start">
                                <div>
                                    <p class="font-medium">주문번호: {{ $order->order_number }}</p>
                                    <p class="text-sm text-gray-600">{{ $order->user->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $order->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold">₩{{ number_format($order->total_amount) }}</p>
                                    <span class="inline-flex px-2 py-1 text-xs rounded-full
                                        @if($order->payment_status === 'completed') bg-green-100 text-green-800
                                        @elseif($order->payment_status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $order->payment_status === 'completed' ? '결제완료' : 
                                           ($order->payment_status === 'pending' ? '결제대기' : '결제실패') }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <!-- 재고 부족 상품 -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b">
            <h3 class="text-lg font-semibold">재고 부족 상품</h3>
        </div>
        <div class="p-6">
            @if($stats['low_stock_products']->isEmpty())
                <p class="text-gray-500">재고가 부족한 상품이 없습니다.</p>
            @else
                <div class="space-y-4">
                    @foreach($stats['low_stock_products'] as $product)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $product->image }}" alt="{{ $product->name }}" 
                                     class="w-12 h-12 object-cover rounded">
                                <div class="ml-3">
                                    <p class="font-medium">{{ $product->name }}</p>
                                    <p class="text-sm text-gray-600">₩{{ number_format($product->price) }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full
                                      @if($product->stock == 0) bg-red-100 text-red-800
                                      @else bg-yellow-100 text-yellow-800 @endif">
                                    재고: {{ $product->stock }}개
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
