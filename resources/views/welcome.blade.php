@extends('layouts.shop')

@section('title', 'ANUTA SHOP - 홈')

@section('content')
<div class="anuta-container">
    <!-- 히어로 섹션 -->
    <section style="background: linear-gradient(135deg, rgba(255, 107, 53, 0.9) 0%, rgba(255, 138, 101, 0.9) 100%), url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?w=1600&h=800&fit=crop') center/cover; border-radius: 12px; padding: 80px 40px; text-align: center; color: white; margin-bottom: 60px; position: relative; overflow: hidden;">
        <h1 style="font-size: 48px; font-weight: 700; margin-bottom: 20px; position: relative; z-index: 1;">Welcome to ANUTA SHOP</h1>
        <p style="font-size: 20px; margin-bottom: 40px; opacity: 0.95; position: relative; z-index: 1;">
            특별한 쇼핑 경험을 제공하는 온라인 스토어
        </p>
        <a href="{{ route('shop.products.index') }}" class="anuta-btn" style="background: white; color: var(--anuta-primary); padding: 15px 40px; font-size: 18px; position: relative; z-index: 1;">
            <i class="fas fa-shopping-bag"></i> 쇼핑 시작하기
        </a>
    </section>

    <!-- 특징 섹션 -->
    <section style="margin-bottom: 80px;">
        <h2 style="font-size: 36px; font-weight: 700; text-align: center; margin-bottom: 50px; color: var(--anuta-text);">
            Why ANUTA SHOP?
        </h2>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 40px;">
            <!-- 특징 1 -->
            <div style="text-align: center;">
                <div style="background: white; width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);">
                    <i class="fas fa-truck" style="font-size: 36px; color: var(--anuta-primary);"></i>
                </div>
                <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 15px; color: var(--anuta-text);">무료 배송</h3>
                <p style="color: var(--anuta-text-light); line-height: 1.6;">
                    5만원 이상 구매시 전국 무료배송<br>
                    빠르고 안전한 배송 서비스
                </p>
            </div>
            
            <!-- 특징 2 -->
            <div style="text-align: center;">
                <div style="background: white; width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);">
                    <i class="fas fa-shield-alt" style="font-size: 36px; color: var(--anuta-primary);"></i>
                </div>
                <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 15px; color: var(--anuta-text);">100% 정품</h3>
                <p style="color: var(--anuta-text-light); line-height: 1.6;">
                    모든 상품 정품 보증<br>
                    안심하고 구매하세요
                </p>
            </div>
            
            <!-- 특징 3 -->
            <div style="text-align: center;">
                <div style="background: white; width: 80px; height: 80px; border-radius: 50%; margin: 0 auto 20px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(255, 107, 53, 0.2);">
                    <i class="fas fa-undo" style="font-size: 36px; color: var(--anuta-primary);"></i>
                </div>
                <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 15px; color: var(--anuta-text);">30일 반품</h3>
                <p style="color: var(--anuta-text-light); line-height: 1.6;">
                    구매 후 30일 이내 반품 가능<br>
                    고객 만족을 최우선으로
                </p>
            </div>
        </div>
    </section>

    <!-- 추천 상품 섹션 -->
    <section style="margin-bottom: 80px;">
        <h2 style="font-size: 36px; font-weight: 700; text-align: center; margin-bottom: 50px; color: var(--anuta-text);">
            추천 상품
        </h2>
        
        @php
            $featuredProducts = \App\Models\Product::where('stock', '>', 0)->take(3)->get();
        @endphp
        
        @if($featuredProducts->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 30px; margin-bottom: 40px;">
                @foreach($featuredProducts as $product)
                    <a href="{{ route('shop.products.show', $product->id) }}" class="product-card">
                        <img src="{{ $product->image }}" class="product-image" alt="{{ $product->name }}">
                        <div class="product-info">
                            <h3 class="product-title">{{ $product->name }}</h3>
                            <p class="product-price">₩{{ number_format($product->price) }}</p>
                        </div>
                    </a>
                @endforeach
            </div>
            
            <div style="text-align: center;">
                <a href="{{ route('shop.products.index') }}" class="anuta-btn-outline" style="padding: 12px 40px;">
                    전체 상품 보기 <i class="fas fa-arrow-right" style="margin-left: 8px;"></i>
                </a>
            </div>
        @else
            <p style="text-align: center; color: var(--anuta-text-light);">
                아직 등록된 상품이 없습니다.
            </p>
        @endif
    </section>

    <!-- CTA 섹션 -->
    <section style="background: white; border-radius: 12px; padding: 60px 40px; text-align: center; box-shadow: 0 2px 20px rgba(0, 0, 0, 0.05);">
        <h2 style="font-size: 32px; font-weight: 700; margin-bottom: 20px; color: var(--anuta-text);">
            지금 시작하세요!
        </h2>
        <p style="font-size: 18px; color: var(--anuta-text-light); margin-bottom: 30px;">
            회원가입하고 특별한 혜택을 받아보세요
        </p>
        <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
            @guest
                <a href="{{ route('register') }}" class="anuta-btn" style="padding: 12px 30px;">
                    <i class="fas fa-user-plus"></i> 회원가입
                </a>
                <a href="{{ route('login') }}" class="anuta-btn-outline" style="padding: 12px 30px;">
                    <i class="fas fa-sign-in-alt"></i> 로그인
                </a>
            @else
                <a href="{{ route('shop.products.index') }}" class="anuta-btn" style="padding: 12px 30px;">
                    <i class="fas fa-shopping-bag"></i> 쇼핑하기
                </a>
                <a href="{{ route('dashboard') }}" class="anuta-btn-outline" style="padding: 12px 30px;">
                    <i class="fas fa-user"></i> 마이페이지
                </a>
            @endguest
        </div>
    </section>
</div>

<!-- 추가 스타일 -->
<style>
    /* 히어로 섹션 애니메이션 */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    section:first-child h1 {
        animation: fadeInUp 0.8s ease-out;
    }
    
    section:first-child p {
        animation: fadeInUp 0.8s ease-out 0.2s;
        animation-fill-mode: both;
    }
    
    section:first-child a {
        animation: fadeInUp 0.8s ease-out 0.4s;
        animation-fill-mode: both;
    }
    
    /* 호버 효과 */
    .anuta-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(255, 107, 53, 0.3);
    }
    
    /* 반응형 디자인 */
    @media (max-width: 768px) {
        section:first-child {
            padding: 60px 20px !important;
        }
        
        section:first-child h1 {
            font-size: 36px !important;
        }
        
        section:first-child p {
            font-size: 18px !important;
        }
        
        section h2 {
            font-size: 28px !important;
        }
    }
</style>
@endsection
