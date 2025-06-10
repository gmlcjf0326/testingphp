<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    /**
     * 상품 목록 표시 (3x3 그리드)
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        try {
            $products = Product::all();
            return view('products.index', compact('products'));
        } catch (\Exception $e) {
            Log::error('Product index error: ' . $e->getMessage());
            // 에러가 발생하면 빈 배열로라도 페이지를 표시
            $products = collect([]);
            return view('products.index', compact('products'));
        }
    }

    /**
     * 상품 상세 페이지 표시
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('products.show', compact('product'));
        } catch (\Exception $e) {
            Log::error('Product show error: ' . $e->getMessage());
            return redirect()->route('shop.products.index')
                ->with('error', '상품을 찾을 수 없습니다.');
        }
    }
}
