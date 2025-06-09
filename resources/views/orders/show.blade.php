@extends('layouts.shop')

@section('title', '주문 상세')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('products.index') }}">홈</a></li>
            <li class="breadcrumb-item"><a href="{{ route('orders.index') }}">주문 내역</a></li>
            <li class="breadcrumb-item active">{{ $order->order_number }}</li>
        </ol>
    </nav>

    <h1 class="mb-4">주문 상세</h1>
    
    <div class="row">
        <!-- 주문 정보 -->
        <div class="col-md-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">주문 정보</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><strong>주문번호:</strong></div>
                        <div class="col-sm-9">{{ $order->order_number }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>주문일시:</strong></div>
                        <div class="col-sm-9">{{ $order->created_at->format('Y년 m월 d일 H:i') }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>주문상태:</strong></div>
                        <div class="col-sm-9">
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
            </div>
            
            <!-- 배송 정보 -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">배송 정보</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-3"><strong>받는분:</strong></div>
                        <div class="col-sm-9">{{ $order->customer_name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>연락처:</strong></div>
                        <div class="col-sm-9">{{ $order->customer_phone }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3"><strong>배송주소:</strong></div>
                        <div class="col-sm-9">{{ $order->shipping_address }}</div>
                    </div>
                </div>
            </div>
            
            <!-- 주문 상품 -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">주문 상품</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>상품명</th>
                                    <th>수량</th>
                                    <th>가격</th>
                                    <th>소계</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->orderItems as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('products.show', $item->product_id) }}">
                                                {{ $item->product->name }}
                                            </a>
                                        </td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₩{{ number_format($item->price) }}</td>
                                        <td>₩{{ number_format($item->subtotal) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="3" class="text-end">총액:</th>
                                    <th>₩{{ number_format($order->total_amount) }}</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- 결제 정보 -->
        <div class="col-md-4">
            @if($order->payment)
                <div class="card mb-4">
                    <div class="card-header">
                        <h5 class="mb-0">결제 정보</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <strong>결제상태:</strong>
                            @switch($order->payment->status)
                                @case('ready')
                                    <span class="badge bg-secondary">준비</span>
                                    @break
                                @case('done')
                                    <span class="badge bg-success">완료</span>
                                    @break
                                @case('canceled')
                                    <span class="badge bg-warning">취소</span>
                                    @break
                                @case('failed')
                                    <span class="badge bg-danger">실패</span>
                                    @break
                            @endswitch
                        </div>
                        
                        @if($order->payment->method)
                            <div class="mb-2">
                                <strong>결제수단:</strong> {{ $order->payment->method }}
                            </div>
                        @endif
                        
                        @if($order->payment->approved_at)
                            <div class="mb-2">
                                <strong>결제일시:</strong><br>
                                {{ $order->payment->approved_at->format('Y년 m월 d일 H:i') }}
                            </div>
                        @endif
                        
                        @if($order->payment->receipt_url)
                            <div class="mt-3">
                                <a href="{{ $order->payment->receipt_url }}" target="_blank" class="btn btn-sm btn-outline-primary w-100">
                                    <i class="fas fa-receipt"></i> 영수증 보기
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            
            <!-- 주문 작업 -->
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('orders.index') }}" class="btn btn-secondary w-100 mb-2">
                        <i class="fas fa-list"></i> 주문 목록
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-primary w-100">
                        <i class="fas fa-shopping-bag"></i> 쇼핑 계속하기
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
