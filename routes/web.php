<?php

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\front\auth\TwoFactorAuthenticationController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CategoryController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\ProfileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;


Route::group([
    'prefix' =>  LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'] // مِيدل ويرز المكتبة هنا!
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/news/{slug}', [HomeController::class, 'postShow'])->name('news.show');

    Route::resource('cart', CartController::class);

    Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
    Route::post('checkout', [CheckoutController::class, 'store']);
    Route::get('auth/user/2fa', [TwoFactorAuthenticationController::class, 'index'])->name('front.2fa');

    Route::post('currency', [CurrencyConverterController::class, 'store'])->name('currency.store');

    require base_path('vendor/laravel/fortify/routes/routes.php');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// require __DIR__ . '/auth.php';
require __DIR__ . '/dashboard.php';
