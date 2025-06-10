@extends('layouts.shop')

@section('title', '대시보드 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <h1 class="page-title">Dashboard</h1>
    
    <!-- 환영 메시지 -->
    <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 30px;">
        <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 10px; color: var(--anuta-text);">
            안녕하세요, {{ Auth::user()->name }}님!
        </h3>
        <p style="color: var(--anuta-text-light);">ANUTA SHOP에 오신 것을 환영합니다.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: 30px;">
        <!-- 내 장바구니 정보 -->
        <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: var(--anuta-text); display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-shopping-cart" style="color: var(--anuta-primary);"></i>
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
                <div style="margin-bottom: 20px;">
                    @foreach($cartItems->take(3) as $item)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--anuta-border);">
                            <span style="font-size: 14px;">{{ $item->product->name }} ({{ $item->quantity }}개)</span>
                            <span style="font-size: 14px; color: var(--anuta-text-light);">₩{{ number_format($item->product->price * $item->quantity) }}</span>
                        </div>
                    @endforeach
                    
                    @if($cartItems->count() > 3)
                        <p style="font-size: 14px; color: var(--anuta-text-light); margin-top: 10px;">외 {{ $cartItems->count() - 3 }}개 상품...</p>
                    @endif
                    
                    <div style="padding-top: 20px; margin-top: 20px; border-top: 2px solid var(--anuta-border);">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 18px; font-weight: 600;">총액:</span>
                            <span style="font-size: 20px; font-weight: 700; color: var(--anuta-primary);">₩{{ number_format($cartTotal) }}</span>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px;">
                        <a href="{{ route('shop.cart.index') }}" class="anuta-btn" style="width: 100%;">
                            장바구니 보기
                        </a>
                    </div>
                </div>
            @else
                <p style="color: var(--anuta-text-light); margin-bottom: 20px;">장바구니가 비어있습니다.</p>
                <a href="{{ route('shop.products.index') }}" class="anuta-btn-outline" style="width: 100%;">
                    쇼핑하러 가기
                </a>
            @endif
        </div>

        <!-- 내 정보 -->
        <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: var(--anuta-text); display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-user" style="color: var(--anuta-primary);"></i>
                내 정보
            </h3>
            
            <div style="margin-bottom: 30px;">
                <div style="padding: 12px 0; border-bottom: 1px solid var(--anuta-border);">
                    <span style="color: var(--anuta-text-light); font-size: 14px;">이름:</span>
                    <span style="margin-left: 10px; font-weight: 500;">{{ Auth::user()->name }}</span>
                </div>
                <div style="padding: 12px 0; border-bottom: 1px solid var(--anuta-border);">
                    <span style="color: var(--anuta-text-light); font-size: 14px;">이메일:</span>
                    <span style="margin-left: 10px; font-weight: 500;">{{ Auth::user()->email }}</span>
                </div>
                <div style="padding: 12px 0;">
                    <span style="color: var(--anuta-text-light); font-size: 14px;">가입일:</span>
                    <span style="margin-left: 10px; font-weight: 500;">{{ Auth::user()->created_at->format('Y년 m월 d일') }}</span>
                </div>
            </div>
            
            <a href="{{ route('profile.edit') }}" class="anuta-btn-outline" style="width: 100%;">
                프로필 편집
            </a>
        </div>

        <!-- 주문 내역 -->
        <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: var(--anuta-text); display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-clipboard-list" style="color: var(--anuta-primary);"></i>
                최근 주문 내역
            </h3>
            
            @php
                $orders = \App\Models\Order::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
            @endphp
            
            @if($orders->count() > 0)
                <div style="margin-bottom: 20px;">
                    @foreach($orders as $order)
                        <div style="padding: 15px 0; border-bottom: 1px solid var(--anuta-border);">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 5px;">
                                <span style="font-weight: 500;">주문번호: {{ $order->order_number }}</span>
                                <span style="font-size: 14px; color: var(--anuta-text-light);">{{ $order->created_at->format('Y.m.d') }}</span>
                            </div>
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <span style="font-size: 14px; color: var(--anuta-text-light);">{{ $order->items->count() }}개 상품</span>
                                <span style="font-weight: 600; color: var(--anuta-primary);">₩{{ number_format($order->total_amount) }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a href="{{ route('shop.orders.index') }}" class="anuta-btn-outline" style="width: 100%;">
                    전체 주문 내역 보기
                </a>
            @else
                <p style="color: var(--anuta-text-light); margin-bottom: 10px;">아직 주문 내역이 없습니다.</p>
                <p style="font-size: 14px; color: var(--anuta-text-light); opacity: 0.7;">첫 주문을 해보세요!</p>
            @endif
        </div>

        <!-- 빠른 링크 -->
        <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: var(--anuta-text); display: flex; align-items: center; gap: 10px;">
                <i class="fas fa-link" style="color: var(--anuta-primary);"></i>
                빠른 링크
            </h3>
            
            <div style="display: flex; flex-direction: column; gap: 15px;">
                <a href="{{ route('shop.products.index') }}" style="display: flex; align-items: center; gap: 10px; color: var(--anuta-text); text-decoration: none; padding: 10px; border-radius: 4px; transition: all 0.3s;">
                    <i class="fas fa-chevron-right" style="color: var(--anuta-primary);"></i>
                    상품 둘러보기
                </a>
                <a href="{{ route('shop.cart.index') }}" style="display: flex; align-items: center; gap: 10px; color: var(--anuta-text); text-decoration: none; padding: 10px; border-radius: 4px; transition: all 0.3s;">
                    <i class="fas fa-chevron-right" style="color: var(--anuta-primary);"></i>
                    장바구니 보기
                </a>
                <a href="{{ route('profile.edit') }}" style="display: flex; align-items: center; gap: 10px; color: var(--anuta-text); text-decoration: none; padding: 10px; border-radius: 4px; transition: all 0.3s;">
                    <i class="fas fa-chevron-right" style="color: var(--anuta-primary);"></i>
                    프로필 설정
                </a>
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" style="display: flex; align-items: center; gap: 10px; color: var(--anuta-text); text-decoration: none; padding: 10px; border-radius: 4px; transition: all 0.3s;">
                    <i class="fas fa-chevron-right" style="color: var(--anuta-primary);"></i>
                    로그아웃
                </a>
            </div>
        </div>
    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

<!-- 추가 스타일 -->
<style>
    /* 링크 호버 효과 */
    .anuta-container a[style*="transition: all 0.3s"]:hover {
        background-color: var(--anuta-bg);
        padding-left: 20px;
    }
    
    /* 반응형 디자인 */
    @media (max-width: 768px) {
        .anuta-container > div:nth-child(3) {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection
