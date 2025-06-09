<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('대시보드') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- 환영 메시지 -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-2">안녕하세요, {{ Auth::user()->name }}님!</h3>
                    <p>Laravel 쇼핑몰에 오신 것을 환영합니다.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- 내 장바구니 정보 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            내 장바구니
                        </h3>
                        
                        @php
                            $cartItems = \App\Models\Cart::with('product')
                                ->where('user_id', Auth::id())
                                ->get();
                            $cartTotal = $cartItems->sum(function($item) {
                                return $item->product->price * $item->quantity;
                            });
                        @endphp

                        @if($cartItems->count() > 0)
                            <div class="space-y-3">
                                @foreach($cartItems->take(3) as $item)
                                    <div class="flex items-center justify-between text-sm">
                                        <span>{{ $item->product->name }} ({{ $item->quantity }}개)</span>
                                        <span class="text-gray-600">₩{{ number_format($item->product->price * $item->quantity) }}</span>
                                    </div>
                                @endforeach
                                
                                @if($cartItems->count() > 3)
                                    <p class="text-sm text-gray-500">외 {{ $cartItems->count() - 3 }}개 상품...</p>
                                @endif
                                
                                <div class="pt-3 border-t">
                                    <div class="flex justify-between font-semibold">
                                        <span>총액:</span>
                                        <span>₩{{ number_format($cartTotal) }}</span>
                                    </div>
                                </div>
                                
                                <div class="pt-3">
                                    <a href="{{ route('cart.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        장바구니 보기
                                    </a>
                                </div>
                            </div>
                        @else
                            <p class="text-gray-500">장바구니가 비어있습니다.</p>
                            <div class="mt-4">
                                <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    쇼핑하러 가기
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- 내 정보 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            내 정보
                        </h3>
                        
                        <div class="space-y-2 text-sm">
                            <div>
                                <span class="text-gray-600">이름:</span>
                                <span class="ml-2">{{ Auth::user()->name }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">이메일:</span>
                                <span class="ml-2">{{ Auth::user()->email }}</span>
                            </div>
                            <div>
                                <span class="text-gray-600">가입일:</span>
                                <span class="ml-2">{{ Auth::user()->created_at->format('Y년 m월 d일') }}</span>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <a href="{{ route('profile.edit') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                프로필 편집
                            </a>
                        </div>
                    </div>
                </div>

                <!-- 주문 내역 (미구현) -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            최근 주문 내역
                        </h3>
                        
                        <p class="text-gray-500">아직 주문 내역이 없습니다.</p>
                        <p class="text-sm text-gray-400 mt-2">주문 기능은 결제 기능 구현 후 사용 가능합니다.</p>
                    </div>
                </div>

                <!-- 빠른 링크 -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold mb-4">
                            <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            빠른 링크
                        </h3>
                        
                        <div class="space-y-2">
                            <a href="{{ route('products.index') }}" class="block text-blue-600 hover:text-blue-800">
                                → 상품 둘러보기
                            </a>
                            <a href="{{ route('cart.index') }}" class="block text-blue-600 hover:text-blue-800">
                                → 장바구니 보기
                            </a>
                            <a href="{{ route('profile.edit') }}" class="block text-blue-600 hover:text-blue-800">
                                → 프로필 설정
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
