@extends('layouts.shop')

@section('title', $product->name)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">홈</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </nav>
    
    <div class="row">
        <!-- 상품 이미지 -->
        <div class="col-md-6">
            <div class="card">
                <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="max-height: 500px; object-fit: contain;">
            </div>
        </div>
        
        <!-- 상품 정보 -->
        <div class="col-md-6">
            <h1 class="mb-3">{{ $product->name }}</h1>
            
            <!-- 가격 -->
            <h2 class="text-primary mb-4">₩{{ number_format($product->price) }}</h2>
            
            <!-- 재고 상태 -->
            <div class="mb-4">
                @if($product->stock > 0)
                    <span class="badge bg-success fs-6">재고: {{ $product->stock }}개</span>
                @else
                    <span class="badge bg-danger fs-6">품절</span>
                @endif
            </div>
            
            <!-- 상품 설명 -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">상품 설명</h5>
                    <p class="card-text">{{ $product->description ?? '상품 설명이 없습니다.' }}</p>
                </div>
            </div>
            
            <!-- 구매 옵션 -->
            <div class="card">
                <div class="card-body">
                    @if($product->stock > 0)
                        <form action="{{ route('cart.add', $product->id) }}" method="POST">
                            @csrf
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    <i class="fas fa-cart-plus"></i> 장바구니 담기
                                </button>
                                <button type="button" class="btn btn-success btn-lg" disabled>
                                    <i class="fas fa-credit-card"></i> 바로 구매 (준비중)
                                </button>
                            </div>
                        </form>
                    @else
                        <div class="d-grid">
                            <button class="btn btn-secondary btn-lg" disabled>
                                <i class="fas fa-times"></i> 품절된 상품입니다
                            </button>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- 추가 정보 -->
            <div class="mt-4">
                <div class="row text-center">
                    <div class="col-4">
                        <i class="fas fa-truck fa-2x text-primary mb-2"></i>
                        <p class="mb-0">무료배송</p>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-undo fa-2x text-primary mb-2"></i>
                        <p class="mb-0">30일 반품</p>
                    </div>
                    <div class="col-4">
                        <i class="fas fa-shield-alt fa-2x text-primary mb-2"></i>
                        <p class="mb-0">정품보증</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- 뒤로가기 버튼 -->
    <div class="text-center mt-5">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> 상품 목록으로 돌아가기
        </a>
    </div>
</div>
@endsection
