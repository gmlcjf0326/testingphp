<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ReviewController;

/*
|--------------------------------------------------------------------------
| 메인 사이트 (뮤지토리)
|--------------------------------------------------------------------------
*/

// 메인 홈페이지 - 뮤지토리
Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/about', [MainController::class, 'about'])->name('about');
Route::get('/programs', [ProgramController::class, 'index'])->name('programs.index');
Route::get('/programs/{id}', [ProgramController::class, 'show'])->name('programs.show');
Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
Route::get('/teachers/{id}', [TeacherController::class, 'show'])->name('teachers.show');
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');
Route::post('/inquiry', [MainController::class, 'inquiry'])->name('inquiry.store');

/*
|--------------------------------------------------------------------------
| 예약 시스템
|--------------------------------------------------------------------------
*/
// 시간대 조회는 인증 없이 가능
Route::get('/bookings/available-slots', [App\Http\Controllers\BookingController::class, 'getAvailableSlots'])->name('bookings.available-slots');

Route::middleware(['auth'])->prefix('bookings')->name('bookings.')->group(function () {
    Route::get('/create/{program}', [App\Http\Controllers\BookingController::class, 'create'])->name('create');
    Route::post('/store', [App\Http\Controllers\BookingController::class, 'store'])->name('store');
    Route::get('/{booking}/payment', [App\Http\Controllers\BookingController::class, 'payment'])->name('payment');
    Route::post('/{booking}/payment/process', [App\Http\Controllers\BookingController::class, 'processPayment'])->name('payment.process');
    Route::get('/payment/success', [App\Http\Controllers\BookingController::class, 'paymentSuccess'])->name('payment.success');
    Route::get('/payment/fail', [App\Http\Controllers\BookingController::class, 'paymentFail'])->name('payment.fail');
    Route::get('/{booking}/complete', [App\Http\Controllers\BookingController::class, 'complete'])->name('complete');
    Route::get('/my-bookings', [App\Http\Controllers\BookingController::class, 'myBookings'])->name('index');
    Route::get('/{booking}', [App\Http\Controllers\BookingController::class, 'show'])->name('show');
    Route::post('/{booking}/cancel', [App\Http\Controllers\BookingController::class, 'cancel'])->name('cancel');
});

/*
|--------------------------------------------------------------------------
| 쇼핑몰 (교재 구매)
|--------------------------------------------------------------------------
*/
Route::prefix('shop')->name('shop.')->group(function () {
    // 쇼핑몰 홈 - 상품 목록 (3x3 그리드)
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
});

/*
|--------------------------------------------------------------------------
| 인증 관련
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| 관리자
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // 관리자 대시보드
    Route::get('/', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    // 상품 관리
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    
    // 프로그램 관리
    Route::resource('programs', App\Http\Controllers\Admin\ProgramController::class);
    
    // 선생님 관리
    Route::resource('teachers', App\Http\Controllers\Admin\TeacherController::class);
    
    // 리뷰 관리
    Route::resource('reviews', App\Http\Controllers\Admin\ReviewController::class);
});

require __DIR__.'/auth.php';
