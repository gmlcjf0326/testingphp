@extends('layouts.shop')

@section('title', '장바구니 - ANUTA SHOP')

@section('content')
<div class="anuta-container">
    <h1 class="page-title">Cart</h1>
    
    @if(count($cart) > 0)
        <!-- 장바구니 테이블 -->
        <div style="background: white; border-radius: 8px; padding: 30px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);">
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid var(--anuta-border);">
                        <th style="padding: 15px 10px; text-align: left; font-weight: 600; color: var(--anuta-text);">상품</th>
                        <th style="padding: 15px 10px; text-align: left; font-weight: 600; color: var(--anuta-text);">상품명</th>
                        <th style="padding: 15px 10px; text-align: center; font-weight: 600; color: var(--anuta-text);">가격</th>
                        <th style="padding: 15px 10px; text-align: center; font-weight: 600; color: var(--anuta-text);">수량</th>
                        <th style="padding: 15px 10px; text-align: center; font-weight: 600; color: var(--anuta-text);">소계</th>
                        <th style="padding: 15px 10px; text-align: center; font-weight: 600; color: var(--anuta-text);">삭제</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $id => $item)
                        <tr style="border-bottom: 1px solid var(--anuta-border);">
                            <!-- 상품 이미지 -->
                            <td style="padding: 20px 10px;">
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" 
                                     style="width: 80px; height: 80px; object-fit: cover; border-radius: 4px;">
                            </td>
                            
                            <!-- 상품명 -->
                            <td style="padding: 20px 10px;">
                                <a href="{{ route('products.show', $id) }}" 
                                   style="color: var(--anuta-text); text-decoration: none; font-weight: 500; transition: color 0.3s;">
                                    {{ $item['name'] }}
                                </a>
                            </td>
                            
                            <!-- 가격 -->
                            <td style="padding: 20px 10px; text-align: center;">
                                ₩{{ number_format($item['price']) }}
                            </td>
                            
                            <!-- 수량 -->
                            <td style="padding: 20px 10px; text-align: center;">
                                {{ $item['quantity'] }}
                            </td>
                            
                            <!-- 소계 -->
                            <td style="padding: 20px 10px; text-align: center; font-weight: 600; color: var(--anuta-primary);">
                                ₩{{ number_format($item['price'] * $item['quantity']) }}
                            </td>
                            
                            <!-- 삭제 버튼 -->
                            <td style="padding: 20px 10px; text-align: center;">
                                <form action="{{ route('cart.remove', $id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            style="background: none; border: none; color: #E57373; cursor: pointer; font-size: 18px; transition: color 0.3s;"
                                            onclick="return confirm('정말 삭제하시겠습니까?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" style="padding: 20px 10px; text-align: right; font-size: 20px; font-weight: 600;">
                            총 금액:
                        </td>
                        <td colspan="2" style="padding: 20px 10px; text-align: center; font-size: 24px; font-weight: 700; color: var(--anuta-primary);">
                            ₩{{ number_format($total) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        
        <!-- 버튼 그룹 -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 40px; flex-wrap: wrap; gap: 20px;">
            <div style="display: flex; gap: 15px; flex-wrap: wrap;">
                <a href="{{ route('products.index') }}" class="anuta-btn-outline">
                    <i class="fas fa-arrow-left"></i> 쇼핑 계속하기
                </a>
                
                <form action="{{ route('cart.clear') }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="anuta-btn-outline" 
                            style="background: none; border: 2px solid #E57373; color: #E57373;"
                            onclick="return confirm('장바구니를 비우시겠습니까?')">
                        <i class="fas fa-trash-alt"></i> 장바구니 비우기
                    </button>
                </form>
            </div>
            
            <div>
                @auth
                    <a href="{{ route('checkout.index') }}" class="anuta-btn" style="padding: 15px 40px; font-size: 18px;">
                        <i class="fas fa-credit-card"></i> 결제하기
                    </a>
                @else
                    <a href="{{ route('login') }}" class="anuta-btn" style="padding: 15px 40px; font-size: 18px;">
                        <i class="fas fa-sign-in-alt"></i> 로그인 후 결제
                    </a>
                @endauth
            </div>
        </div>
    @else
        <!-- 장바구니가 비어있을 때 -->
        <div style="text-align: center; padding: 80px 20px;">
            <i class="fas fa-shopping-cart" style="font-size: 80px; color: var(--anuta-text-light); margin-bottom: 20px; display: block;"></i>
            <h3 style="color: var(--anuta-text); font-weight: 400; margin-bottom: 10px;">장바구니가 비어있습니다.</h3>
            <p style="color: var(--anuta-text-light); margin-bottom: 30px;">원하시는 상품을 장바구니에 담아보세요!</p>
            <a href="{{ route('products.index') }}" class="anuta-btn">
                <i class="fas fa-shopping-bag"></i> 쇼핑하러 가기
            </a>
        </div>
    @endif
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
    
    /* 삭제 버튼 호버 효과 */
    tbody button:hover {
        color: #C62828 !important;
    }
    
    /* 반응형 디자인 */
    @media (max-width: 768px) {
        .anuta-container > div:first-child {
            overflow-x: auto;
        }
        
        table {
            min-width: 600px;
        }
        
        .page-title {
            font-size: 32px;
        }
        
        /* 버튼 그룹 모바일 */
        .anuta-container > div:last-child {
            flex-direction: column;
            align-items: stretch;
        }
        
        .anuta-container > div:last-child > div {
            width: 100%;
            text-align: center;
        }
        
        .anuta-btn, .anuta-btn-outline {
            width: 100%;
            display: block;
        }
    }
</style>
@endsection
