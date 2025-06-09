@extends('layouts.shop')

@section('title', '주문 상세 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <!-- 브레드크럼 -->
    <nav style="margin-bottom: 40px;">
        <ol style="list-style: none; display: flex; gap: 15px; font-size: 14px; color: var(--anuta-text-light);">
            <li><a href="{{ route('products.index') }}" style="color: var(--anuta-text-light); text-decoration: none;">홈</a></li>
            <li>/</li>
            <li><a href="{{ route('orders.index') }}" style="color: var(--anuta-text-light); text-decoration: none;">주문 내역</a></li>
            <li>/</li>
            <li style="color: var(--anuta-text);">{{ $order->order_number }}</li>
        </ol>
    </nav>

    <h1 class="page-title">Order Details</h1>
    
    <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
        <!-- 왼쪽: 주문 정보 -->
        <div>
            <!-- 주문 정보 -->
            <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 20px;">
                <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 25px; color: var(--anuta-text);">
                    <i class="fas fa-info-circle" style="color: var(--anuta-primary); margin-right: 10px;"></i>
                    주문 정보
                </h3>
                <div style="display: grid; gap: 15px;">
                    <div style="display: grid; grid-template-columns: 120px 1fr; gap: 15px; padding-bottom: 15px; border-bottom: 1px solid var(--anuta-border);">
                        <span style="font-weight: 500; color: var(--anuta-text);">주문번호:</span>
                        <span style="color: var(--anuta-text-light);">{{ $order->order_number }}</span>
                    </div>
                    <div style="display: grid; grid-template-columns: 120px 1fr; gap: 15px; padding-bottom: 15px; border-bottom: 1px solid var(--anuta-border);">
                        <span style="font-weight: 500; color: var(--anuta-text);">주문일시:</span>
                        <span style="color: var(--anuta-text-light);">{{ $order->created_at->format('Y년 m월 d일 H:i') }}</span>
                    </div>
                    <div style="display: grid; grid-template-columns: 120px 1fr; gap: 15px;">
                        <span style="font-weight: 500; color: var(--anuta-text);">주문상태:</span>
                        <span>
                            @switch($order->status)
                                @case('pending')
                                    <span style="display: inline-block; background: #FFF3CD; color: #856404; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        대기중
                                    </span>
                                    @break
                                @case('paid')
                                    <span style="display: inline-block; background: #D4EDDA; color: #155724; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        결제완료
                                    </span>
                                    @break
                                @case('failed')
                                    <span style="display: inline-block; background: #F8D7DA; color: #721C24; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        결제실패
                                    </span>
                                    @break
                                @case('cancelled')
                                    <span style="display: inline-block; background: #E2E3E5; color: #383D41; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        취소됨
                                    </span>
                                    @break
                                @case('refunded')
                                    <span style="display: inline-block; background: #D1ECF1; color: #0C5460; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        환불됨
                                    </span>
                                    @break
                            @endswitch
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- 배송 정보 -->
            <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 20px;">
                <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 25px; color: var(--anuta-text);">
                    <i class="fas fa-truck" style="color: var(--anuta-primary); margin-right: 10px;"></i>
                    배송 정보
                </h3>
                <div style="display: grid; gap: 15px;">
                    <div style="display: grid; grid-template-columns: 120px 1fr; gap: 15px; padding-bottom: 15px; border-bottom: 1px solid var(--anuta-border);">
                        <span style="font-weight: 500; color: var(--anuta-text);">받는분:</span>
                        <span style="color: var(--anuta-text-light);">{{ $order->customer_name }}</span>
                    </div>
                    <div style="display: grid; grid-template-columns: 120px 1fr; gap: 15px; padding-bottom: 15px; border-bottom: 1px solid var(--anuta-border);">
                        <span style="font-weight: 500; color: var(--anuta-text);">연락처:</span>
                        <span style="color: var(--anuta-text-light);">{{ $order->customer_phone }}</span>
                    </div>
                    <div style="display: grid; grid-template-columns: 120px 1fr; gap: 15px;">
                        <span style="font-weight: 500; color: var(--anuta-text);">배송주소:</span>
                        <span style="color: var(--anuta-text-light);">{{ $order->shipping_address }}</span>
                    </div>
                </div>
            </div>
            
            <!-- 주문 상품 -->
            <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 25px; color: var(--anuta-text);">
                    <i class="fas fa-shopping-bag" style="color: var(--anuta-primary); margin-right: 10px;"></i>
                    주문 상품
                </h3>
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
                                <td style="padding: 15px 10px;">
                                    <a href="{{ route('products.show', $item->product_id) }}" 
                                       style="color: var(--anuta-text); text-decoration: none; font-weight: 500; transition: color 0.3s;">
                                        {{ $item->product->name }}
                                    </a>
                                </td>
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
        
        <!-- 오른쪽: 결제 정보 및 액션 -->
        <div>
            @if($order->payment)
                <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05); margin-bottom: 20px;">
                    <h3 style="font-size: 20px; font-weight: 600; margin-bottom: 25px; color: var(--anuta-text);">
                        <i class="fas fa-credit-card" style="color: var(--anuta-primary); margin-right: 10px;"></i>
                        결제 정보
                    </h3>
                    
                    <div style="display: grid; gap: 15px;">
                        <div>
                            <p style="font-weight: 500; color: var(--anuta-text); margin-bottom: 5px;">결제상태:</p>
                            @switch($order->payment->status)
                                @case('ready')
                                    <span style="display: inline-block; background: #E2E3E5; color: #383D41; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        준비
                                    </span>
                                    @break
                                @case('done')
                                    <span style="display: inline-block; background: #D4EDDA; color: #155724; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        완료
                                    </span>
                                    @break
                                @case('canceled')
                                    <span style="display: inline-block; background: #FFF3CD; color: #856404; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        취소
                                    </span>
                                    @break
                                @case('failed')
                                    <span style="display: inline-block; background: #F8D7DA; color: #721C24; padding: 5px 15px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                        실패
                                    </span>
                                    @break
                            @endswitch
                        </div>
                        
                        @if($order->payment->method)
                            <div>
                                <p style="font-weight: 500; color: var(--anuta-text); margin-bottom: 5px;">결제수단:</p>
                                <p style="color: var(--anuta-text-light); margin: 0;">{{ $order->payment->method }}</p>
                            </div>
                        @endif
                        
                        @if($order->payment->approved_at)
                            <div>
                                <p style="font-weight: 500; color: var(--anuta-text); margin-bottom: 5px;">결제일시:</p>
                                <p style="color: var(--anuta-text-light); margin: 0;">
                                    {{ $order->payment->approved_at->format('Y년 m월 d일 H:i') }}
                                </p>
                            </div>
                        @endif
                        
                        @if($order->payment->receipt_url)
                            <div style="margin-top: 10px;">
                                <a href="{{ $order->payment->receipt_url }}" target="_blank" class="anuta-btn-outline" style="width: 100%; text-align: center;">
                                    <i class="fas fa-receipt"></i> 영수증 보기
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endif
            
            <!-- 주문 작업 -->
            <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                <a href="{{ route('orders.index') }}" class="anuta-btn-outline" style="width: 100%; text-align: center; margin-bottom: 10px;">
                    <i class="fas fa-list"></i> 주문 목록
                </a>
                <a href="{{ route('products.index') }}" class="anuta-btn" style="width: 100%; text-align: center;">
                    <i class="fas fa-shopping-bag"></i> 쇼핑 계속하기
                </a>
            </div>
        </div>
    </div>
</div>

<!-- 추가 스타일 -->
<style>
    /* 테이블 호버 효과 */
    tbody tr:hover {
        background-color: rgba(255, 107, 53, 0.05);
    }
    
    /* 상품명 호버 효과 */
    tbody a:hover {
        color: var(--anuta-primary) !important;
    }
    
    /* 반응형 디자인 */
    @media (max-width: 768px) {
        .anuta-container > div:nth-child(3) {
            grid-template-columns: 1fr;
            gap: 20px;
        }
        
        .anuta-container table {
            font-size: 14px;
        }
        
        .anuta-container th,
        .anuta-container td {
            padding: 10px 5px !important;
        }
        
        /* 주문 정보 그리드 모바일 */
        .anuta-container > div:nth-child(3) > div > div > div > div {
            grid-template-columns: 1fr;
            gap: 5px;
        }
    }
</style>
@endsection
