<?php
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/shop', [ShopController::class, 'index'])
    ->name('shop');

//CATEGORY CONTROLLER
// Public Routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');

// Category Shop
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('shop.category');

// Admin Routes (you can put inside admin middleware group)
Route::prefix('admin')->group(function () {
    Route::resource('categories', CategoryController::class)->names([
        'index'   => 'admin.categories',
        'create'  => 'admin.categories.create',
        'store'   => 'admin.categories.store',
        'edit'    => 'admin.categories.edit',
        'update'  => 'admin.categories.update',
        'destroy' => 'admin.categories.destroy',
    ]);
});

//PRODUCT CONTROLLER
Route::middleware(['auth'])->group(function () {

    Route::get('/admin/product', [ProductController::class, 'index'])
        ->name('admin.product');

    Route::post('/admin/product', [ProductController::class, 'store'])
        ->name('admin.product.store');

});
Route::put('/admin/products/{product}',
    [ProductController::class, 'update'])
    ->name('admin.product.update');

Route::delete('/admin/products/{product}',
    [ProductController::class, 'destroy'])
    ->name('admin.product.destroy');

//CART CONTROLLER
Route::post('/cart/add/{product}', [CartController::class, 'add'])
    ->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart');

Route::post('/cart/increase/{id}', [CartController::class, 'increase'])->name('cart.increase');

Route::post('/cart/decrease/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

//CHECKOUT CONTROLLER
Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name('checkout');
Route::post('/checkout', [CheckoutController::class, 'store'])
    ->name('checkout.store');

//ORDER CONTROLLER
Route::middleware(['auth'])->group(function () {

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders.index');

});
Route::get('/orders/{order}', [OrderController::class, 'show'])
    ->name('orders.show');

//ORDER MANAGEMENT
use App\Http\Controllers\Admin\OrderManagementController;

Route::get('/admin/orders',
    [OrderManagementController::class, 'index'])
    ->name('admin.orders');

Route::put('/admin/orders/{order}/status',
    [OrderManagementController::class, 'updateStatus'])
    ->name('admin.orders.status');
//GCASH
Route::get('/gcash-payment', function () {
    return view('gcash');
})->name('gcash.page');

//PROFILE
// Existing profile update (name, email, phone)
Route::patch('/profile',          [ProfileController::class, 'update'])->name('profile.update');

// Dedicated address route
Route::patch('/profile/address',  [ProfileController::class, 'updateAddress'])->name('profile.address');

// Withdrawal request
Route::post('/profile/withdraw',  [ProfileController::class, 'withdraw'])->name('profile.withdraw');
Route::get('/withdraw/choose', function () {
    return view('withdraw.choose');
})->name('withdraw.choose');
Route::middleware(['auth'])->group(function () {

    Route::get('/withdraw/choose',
        [WithdrawalController::class, 'choose'])
        ->name('withdraw.choose');

    Route::get('/withdraw/gcash',
        [WithdrawalController::class, 'gcash'])
        ->name('withdraw.gcash');

    Route::get('/withdraw/bank',
        [WithdrawalController::class, 'bank'])
        ->name('withdraw.bank');

    Route::post('/withdraw/process',
        [WithdrawalController::class, 'process'])
        ->name('withdraw.process');

});



Route::get('/dashboard/stats', [DashboardController::class, 'stats'])
    ->middleware(['auth'])
    ->name('dashboard.stats');
    Route::get('/orders/{order}/cancel', [OrderController::class, 'cancel'])
    ->name('orders.cancel');
require __DIR__.'/auth.php';
