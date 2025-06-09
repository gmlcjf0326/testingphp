@extends('layouts.shop')

@section('title', '전체 상품 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <h1 class="page-title">Products</h1>
    
    <!-- 상품 그리드 -->
    <div class="product-grid">
        @foreach($products as $product)
            <a href="{{ route('products.show', $product->id) }}" class="product-card">
                <!-- 상품 이미지 -->
                <div style="position: relative;">
                    <img src="{{ $product->image }}" class="product-image" alt="{{ $product->name }}">
                    @if($product->stock <= 0)
                        <div style="position: absolute; top: 10px; left: 10px; background: rgba(0, 0, 0, 0.8); color: white; padding: 5px 15px; border-radius: 20px; font-size: 14px;">
                            품절
                        </div>
                    @endif
                </div>
                
                <div class="product-info">
                    <!-- 상품명 -->
                    <h3 class="product-title">{{ $product->name }}</h3>
                    
                    <!-- 상품 설명 (있다면) -->
                    @if(isset($product->description) && $product->description)
                        <p class="product-description">
                            {{ Str::limit($product->description, 100) }}
                        </p>
                    @endif
                    
                    <!-- 가격 -->
                    <p class="product-price">
                        ₩{{ number_format($product->price) }}
                    </p>
                    
                    <!-- 재고 상태 -->
                    @if($product->stock > 0 && $product->stock <= 5)
                        <p style="color: var(--anuta-primary); font-size: 14px; margin-top: 8px;">
                            재고 {{ $product->stock }}개 남음
                        </p>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
    
    <!-- 상품이 없을 때 -->
    @if($products->isEmpty())
        <div style="text-align: center; padding: 80px 20px;">
            <i class="fas fa-box-open" style="font-size: 80px; color: var(--anuta-text-light); margin-bottom: 20px; display: block;"></i>
            <h3 style="color: var(--anuta-text-light); font-weight: 400;">등록된 상품이 없습니다.</h3>
        </div>
    @endif
</div>

<!-- 추가 스타일 -->
<style>
    /* 호버 효과 개선 */
    .product-card {
        display: block;
        position: relative;
        overflow: hidden;
    }
    
    .product-card::after {
        content: '상세보기';
        position: absolute;
        bottom: 20px;
        right: 20px;
        background: var(--anuta-primary);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 500;
        opacity: 0;
        transform: translateY(10px);
        transition: all 0.3s;
    }
    
    .product-card:hover::after {
        opacity: 1;
        transform: translateY(0);
    }
    
    .product-card:hover .product-image {
        transform: scale(1.05);
        transition: transform 0.3s;
    }
    
    /* 반응형 그리드 개선 */
    @media (max-width: 640px) {
        .product-grid {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .page-title {
            font-size: 32px;
            margin-bottom: 30px;
        }
    }
</style>
@endsection
