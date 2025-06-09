@extends('layouts.shop')

@section('title', '주문하기 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <h1 class="page-title">Checkout</h1>
    
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 40px; align-items: start;">
        <!-- 주문 정보 입력 -->
        <div>
            <div style="background: white; border-radius: 8px; padding: 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 30px; color: var(--anuta-text);">배송 정보</h3>
                
                <form action="{{ route('checkout.process') }}" method="POST" id="checkoutForm">
                    @csrf
                    
                    <div style="margin-bottom: 25px;">
                        <label for="customer_name" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                            받는 분 성함 <span style="color: var(--anuta-primary);">*</span>
                        </label>
                        <input type="text" 
                               class="@error('customer_name') error @enderror" 
                               id="customer_name" 
                               name="customer_name" 
                               value="{{ old('customer_name', Auth::user()->name) }}" 
                               style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                               required>
                        @error('customer_name')
                            <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 25px;">
                        <label for="customer_phone" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                            연락처 <span style="color: var(--anuta-primary);">*</span>
                        </label>
                        <input type="tel" 
                               class="@error('customer_phone') error @enderror" 
                               id="customer_phone" 
                               name="customer_phone" 
                               value="{{ old('customer_phone') }}" 
                               placeholder="010-1234-5678"
                               style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s;"
                               required>
                        @error('customer_phone')
                            <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 30px;">
                        <label for="shipping_address" style="display: block; font-weight: 500; margin-bottom: 8px; color: var(--anuta-text);">
                            배송 주소 <span style="color: var(--anuta-primary);">*</span>
                        </label>
                        <textarea class="@error('shipping_address') error @enderror" 
                                  id="shipping_address" 
                                  name="shipping_address" 
                                  rows="3"
                                  style="width: 100%; padding: 12px 15px; border: 2px solid var(--anuta-border); border-radius: 4px; font-size: 16px; transition: border-color 0.3s; resize: vertical;"
                                  required>{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <span style="color: #E57373; font-size: 14px; margin-top: 5px; display: block;">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div style="margin-bottom: 30px;">
                        <label style="display: flex; align-items: center; gap: 10px; cursor: pointer;">
                            <input type="checkbox" id="agreeTerms" required style="width: 18px; height: 18px; cursor: pointer;">
                            <span style="font-size: 14px; color: var(--anuta-text-light);">
                                주문 내용을 확인했으며, 결제 진행에 동의합니다.
                            </span>
                        </label>
                    </div>
                    
                    <button type="submit" class="anuta-btn" style="width: 100%; padding: 15px; font-size: 18px;">
                        <i class="fas fa-credit-card"></i> 결제하기
                    </button>
                </form>
            </div>
        </div>
        
        <!-- 주문 요약 -->
        <div>
            <!-- 주문 상품 요약 -->
            <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 20px;">
                <h4 style="font-size: 20px; font-weight: 600; margin-bottom: 20px; color: var(--anuta-text);">주문 요약</h4>
                
                @foreach($cart as $item)
                    <div style="display: flex; justify-content: space-between; align-items: center; padding: 10px 0; border-bottom: 1px solid var(--anuta-border);">
                        <div>
                            <strong style="display: block; margin-bottom: 5px;">{{ $item['name'] }}</strong>
                            <small style="color: var(--anuta-text-light);">수량: {{ $item['quantity'] }}개</small>
                        </div>
                        <span style="font-weight: 500;">₩{{ number_format($item['subtotal']) }}</span>
                    </div>
                @endforeach
                
                <div style="padding: 15px 0; border-bottom: 1px solid var(--anuta-border);">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span>배송비</span>
                        <span style="color: var(--anuta-primary); font-weight: 500;">무료</span>
                    </div>
                </div>
                
                <div style="padding-top: 20px;">
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <h5 style="font-size: 18px; font-weight: 600;">총 결제금액</h5>
                        <h5 style="font-size: 24px; font-weight: 700; color: var(--anuta-primary);">₩{{ number_format($total) }}</h5>
                    </div>
                </div>
            </div>
            
            <!-- 결제 수단 안내 -->
            <div style="background: white; border-radius: 8px; padding: 25px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                <h5 style="font-size: 18px; font-weight: 600; margin-bottom: 15px; color: var(--anuta-text);">결제 수단</h5>
                <p style="font-size: 14px; line-height: 1.6; color: var(--anuta-text-light); margin-bottom: 20px;">
                    토스페이먼츠를 통해 안전하게 결제됩니다.<br>
                    신용카드, 체크카드, 간편결제 등 다양한 결제수단을 지원합니다.
                </p>
                <div style="text-align: center;">
                    <img src="https://static.toss.im/3d-emojis/u1F4B3-apng.png" alt="Toss" style="width: 60px;">
                </div>
            </div>
        </div>
    </div>
</div>

<!-- 입력 필드 포커스 스타일 -->
<style>
    input:focus,
    textarea:focus {
        outline: none;
        border-color: var(--anuta-primary) !important;
    }
    
    input.error,
    textarea.error {
        border-color: #E57373 !important;
    }
    
    /* 체크박스 스타일 */
    input[type="checkbox"] {
        accent-color: var(--anuta-primary);
    }
    
    /* 반응형 디자인 */
    @media (max-width: 768px) {
        .anuta-container > div:nth-child(2) {
            grid-template-columns: 1fr;
            gap: 30px;
        }
        
        .anuta-container > div:nth-child(2) > div:first-child {
            order: 2;
        }
        
        .anuta-container > div:nth-child(2) > div:last-child {
            order: 1;
        }
    }
</style>

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

// 전화번호 자동 포맷팅
document.getElementById('customer_phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/[^0-9]/g, '');
    let formattedValue = '';
    
    if (value.length <= 3) {
        formattedValue = value;
    } else if (value.length <= 7) {
        formattedValue = value.slice(0, 3) + '-' + value.slice(3);
    } else if (value.length <= 11) {
        formattedValue = value.slice(0, 3) + '-' + value.slice(3, 7) + '-' + value.slice(7);
    }
    
    e.target.value = formattedValue;
});
</script>
@endpush
@endsection
