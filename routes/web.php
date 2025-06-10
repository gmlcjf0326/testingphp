<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;

// 홈페이지 - 상품 목록 (3x3 그리드)
Route::get('/', [ProductController::class, 'index'])->name('products.index');

// 상품 상세 페이지
Route::get('/product/{id}', [ProductController::class, 'show'])->name('products.show');

// 장바구니 관련 라우트
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{id}', [CartController::class, 'add'])->name('cart.add');
    Route::delete('/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/clear', [CartController::class, 'clear'])->name('cart.clear');
});

// 로그인 필요한 라우트들
Route::middleware(['auth'])->group(function () {
    // 결제 관련
    Route::prefix('checkout')->group(function () {
        Route::get('/', [CheckoutController::class, 'index'])->name('checkout.index');
        Route::post('/process', [CheckoutController::class, 'process'])->name('checkout.process');
    });
    
    // 주문 관련
    Route::prefix('orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('orders.show');
    });
});

// 결제 콜백 (인증 불필요)
Route::get('/payment/success', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/payment/fail', [CheckoutController::class, 'fail'])->name('checkout.fail');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 관리자 라우트
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // 관리자 대시보드
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // 상품 관리
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
});

require __DIR__.'/auth.php';
