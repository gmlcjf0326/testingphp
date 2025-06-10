@extends('layouts.admin')

@section('title', '상품 관리')
@section('header', '상품 관리')

@section('content')
<div class="mb-6 flex justify-between items-center">
    <h2 class="text-2xl font-semibold">상품 목록</h2>
    <a href="{{ route('admin.products.create') }}" 
       class="bg-admin-primary text-white px-4 py-2 rounded-lg hover:bg-orange-600 transition-colors">
        새 상품 등록
    </a>
</div>

<div class="bg-white rounded-lg shadow overflow-hidden">
    <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    상품
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    가격
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    재고
                </th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    등록일
                </th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                    관리
                </th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @forelse($products as $product)
                <tr>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full object-cover" 
                                     src="{{ $product->image }}" 
                                     alt="{{ $product->name }}">
                            </div>
                            <div class="ml-4">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $product->name }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ Str::limit($product->description, 50) }}
                                </div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <div class="text-sm text-gray-900">₩{{ number_format($product->price) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                              @if($product->stock > 10) bg-green-100 text-green-800
                              @elseif($product->stock > 0) bg-yellow-100 text-yellow-800
                              @else bg-red-100 text-red-800 @endif">
                            {{ $product->stock }}개
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        {{ $product->created_at->format('Y-m-d') }}
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                        <a href="{{ route('admin.products.show', $product) }}" 
                           class="text-indigo-600 hover:text-indigo-900 mr-3">보기</a>
                        <a href="{{ route('admin.products.edit', $product) }}" 
                           class="text-admin-primary hover:text-orange-600 mr-3">수정</a>
                        <form action="{{ route('admin.products.destroy', $product) }}" 
                              method="POST" 
                              class="inline"
                              onsubmit="return confirm('정말 삭제하시겠습니까?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:text-red-900">삭제</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                        등록된 상품이 없습니다.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-6">
    {{ $products->links() }}
</div>
@endsection
