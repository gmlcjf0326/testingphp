@extends('layouts.shop')

@section('title', $product->name . ' - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <!-- 브레드크럼 -->
    <nav style="margin-bottom: 40px;">
        <ol style="list-style: none; display: flex; gap: 15px; font-size: 14px; color: var(--anuta-text-light);">
            <li><a href="{{ route('shop.products.index') }}" style="color: var(--anuta-text-light); text-decoration: none;">홈</a></li>
            <li>/</li>
            <li style="color: var(--anuta-text);">{{ $product->name }}</li>
        </ol>
    </nav>
    
    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: start;">
        <!-- 상품 이미지 -->
        <div>
            <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                <img src="{{ $product->image }}" alt="{{ $product->name }}" style="width: 100%; height: 500px; object-fit: cover;">
            </div>
        </div>
        
        <!-- 상품 정보 -->
        <div>
            <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 20px; color: var(--anuta-text);">{{ $product->name }}</h1>
            
            <!-- 가격 -->
            <p style="font-size: 32px; font-weight: 700; color: var(--anuta-primary); margin-bottom: 30px;">
                ₩{{ number_format($product->price) }}
            </p>
            
            <!-- 재고 상태 -->
            <div style="margin-bottom: 30px;">
                @if($product->stock > 0)
                    <span style="display: inline-block; background: #E8F5E9; color: #2E7D32; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                        재고: {{ $product->stock }}개
                    </span>
                @else
                    <span style="display: inline-block; background: #FFEBEE; color: #C62828; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                        품절
                    </span>
                @endif
            </div>
            
            <!-- 상품 설명 -->
            <div style="margin-bottom: 40px;">
                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--anuta-text);">상품 설명</h3>
                <p style="line-height: 1.8; color: var(--anuta-text-light);">
                    {{ $product->description ?? '상품 설명이 없습니다.' }}
                </p>
            </div>
            
            <!-- 구매 버튼 -->
            @if($product->stock > 0)
                <form action="{{ route('shop.cart.add', $product->id) }}" method="POST" style="margin-bottom: 20px;">
                    @csrf
                    <button type="submit" class="anuta-btn" style="width: 100%; padding: 15px; font-size: 18px;">
                        <i class="fas fa-cart-plus"></i> 장바구니 담기
                    </button>
                </form>
                
                <button class="anuta-btn-outline" style="width: 100%; padding: 15px; font-size: 18px; cursor: not-allowed; opacity: 0.6;" disabled>
                    <i class="fas fa-credit-card"></i> 바로 구매 (준비중)
                </button>
            @else
                <button class="anuta-btn" style="width: 100%; padding: 15px; font-size: 18px; background-color: #9E9E9E; cursor: not-allowed;" disabled>
                    <i class="fas fa-times"></i> 품절된 상품입니다
                </button>
            @endif
            
            <!-- 추가 정보 -->
            <div style="margin-top: 50px; padding-top: 30px; border-top: 1px solid var(--anuta-border);">
                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; text-align: center;">
                    <div>
                        <i class="fas fa-truck" style="font-size: 36px; color: var(--anuta-primary); margin-bottom: 10px; display: block;"></i>
                        <p style="margin: 0; font-weight: 500;">무료배송</p>
                        <p style="margin: 5px 0 0; font-size: 14px; color: var(--anuta-text-light);">5만원 이상 구매시</p>
                    </div>
                    <div>
                        <i class="fas fa-undo" style="font-size: 36px; color: var(--anuta-primary); margin-bottom: 10px; display: block;"></i>
                        <p style="margin: 0; font-weight: 500;">30일 반품</p>
                        <p style="margin: 5px 0 0; font-size: 14px; color: var(--anuta-text-light);">구매 후 30일 이내</p>
                    </div>
                    <div>
                        <i class="fas fa-shield-alt" style="font-size: 36px; color: var(--anuta-primary); margin-bottom: 10px; display: block;"></i>
                        <p style="margin: 0; font-weight: 500;">정품보증</p>
                        <p style="margin: 5px 0 0; font-size: 14px; color: var(--anuta-text-light);">100% 정품 보장</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 뒤로가기 버튼 -->
    <div style="text-align: center; margin-top: 80px;">
        <a href="{{ route('shop.products.index') }}" class="anuta-btn-outline" style="padding: 12px 40px;">
            <i class="fas fa-arrow-left"></i> 상품 목록으로 돌아가기
        </a>
    </div>
</div>

<!-- 반응형 스타일 -->
<style>
    @media (max-width: 768px) {
        .anuta-container > div:nth-child(2) {
            grid-template-columns: 1fr;
            gap: 40px;
        }
        
        .anuta-container h1 {
            font-size: 28px !important;
        }
        
        .anuta-container > div:nth-child(2) > div:last-child > div:last-child > div {
            grid-template-columns: 1fr;
            gap: 20px;
        }
    }
</style>
@endsection
