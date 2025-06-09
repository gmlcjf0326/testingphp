@extends('layouts.shop')

@section('title', '장바구니')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">장바구니</h1>
    
    @if(count($cart) > 0)
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>상품</th>
                        <th>상품명</th>
                        <th>가격</th>
                        <th>수량</th>
                        <th>소계</th>
                        <th>작업</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr>
                            <!-- 상품 이미지 -->
                            <td>
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="img-thumbnail" style="width: 80px; height: 80px; object-fit: cover;">
                            </td>
                            
                            <!-- 상품명 -->
                            <td>
                                <a href="{{ route('products.show', $id) }}" class="text-decoration-none">
                                    {{ $item['name'] }}
                                </a>
                            </td>
                            
                            <!-- 가격 -->
                            <td>₩{{ number_format($item['price']) }}</td>
                            
                            <!-- 수량 -->
                            <td>{{ $item['quantity'] }}</td>
                            
                            <!-- 소계 -->
                            <td class="fw-bold">₩{{ number_format($item['price'] * $item['quantity']) }}</td>
                            
                            <!-- 삭제 버튼 -->
                            <td>
                                <form action="{{ route('cart.remove', $id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('정말 삭제하시겠습니까?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-primary">
                        <th colspan="4" class="text-end">총 금액:</th>
                        <th class="fs-4">₩{{ number_format($total) }}</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <!-- 버튼 그룹 -->
        <div class="row mt-4">
            <div class="col-md-6">
                <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-arrow-left"></i> 쇼핑 계속하기
                </a>
                
                <form action="{{ route('cart.clear') }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger" onclick="return confirm('장바구니를 비우시겠습니까?')">
                        <i class="fas fa-trash-alt"></i> 장바구니 비우기
                    </button>
                </form>
            </div>
            
            <div class="col-md-6 text-end">
                @auth
                    <a href="{{ route('checkout.index') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-credit-card"></i> 결제하기
                    </a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-success btn-lg">
                        <i class="fas fa-sign-in-alt"></i> 로그인 후 결제
                    </a>
                @endauth
            </div>
        </div>
    @else
        <!-- 장바구니가 비어있을 때 -->
        <div class="text-center py-5">
            <i class="fas fa-shopping-cart fa-5x text-muted mb-3"></i>
            <h3 class="text-muted">장바구니가 비어있습니다.</h3>
            <p class="text-muted">원하시는 상품을 장바구니에 담아보세요!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                <i class="fas fa-shopping-bag"></i> 쇼핑하러 가기
            </a>
        </div>
    @endif
</div>
@endsection
