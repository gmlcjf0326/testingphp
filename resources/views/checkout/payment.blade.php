@extends('layouts.shop')

@section('title', '결제하기')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">결제 진행</h4>
                </div>
                <div class="card-body">
                    <div id="payment-method"></div>
                    <button id="payment-button" class="btn btn-primary btn-lg w-100 mt-3">
                        ₩{{ number_format($totalAmount) }} 결제하기
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- 토스페이먼츠 SDK -->
<script src="https://js.tosspayments.com/v1/payment"></script>

<script>
    const clientKey = '{{ $clientKey }}';
    const customerKey = 'user_{{ Auth::id() }}';
    const tossPayments = TossPayments(clientKey);
    
    // 결제 UI 렌더링
    tossPayments.widgets({
        customerKey: customerKey,
    }).then(function (widgets) {
        // 결제 수단 위젯 렌더링
        widgets.renderPaymentMethods({
            selector: "#payment-method",
            variantKey: "DEFAULT"
        });
    });
    
    // 결제 버튼 클릭 이벤트
    document.getElementById('payment-button').addEventListener('click', function() {
        const orderId = '{{ $order->order_number }}';
        const orderName = '{{ $order->order_number }} 주문';
        const successUrl = '{{ route("checkout.success") }}';
        const failUrl = '{{ route("checkout.fail") }}';
        
        tossPayments.requestPayment('카드', {
            amount: {{ $totalAmount }},
            orderId: orderId,
            orderName: orderName,
            customerName: '{{ $order->customer_name }}',
            customerEmail: '{{ $order->customer_email }}',
            successUrl: successUrl,
            failUrl: failUrl,
        }).catch(function (error) {
            if (error.code === 'USER_CANCEL') {
                // 사용자가 결제를 취소한 경우
                alert('결제가 취소되었습니다.');
            } else {
                // 기타 오류 발생
                alert(error.message);
            }
        });
    });
</script>
@endpush
