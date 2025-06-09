@extends('layouts.shop')

@section('title', '상품 목록')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">전체 상품</h1>
    
    <!-- 3x3 그리드 -->
    <div class="row g-4">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card product-card h-100">
                    <!-- 상품 이미지 -->
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 250px; object-fit: cover;">
                    
                    <div class="card-body d-flex flex-column">
                        <!-- 상품명 -->
                        <h5 class="card-title">{{ $product->name }}</h5>
                        
                        <!-- 가격 -->
                        <p class="card-text text-primary fw-bold fs-4">
                            ₩{{ number_format($product->price) }}
                        </p>
                        
                        <!-- 재고 상태 -->
                        <p class="card-text">
                            @if($product->stock > 0)
                                <span class="badge bg-success">재고: {{ $product->stock }}개</span>
                            @else
                                <span class="badge bg-danger">품절</span>
                            @endif
                        </p>
                        
                        <!-- 버튼 그룹 -->
                        <div class="mt-auto">
                            <div class="d-grid gap-2">
                                <!-- 상세보기 버튼 -->
                                <a href="{{ route('products.show', $product->id) }}" class="btn btn-outline-primary">
                                    <i class="fas fa-eye"></i> 상세보기
                                </a>
                                
                                <!-- 장바구니 담기 버튼 -->
                                @if($product->stock > 0)
                                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-primary w-100">
                                            <i class="fas fa-cart-plus"></i> 장바구니 담기
                                        </button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary w-100" disabled>
                                        <i class="fas fa-times"></i> 품절
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- 상품이 없을 때 -->
    @if($products->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-5x text-muted mb-3"></i>
            <h3 class="text-muted">등록된 상품이 없습니다.</h3>
        </div>
    @endif
</div>
@endsection
