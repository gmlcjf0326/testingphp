<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * 장바구니 보기
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cart = [];
        $total = 0;
        
        if (Auth::check()) {
            // 로그인한 사용자는 DB에서 장바구니 조회
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();
            
            foreach ($cartItems as $item) {
                $cart[$item->product_id] = [
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'image' => $item->product->image,
                    'quantity' => $item->quantity
                ];
                $total += $item->product->price * $item->quantity;
            }
        } else {
            // 비로그인 사용자는 세션에서 장바구니 조회
            $cart = session()->get('cart', []);
            foreach ($cart as $item) {
                $total += $item['price'] * $item['quantity'];
            }
        }
        
        return view('cart.index', compact('cart', 'total'));
    }

    /**
     * 장바구니에 상품 추가
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        if (Auth::check()) {
            // 로그인한 사용자는 DB에 저장
            $cartItem = Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->first();
            
            if ($cartItem) {
                // 이미 있는 상품이면 수량 증가
                $cartItem->increment('quantity');
            } else {
                // 새로운 상품 추가
                Cart::create([
                    'user_id' => Auth::id(),
                    'product_id' => $id,
                    'quantity' => 1
                ]);
            }
        } else {
            // 비로그인 사용자는 세션에 저장
            $cart = session()->get('cart', []);
            
            if (isset($cart[$id])) {
                $cart[$id]['quantity']++;
            } else {
                $cart[$id] = [
                    'name' => $product->name,
                    'price' => $product->price,
                    'image' => $product->image,
                    'quantity' => 1
                ];
            }
            
            session()->put('cart', $cart);
        }
        
        return redirect()->back()->with('success', '상품이 장바구니에 추가되었습니다!');
    }

    /**
     * 장바구니에서 상품 제거
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove($id)
    {
        if (Auth::check()) {
            // 로그인한 사용자는 DB에서 삭제
            Cart::where('user_id', Auth::id())
                ->where('product_id', $id)
                ->delete();
        } else {
            // 비로그인 사용자는 세션에서 삭제
            $cart = session()->get('cart', []);
            
            if (isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
        }
        
        return redirect()->back()->with('success', '상품이 장바구니에서 제거되었습니다!');
    }

    /**
     * 장바구니 비우기
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function clear()
    {
        if (Auth::check()) {
            // 로그인한 사용자는 DB에서 모두 삭제
            Cart::where('user_id', Auth::id())->delete();
        } else {
            // 비로그인 사용자는 세션 비우기
            session()->forget('cart');
        }
        
        return redirect()->back()->with('success', '장바구니가 비워졌습니다!');
    }

    /**
     * 세션 장바구니를 DB로 이전 (로그인 시 호출)
     */
    public static function syncSessionToDatabase()
    {
        if (Auth::check() && session()->has('cart')) {
            $sessionCart = session()->get('cart');
            
            foreach ($sessionCart as $productId => $item) {
                $cartItem = Cart::where('user_id', Auth::id())
                    ->where('product_id', $productId)
                    ->first();
                
                if ($cartItem) {
                    // 기존 아이템이 있으면 수량 더하기
                    $cartItem->increment('quantity', $item['quantity']);
                } else {
                    // 없으면 새로 생성
                    Cart::create([
                        'user_id' => Auth::id(),
                        'product_id' => $productId,
                        'quantity' => $item['quantity']
                    ]);
                }
            }
            
            // 세션 장바구니 비우기
            session()->forget('cart');
        }
    }
}
