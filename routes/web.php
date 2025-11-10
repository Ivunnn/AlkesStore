<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\UserController;


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

    Route::get('/products', [ProductController::class, 'userIndex'])->name('user.products.index');
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('user.products.show');


    // 🛍️ Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{productId}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('cart.destroy');

    // 💳 Orders
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('orders.checkout');
    Route::post('/checkout', [OrderController::class, 'store'])->name('orders.store');
    Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');

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

    Route::get('/admin/shops', [ShopController::class, 'index'])->name('admin.shops.index');
    Route::get('/admin/shops/create', [ShopController::class, 'create'])->name('admin.shops.create');
    Route::post('/admin/shops', [ShopController::class, 'store'])->name('admin.shops.store');
    Route::post('/admin/shops/{id}/update-status', [ShopController::class, 'updateStatus'])->name('shops.updateStatus');

    // 🛒 Products
    Route::get('/admin/products', [ProductController::class, 'index'])->name('admin.products.index');
    Route::get('/admin/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/admin/products', [ProductController::class, 'store'])->name('admin.products.store');
    Route::delete('/admin/products/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

    Route::resource('admin/users', UserController::class)->names([
        'index' => 'admin.users.index',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ])->except(['create', 'store', 'show']);
});


