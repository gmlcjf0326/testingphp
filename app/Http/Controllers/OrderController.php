<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * 사용자의 주문 목록
     */
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['orderItems.product', 'payment'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('orders.index', compact('orders'));
    }

    /**
     * 주문 상세 정보
     */
    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())
            ->with(['orderItems.product', 'payment'])
            ->findOrFail($id);
            
        return view('orders.show', compact('order'));
    }
}
