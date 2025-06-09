@extends('layouts.shop')

@section('title', '결제 실패')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card">
                <div class="card-body py-5">
                    <i class="fas fa-times-circle text-danger" style="font-size: 5rem;"></i>
                    
                    <h1 class="mt-4 mb-3">결제에 실패했습니다</h1>
                    
                    <p class="text-muted mb-4">
                        {{ $message ?? '결제 처리 중 문제가 발생했습니다.' }}
                    </p>
                    
                    @if(session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif
                    
                    <div class="d-grid gap-2 d-md-block mt-4">
                        <a href="{{ route('cart.index') }}" class="btn btn-primary">
                            <i class="fas fa-shopping-cart"></i> 장바구니로 돌아가기
                        </a>
                        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-home"></i> 홈으로
                        </a>
                    </div>
                    
                    <div class="mt-5">
                        <p class="text-muted small">
                            결제 관련 문의사항이 있으시면<br>
                            고객센터로 연락 주시기 바랍니다.<br>
                            <i class="fas fa-phone"></i> 1234-5678
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
