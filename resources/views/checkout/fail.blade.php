@extends('layouts.shop')

@section('title', '결제 실패 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <div style="max-width: 600px; margin: 0 auto;">
        <div style="background: white; border-radius: 8px; padding: 60px 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); text-align: center;">
            <i class="fas fa-times-circle" style="font-size: 80px; color: #E57373; margin-bottom: 30px; display: block;"></i>
            
            <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 20px; color: var(--anuta-text);">
                결제에 실패했습니다
            </h1>
            
            <p style="font-size: 18px; color: var(--anuta-text-light); margin-bottom: 30px; line-height: 1.6;">
                {{ $message ?? '결제 처리 중 문제가 발생했습니다.' }}
            </p>
            
            @if(session('error'))
                <div style="background: #FFEBEE; border: 1px solid #FFCDD2; border-radius: 4px; padding: 15px 20px; margin-bottom: 30px;">
                    <p style="color: #C62828; margin: 0;">{{ session('error') }}</p>
                </div>
            @endif
            
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; margin-bottom: 40px;">
                <a href="{{ route('cart.index') }}" class="anuta-btn" style="padding: 12px 30px;">
                    <i class="fas fa-shopping-cart"></i> 장바구니로 돌아가기
                </a>
                <a href="{{ route('products.index') }}" class="anuta-btn-outline" style="padding: 12px 30px;">
                    <i class="fas fa-home"></i> 홈으로
                </a>
            </div>
            
            <div style="border-top: 1px solid var(--anuta-border); padding-top: 30px;">
                <p style="color: var(--anuta-text-light); font-size: 14px; line-height: 1.6; margin-bottom: 10px;">
                    결제 관련 문의사항이 있으시면<br>
                    고객센터로 연락 주시기 바랍니다.
                </p>
                <p style="font-size: 18px; font-weight: 600; color: var(--anuta-text);">
                    <i class="fas fa-phone" style="color: var(--anuta-primary); margin-right: 8px;"></i>
                    042-867-1589
                </p>
                <p style="color: var(--anuta-text-light); font-size: 14px;">
                    평일 09:00~18:00
                </p>
            </div>
        </div>
    </div>
</div>

<!-- 추가 스타일 -->
<style>
    @media (max-width: 768px) {
        .anuta-container h1 {
            font-size: 28px !important;
        }
        
        .anuta-container > div > div {
            padding: 40px 20px !important;
        }
    }
</style>
@endsection
