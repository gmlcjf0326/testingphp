@extends('layouts.shop')

@section('title', '주문하기')

@section('content')
<div class="container">
    <h1 class="text-center mb-5">주문하기</h1>
    
    <div class="row">
        <!-- 주문 정보 입력 -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">배송 정보</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">받는 분 성함 <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('customer_name') is-invalid @enderror" 
                                   id="customer_name" name="customer_name" value="{{ old('customer_name', Auth::user()->name) }}" required>
                            @error('customer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">연락처 <span class="text-danger">*</span></label>
                            <input type="tel" class="form-control @error('customer_phone') is-invalid @enderror" 
                                   id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}" 
                                   placeholder="010-1234-5678" required>
                            @error('customer_phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="mb-3">
                            <label for="shipping_address" class="form-label">배송 주소 <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('shipping_address') is-invalid @enderror" 
                                      id="shipping_address" name="shipping_address" rows="3" required>{{ old('shipping_address') }}</textarea>
                            @error('shipping_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="agreeTerms" required>
                            <label class="form-check-label" for="agreeTerms">
                                주문 내용을 확인했으며, 결제 진행에 동의합니다.
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg w-100">
                            <i class="fas fa-credit-card"></i> 결제하기
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- 주문 요약 -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">주문 요약</h4>
                </div>
                <div class="card-body">
                    @foreach($cart as $item)
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong>{{ $item['name'] }}</strong>
                                <small class="text-muted">x{{ $item['quantity'] }}</small>
                            </div>
                            <span>₩{{ number_format($item['subtotal']) }}</span>
                        </div>
                    @endforeach
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between mb-3">
                        <strong>배송비</strong>
                        <span>무료</span>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <h5>총 결제금액</h5>
                        <h5 class="text-primary">₩{{ number_format($total) }}</h5>
                    </div>
                </div>
            </div>
            
            <!-- 결제 수단 안내 -->
            <div class="card mt-3">
                <div class="card-body">
                    <h5 class="card-title">결제 수단</h5>
                    <p class="card-text text-muted small">
                        토스페이먼츠를 통해 안전하게 결제됩니다.<br>
                        신용카드, 체크카드, 간편결제 등 다양한 결제수단을 지원합니다.
                    </p>
                    <img src="https://static.toss.im/3d-emojis/u1F4B3-apng.png" alt="Toss" style="width: 50px;">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('checkoutForm').addEventListener('submit', function(e) {
    const agreeTerms = document.getElementById('agreeTerms');
    if (!agreeTerms.checked) {
        e.preventDefault();
        alert('결제 진행에 동의해주세요.');
        return false;
    }
});
</script>
@endpush
