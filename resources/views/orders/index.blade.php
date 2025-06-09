@extends('layouts.shop')

@section('title', '주문 내역')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">주문 내역</h1>
    
    @if($orders->count() > 0)
        <div class="row">
            @foreach($orders as $order)
                <div class="col-12 mb-4">
                    <div class="card">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h5 class="mb-0">주문번호: {{ $order->order_number }}</h5>
                                    <small class="text-muted">{{ $order->created_at->format('Y년 m월 d일 H:i') }}</small>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    @switch($order->status)
                                        @case('pending')
                                            <span class="badge bg-warning">대기중</span>
                                            @break
                                        @case('paid')
                                            <span class="badge bg-success">결제완료</span>
                                            @break
                                        @case('failed')
                                            <span class="badge bg-danger">결제실패</span>
                                            @break
                                        @case('cancelled')
                                            <span class="badge bg-secondary">취소됨</span>
                                            @break
                                        @case('refunded')
                                            <span class="badge bg-info">환불됨</span>
                                            @break
                                    @endswitch
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">
                                    <h6>주문 상품</h6>
                                    <ul class="list-unstyled">
                                        @foreach($order->orderItems as $index => $item)
                                            @if($index < 3)
                                                <li>
                                                    {{ $item->product->name }} 
                                                    <span class="text-muted">({{ $item->quantity }}개)</span>
                                                </li>
                                            @endif
                                        @endforeach
                                        @if($order->orderItems->count() > 3)
                                            <li class="text-muted">외 {{ $order->orderItems->count() - 3 }}개 상품...</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="col-md-4 text-md-end">
                                    <p class="mb-2">
                                        <strong>총 금액:</strong> 
                                        <span class="text-primary fs-5">₩{{ number_format($order->total_amount) }}</span>
                                    </p>
                                    <a href="{{ route('orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> 상세보기
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- 페이지네이션 -->
        <div class="d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    @else
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-5x text-muted mb-3"></i>
            <h3 class="text-muted">주문 내역이 없습니다.</h3>
            <p class="text-muted">첫 주문을 해보세요!</p>
            <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
                <i class="fas fa-shopping-bag"></i> 쇼핑하러 가기
            </a>
        </div>
    @endif
</div>
@endsection
