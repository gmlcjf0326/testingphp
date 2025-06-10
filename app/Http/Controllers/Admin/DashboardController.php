<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * 관리자 대시보드 표시
     */
    public function index()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'total_users' => User::where('is_admin', false)->count(),
            'recent_orders' => Order::with(['user', 'items.product'])
                ->latest()
                ->take(5)
                ->get(),
            'low_stock_products' => Product::where('stock', '<', 10)
                ->orderBy('stock')
                ->get(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
