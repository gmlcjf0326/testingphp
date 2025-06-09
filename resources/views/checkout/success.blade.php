@extends('layouts.shop')

@section('title', '결제 완료')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <div class="card">
                <div class="card-body py-5">
                    <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
                    
                    <h1 class="mt-4 mb-3">결제가 완료되었습니다!</h1>
                    
                    <p class="text-muted mb-4">
                        주문번호: <strong>{{ $order->order_number }}</strong><br>
                        결제금액: <strong>₩{{ number_format($order->total_amount) }}</strong>
                    </p>
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        주문 내역은 이메일로 발송되었습니다.<br>
                        배송은 결제 완료 후 2-3일 내에 시작됩니다.
                    </div>
                    
                    @if($payment->receipt_url)
                        <div class="mb-4">
                            <a href="{{ $payment->receipt_url }}" target="_blank" class="btn btn-outline-secondary">
                                <i class="fas fa-receipt"></i> 영수증 보기
                            </a>
                        </div>
                    @endif
                    
                    <div class="d-grid gap-2 d-md-block">
                        <a href="{{ route('orders.show', $order->id) }}" class="btn btn-primary">
                            <i class="fas fa-box"></i> 주문 상세보기
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-shopping-bag"></i> 쇼핑 계속하기
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- 주문 상품 요약 -->
            <div class="card mt-4">
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
                                        <td>{{ $item->product->name }}</td>
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
    </div>
</div>
@endsection
