<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\Vendor\VendorShopController;
use App\Http\Controllers\Vendor\VendorReportController;
use App\Http\Controllers\FeedbackController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// 🔐 Auth
Route::get('/login', function () {
    return view('auth.login');
})->name('login')->middleware('guest');

Route::get('/register', function () {
    return view('auth.register');
})->name('register')->middleware('guest');

Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// 🏪 Shop (Vendor)
Route::middleware('auth')->group(function () {

    // Feedback untuk user (harus login)
        Route::get('/user/feedback', [FeedbackController::class, 'index'])->name('user.feedback');
        Route::post('/user/feedback', [FeedbackController::class, 'store'])->name('user.feedback.store');


    // Feedback untuk admin
    Route::middleware(['auth', 'is_admin'])->group(function () {
        Route::get('/admin/feedback', [FeedbackController::class, 'adminIndex'])->name('admin.feedback.index');
    });

    Route::get('/vendor/dashboard', function () {
        return view('toko.dashboard');
    })->middleware(['auth'])->name('vendor.dashboard');
    Route::prefix('vendor')->middleware(['auth'])->group(function () {
        Route::get('/products', [VendorProductController::class, 'index'])->name('vendor.products.index');
        Route::get('/products/create', [VendorProductController::class, 'create'])->name('vendor.products.create');
        Route::post('/products', [VendorProductController::class, 'store'])->name('vendor.products.store');
        Route::delete('/products/{id}', [VendorProductController::class, 'destroy'])->name('vendor.products.destroy');
    });

    Route::middleware(['auth'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('reports', [\App\Http\Controllers\Vendor\VendorReportController::class, 'index'])->name('reports.index');
        Route::delete('reports/{id}', [\App\Http\Controllers\Vendor\VendorReportController::class, 'destroy'])->name('reports.destroy');
    });


    Route::middleware(['auth'])->prefix('vendor')->name('vendor.')->group(function () {
        Route::get('/shops', [VendorShopController::class, 'index'])->name('shops.index');
        Route::get('/shops/create', [VendorShopController::class, 'create'])->name('shops.create');
        Route::post('/shops', [VendorShopController::class, 'store'])->name('shops.store');
    });

    Route::get('/products', [ProductController::class, 'userIndex'])->name('user.products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('user.products.show');

    // 🛍️ Cart
    Route::prefix('user')->name('user.')->middleware('auth')->group(function () {
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::post('/cart/{productId}', [CartController::class, 'store'])->name('cart.store');
        Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    });

    // 💳 Orders
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('user.orders.checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('user.orders.store');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('user.orders.history');

    Route::middleware(['auth'])->group(function () {
        Route::get('/checkout', [OrderController::class, 'checkout'])->name('user.checkout');
        Route::post('/checkout', [OrderController::class, 'store'])->name('user.checkout.store');
    });


    // Route::get('/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    // Route::post('/reports/generate', [ReportController::class, 'generate'])->name('admin.reports.generate');

});

// 👇 Admin Routes
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    // 📊 Reports
    Route::get('/admin/reports', [ReportController::class, 'index'])->name('admin.reports.index');
    Route::post('/admin/reports/generate', [ReportController::class, 'generate'])->name('admin.reports.generate');
    Route::delete('/admin/reports/{id}', [ReportController::class, 'destroy'])->name('admin.reports.destroy');

     Route::get('/admin/feedback', [FeedbackController::class, 'adminIndex'])->name('admin.feedback.index');

    // Route::get('/admin/shops', [ShopController::class, 'index'])->name('admin.shops.index');
    // Route::get('/admin/shops/create', [ShopController::class, 'create'])->name('admin.shops.create');
    // Route::post('/admin/shops', [ShopController::class, 'store'])->name('admin.shops.store');
    // Route::delete('/shops/{id}', [ShopController::class, 'destroy'])->name('admin.shops.destroy');
    // Route::post('/admin/shops/{id}/update-status', [ShopController::class, 'updateStatus'])->name('shops.updateStatus');

    // 🛒 Products
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::prefix('admin')->name('admin.')->middleware(['auth', 'isAdmin'])->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });
});


