@extends('layouts.admin')

@section('title', '상품 상세')
@section('header', '상품 상세')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="md:flex">
            <div class="md:w-1/2">
                <img src="{{ $product->image }}" 
                     alt="{{ $product->name }}" 
                     class="w-full h-full object-cover">
            </div>
            <div class="md:w-1/2 p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">{{ $product->name }}</h2>
                
                <div class="mb-6">
                    <span class="text-3xl font-bold text-admin-primary">₩{{ number_format($product->price) }}</span>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">상품 설명</h3>
                    <p class="text-gray-700 whitespace-pre-line">{{ $product->description }}</p>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">재고 현황</h3>
                    <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full
                          @if($product->stock > 10) bg-green-100 text-green-800
                          @elseif($product->stock > 0) bg-yellow-100 text-yellow-800
                          @else bg-red-100 text-red-800 @endif">
                        재고: {{ $product->stock }}개
                    </span>
                </div>

                <div class="mb-6">
                    <h3 class="text-lg font-semibold mb-2">등록 정보</h3>
                    <p class="text-sm text-gray-600">
                        등록일: {{ $product->created_at->format('Y년 m월 d일 H:i') }}<br>
                        수정일: {{ $product->updated_at->format('Y년 m월 d일 H:i') }}
                    </p>
                </div>

                <div class="flex space-x-3">
                    <a href="{{ route('admin.products.edit', $product) }}" 
                       class="flex-1 bg-admin-primary text-white text-center px-4 py-2 rounded-md hover:bg-orange-600 transition-colors">
                        수정하기
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" 
                          method="POST" 
                          class="flex-1"
                          onsubmit="return confirm('정말 삭제하시겠습니까?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="w-full bg-red-600 text-white px-4 py-2 rounded-md hover:bg-red-700 transition-colors">
                            삭제하기
                        </button>
                    </form>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.products.index') }}" 
                       class="inline-flex items-center text-gray-600 hover:text-gray-900">
                        <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                  d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        목록으로 돌아가기
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
