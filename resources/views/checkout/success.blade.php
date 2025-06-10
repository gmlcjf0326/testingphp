@extends('layouts.shop')

@section('title', '결제 완료 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <div style="max-width: 800px; margin: 0 auto;">
        <!-- 성공 메시지 -->
        <div style="background: white; border-radius: 8px; padding: 60px 40px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); text-align: center; margin-bottom: 30px;">
            <i class="fas fa-check-circle" style="font-size: 80px; color: #66BB6A; margin-bottom: 30px; display: block;"></i>
            
            <h1 style="font-size: 36px; font-weight: 700; margin-bottom: 20px; color: var(--anuta-text);">
                결제가 완료되었습니다!
            </h1>
            
            <div style="margin-bottom: 30px;">
                <p style="font-size: 18px; color: var(--anuta-text-light); margin-bottom: 10px;">
                    주문번호: <strong style="color: var(--anuta-text);">{{ $order->order_number }}</strong>
                </p>
                <p style="font-size: 24px; font-weight: 600; color: var(--anuta-primary);">
                    결제금액: ₩{{ number_format($order->total_amount) }}
                </p>
            </div>
            
            <div style="background: #E8F5E9; border-radius: 8px; padding: 20px; margin-bottom: 30px;">
                <i class="fas fa-info-circle" style="color: #2E7D32; margin-right: 10px;"></i>
                <span style="color: #2E7D32;">
                    주문 내역은 이메일로 발송되었습니다.<br>
                    배송은 결제 완료 후 2-3일 내에 시작됩니다.
                </span>
            </div>
            
            @if($payment->receipt_url)
                <div style="margin-bottom: 30px;">
                    <a href="{{ $payment->receipt_url }}" target="_blank" class="anuta-btn-outline" style="padding: 10px 30px;">
                        <i class="fas fa-receipt"></i> 영수증 보기
                    </a>
                </div>
            @endif
            
            <div style="display: flex; gap: 15px; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('shop.orders.show', $order->id) }}" class="anuta-btn" style="padding: 12px 30px;">
                    <i class="fas fa-box"></i> 주문 상세보기
                </a>
                <a href="{{ route('shop.products.index') }}" class="anuta-btn-outline" style="padding: 12px 30px;">
                    <i class="fas fa-shopping-bag"></i> 쇼핑 계속하기
                </a>
            </div>
        </div>
        
        <!-- 주문 상품 요약 -->
        <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <h3 style="font-size: 24px; font-weight: 600; margin-bottom: 25px; color: var(--anuta-text);">주문 상품</h3>
            
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--anuta-border);">
                        <th style="padding: 15px 10px; text-align: left; font-weight: 600; color: var(--anuta-text);">상품명</th>
                        <th style="padding: 15px 10px; text-align: center; font-weight: 600; color: var(--anuta-text);">수량</th>
                        <th style="padding: 15px 10px; text-align: center; font-weight: 600; color: var(--anuta-text);">가격</th>
                        <th style="padding: 15px 10px; text-align: right; font-weight: 600; color: var(--anuta-text);">소계</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr style="border-bottom: 1px solid var(--anuta-border);">
                            <td style="padding: 15px 10px;">{{ $item->product->name }}</td>
                            <td style="padding: 15px 10px; text-align: center;">{{ $item->quantity }}</td>
                            <td style="padding: 15px 10px; text-align: center;">₩{{ number_format($item->price) }}</td>
                            <td style="padding: 15px 10px; text-align: right;">₩{{ number_format($item->subtotal) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" style="padding: 20px 10px; text-align: right; font-size: 18px; font-weight: 600;">
                            총액:
                        </td>
                        <td style="padding: 20px 10px; text-align: right; font-size: 20px; font-weight: 700; color: var(--anuta-primary);">
                            ₩{{ number_format($order->total_amount) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<!-- 추가 스타일 -->
<style>
    /* 테이블 호버 효과 */
    tbody tr:hover {
        background-color: rgba(255, 107, 53, 0.05);
    }
    
    /* 반응형 테이블 */
    @media (max-width: 768px) {
        table {
            font-size: 14px;
        }
        
        th, td {
            padding: 10px 5px !important;
        }
        
        .anuta-container h1 {
            font-size: 28px !important;
        }
    }
</style>
@endsection
