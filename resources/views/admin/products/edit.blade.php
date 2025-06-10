@extends('layouts.admin')

@section('title', '상품 수정')
@section('header', '상품 수정')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="bg-white rounded-lg shadow p-6">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    상품명 <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       name="name" 
                       id="name" 
                       value="{{ old('name', $product->name) }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-admin-primary focus:border-transparent"
                       required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                    상품 설명 <span class="text-red-500">*</span>
                </label>
                <textarea name="description" 
                          id="description" 
                          rows="5"
                          class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-admin-primary focus:border-transparent"
                          required>{{ old('description', $product->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                        가격 (₩) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="price" 
                           id="price" 
                           value="{{ old('price', $product->price) }}"
                           min="0"
                           step="100"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-admin-primary focus:border-transparent"
                           required>
                    @error('price')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="stock" class="block text-sm font-medium text-gray-700 mb-2">
                        재고 수량 <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="stock" 
                           id="stock" 
                           value="{{ old('stock', $product->stock) }}"
                           min="0"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-admin-primary focus:border-transparent"
                           required>
                    @error('stock')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="mb-6">
                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">
                    상품 이미지
                </label>
                
                <!-- 현재 이미지 -->
                <div class="mb-4">
                    <p class="text-sm text-gray-500 mb-2">현재 이미지:</p>
                    <img src="{{ $product->image }}" alt="{{ $product->name }}" class="max-w-xs rounded-lg shadow">
                </div>

                <div class="mt-1 flex items-center">
                    <input type="file" 
                           name="image" 
                           id="image"
                           accept="image/*"
                           onchange="previewImage(this)"
                           class="block w-full text-sm text-gray-500
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-sm file:font-semibold
                                  file:bg-admin-primary file:text-white
                                  hover:file:bg-orange-600">
                </div>
                <p class="mt-1 text-sm text-gray-500">
                    새 이미지를 업로드하면 기존 이미지가 교체됩니다. (JPG, PNG, 최대 2MB)
                </p>
                @error('image')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
                
                <!-- 이미지 미리보기 -->
                <div id="imagePreview" class="mt-4 hidden">
                    <p class="text-sm text-gray-500 mb-2">새 이미지 미리보기:</p>
                    <img id="preview" src="" alt="미리보기" class="max-w-xs rounded-lg shadow">
                </div>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.products.index') }}" 
                   class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition-colors">
                    취소
                </a>
                <button type="submit" 
                        class="px-4 py-2 bg-admin-primary text-white rounded-md hover:bg-orange-600 transition-colors">
                    수정 완료
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('preview');
    const previewDiv = document.getElementById('imagePreview');
    
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.src = e.target.result;
            previewDiv.classList.remove('hidden');
        }
        
        reader.readAsDataURL(input.files[0]);
    } else {
        previewDiv.classList.add('hidden');
    }
}
</script>
@endsection
