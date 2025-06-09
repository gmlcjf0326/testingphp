<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class CheckoutController extends Controller
{
    /**
     * 결제 페이지 표시
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
                    'id' => $item->product_id,
                    'name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->product->price * $item->quantity
                ];
                $total += $item->product->price * $item->quantity;
            }
        } else {
            // 비로그인 사용자는 로그인 페이지로 리다이렉트
            return redirect()->route('login')->with('error', '결제를 위해서는 로그인이 필요합니다.');
        }
        
        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', '장바구니가 비어있습니다.');
        }
        
        return view('checkout.index', compact('cart', 'total'));
    }

    /**
     * 주문 생성 및 결제 준비
     */
    public function process(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string',
        ]);

        try {
            DB::beginTransaction();

            // 장바구니 상품 조회
            $cartItems = Cart::with('product')
                ->where('user_id', Auth::id())
                ->get();

            if ($cartItems->isEmpty()) {
                throw new \Exception('장바구니가 비어있습니다.');
            }

            // 총 금액 계산
            $totalAmount = 0;
            foreach ($cartItems as $item) {
                $totalAmount += $item->product->price * $item->quantity;
            }

            // 주문 생성
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $totalAmount,
                'status' => 'pending',
                'customer_name' => $request->customer_name,
                'customer_email' => Auth::user()->email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
            ]);

            // 주문 상품 생성
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price,
                    'subtotal' => $item->product->price * $item->quantity,
                ]);
            }

            // 결제 정보 생성
            $payment = Payment::create([
                'order_id' => $order->id,
                'amount' => $totalAmount,
                'status' => 'ready',
            ]);

            DB::commit();

            // 토스페이먼츠 결제 페이지로 이동
            return view('checkout.payment', [
                'order' => $order,
                'totalAmount' => $totalAmount,
                'clientKey' => config('tosspayments.sandbox') 
                    ? config('tosspayments.test.client_key') 
                    : config('tosspayments.live.client_key'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', '주문 처리 중 오류가 발생했습니다: ' . $e->getMessage());
        }
    }

    /**
     * 결제 성공 처리
     */
    public function success(Request $request)
    {
        $paymentKey = $request->input('paymentKey');
        $orderId = $request->input('orderId');
        $amount = $request->input('amount');

        try {
            // 주문 조회
            $order = Order::where('order_number', $orderId)->firstOrFail();
            $payment = $order->payment;

            // 토스페이먼츠 결제 승인 API 호출
            $secretKey = config('tosspayments.sandbox') 
                ? config('tosspayments.test.secret_key') 
                : config('tosspayments.live.secret_key');

            $response = Http::withBasicAuth($secretKey, '')
                ->post(config('tosspayments.api_url') . '/payments/confirm', [
                    'paymentKey' => $paymentKey,
                    'orderId' => $orderId,
                    'amount' => $amount,
                ]);

            if ($response->successful()) {
                $paymentData = $response->json();

                // 결제 정보 업데이트
                $payment->update([
                    'payment_key' => $paymentKey,
                    'order_id_toss' => $paymentData['orderId'],
                    'method' => $paymentData['method'] ?? null,
                    'status' => 'done',
                    'receipt_url' => $paymentData['receipt']['url'] ?? null,
                    'raw_data' => $paymentData,
                    'approved_at' => now(),
                ]);

                // 주문 상태 업데이트
                $order->update(['status' => 'paid']);

                // 장바구니 비우기
                Cart::where('user_id', Auth::id())->delete();

                return view('checkout.success', compact('order', 'payment'));
            } else {
                throw new \Exception('결제 승인 실패: ' . $response->body());
            }

        } catch (\Exception $e) {
            // 결제 실패 처리
            if (isset($payment)) {
                $payment->update(['status' => 'failed']);
            }
            if (isset($order)) {
                $order->update(['status' => 'failed']);
            }

            return redirect()->route('checkout.fail')->with('error', $e->getMessage());
        }
    }

    /**
     * 결제 실패 처리
     */
    public function fail(Request $request)
    {
        $message = $request->input('message', '결제가 실패했습니다.');
        return view('checkout.fail', compact('message'));
    }
}
