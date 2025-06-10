@extends('layouts.shop')

@section('title', '주문 내역 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <h1 class="page-title">Order History</h1>
    
    @if($orders->count() > 0)
        <div style="display: flex; flex-direction: column; gap: 20px;">
            @foreach($orders as $order)
                <div style="background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
                    <!-- 주문 헤더 -->
                    <div style="padding: 25px 30px; border-bottom: 1px solid var(--anuta-border); background: rgba(255, 107, 53, 0.05);">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                            <div>
                                <h3 style="font-size: 18px; font-weight: 600; margin-bottom: 5px; color: var(--anuta-text);">
                                    주문번호: {{ $order->order_number }}
                                </h3>
                                <p style="font-size: 14px; color: var(--anuta-text-light); margin: 0;">
                                    {{ $order->created_at->format('Y년 m월 d일 H:i') }}
                                </p>
                            </div>
                            <div>
                                @switch($order->status)
                                    @case('pending')
                                        <span style="display: inline-block; background: #FFF3CD; color: #856404; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                            대기중
                                        </span>
                                        @break
                                    @case('paid')
                                        <span style="display: inline-block; background: #D4EDDA; color: #155724; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                            결제완료
                                        </span>
                                        @break
                                    @case('failed')
                                        <span style="display: inline-block; background: #F8D7DA; color: #721C24; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                            결제실패
                                        </span>
                                        @break
                                    @case('cancelled')
                                        <span style="display: inline-block; background: #E2E3E5; color: #383D41; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                            취소됨
                                        </span>
                                        @break
                                    @case('refunded')
                                        <span style="display: inline-block; background: #D1ECF1; color: #0C5460; padding: 8px 20px; border-radius: 20px; font-size: 14px; font-weight: 500;">
                                            환불됨
                                        </span>
                                        @break
                                @endswitch
                            </div>
                        </div>
                    </div>
                    
                    <!-- 주문 내용 -->
                    <div style="padding: 30px;">
                        <div style="display: grid; grid-template-columns: 2fr 1fr; gap: 30px; align-items: start;">
                            <!-- 주문 상품 목록 -->
                            <div>
                                <h4 style="font-size: 16px; font-weight: 600; margin-bottom: 15px; color: var(--anuta-text);">주문 상품</h4>
                                <div style="display: flex; flex-direction: column; gap: 10px;">
                                    @foreach($order->orderItems as $index => $item)
                                        @if($index < 3)
                                            <div style="display: flex; align-items: center; gap: 15px;">
                                                @if($item->product->image)
                                                    <img src="{{ $item->product->image }}" 
                                                         alt="{{ $item->product->name }}"
                                                         style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                                @endif
                                                <div>
                                                    <p style="margin: 0; font-weight: 500; color: var(--anuta-text);">
                                                        {{ $item->product->name }}
                                                    </p>
                                                    <p style="margin: 0; font-size: 14px; color: var(--anuta-text-light);">
                                                        수량: {{ $item->quantity }}개
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                    @if($order->orderItems->count() > 3)
                                        <p style="font-size: 14px; color: var(--anuta-text-light); margin: 10px 0 0;">
                                            외 {{ $order->orderItems->count() - 3 }}개 상품...
                                        </p>
                                    @endif
                                </div>
                            </div>
                            
                            <!-- 주문 금액 및 버튼 -->
                            <div style="text-align: right;">
                                <p style="margin-bottom: 5px; color: var(--anuta-text-light);">총 금액</p>
                                <p style="font-size: 24px; font-weight: 700; color: var(--anuta-primary); margin-bottom: 20px;">
                                    ₩{{ number_format($order->total_amount) }}
                                </p>
                                <a href="{{ route('shop.orders.show', $order->id) }}" class="anuta-btn-outline" style="padding: 10px 25px;">
                                    <i class="fas fa-eye"></i> 상세보기
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- 페이지네이션 -->
        @if($orders->hasPages())
            <div style="margin-top: 40px; text-align: center;">
                {{ $orders->links() }}
            </div>
        @endif
    @else
        <div style="text-align: center; padding: 80px 20px;">
            <i class="fas fa-box-open" style="font-size: 80px; color: var(--anuta-text-light); margin-bottom: 20px; display: block;"></i>
            <h3 style="color: var(--anuta-text); font-weight: 400; margin-bottom: 10px;">주문 내역이 없습니다.</h3>
            <p style="color: var(--anuta-text-light); margin-bottom: 30px;">첫 주문을 해보세요!</p>
            <a href="{{ route('shop.products.index') }}" class="anuta-btn">
                <i class="fas fa-shopping-bag"></i> 쇼핑하러 가기
            </a>
        </div>
    @endif
</div>

<!-- 페이지네이션 스타일 -->
<style>
    /* Laravel 페이지네이션 스타일 커스터마이징 */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 5px;
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .pagination li {
        display: inline-block;
    }
    
    .pagination li a,
    .pagination li span {
        display: block;
        padding: 8px 15px;
        color: var(--anuta-text);
        text-decoration: none;
        border: 1px solid var(--anuta-border);
        border-radius: 4px;
        transition: all 0.3s;
    }
    
    .pagination li a:hover {
        background-color: var(--anuta-bg);
        color: var(--anuta-primary);
        border-color: var(--anuta-primary);
    }
    
    .pagination li.active span {
        background-color: var(--anuta-primary);
        color: white;
        border-color: var(--anuta-primary);
    }
    
    .pagination li.disabled span {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    /* 반응형 디자인 */
    @media (max-width: 768px) {
        .anuta-container > div > div > div:last-child > div {
            grid-template-columns: 1fr;
            text-align: left;
        }
        
        .anuta-container > div > div > div:last-child > div > div:last-child {
            text-align: left;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid var(--anuta-border);
        }
    }
</style>
@endsection
