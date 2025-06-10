<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * 상품 목록 표시
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * 상품 생성 폼 표시
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * 새 상품 저장
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = Storage::url($path);
        } else {
            // 기본 이미지 사용
            $validated['image'] = 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400';
        }

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', '상품이 성공적으로 등록되었습니다.');
    }

    /**
     * 상품 상세 표시
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * 상품 수정 폼 표시
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * 상품 정보 업데이트
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // 기존 이미지가 로컬에 저장된 경우 삭제
            if ($product->image && !str_starts_with($product->image, 'http')) {
                Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
            }
            
            $path = $request->file('image')->store('products', 'public');
            $validated['image'] = Storage::url($path);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', '상품이 성공적으로 수정되었습니다.');
    }

    /**
     * 상품 삭제
     */
    public function destroy(Product $product)
    {
        // 로컬에 저장된 이미지인 경우 삭제
        if ($product->image && !str_starts_with($product->image, 'http')) {
            Storage::disk('public')->delete(str_replace('/storage/', '', $product->image));
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', '상품이 성공적으로 삭제되었습니다.');
    }
}
