<?php


use App\Http\Controllers\Auth\SocialLoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\front\auth\PasswordController;
use App\Http\Controllers\front\auth\SetPasswordController;
use App\Http\Controllers\front\auth\TwoFactorAuthenticationController;
use App\Http\Controllers\front\BlogController;
use App\Http\Controllers\front\CartController;
use App\Http\Controllers\front\CategoryController;
use App\Http\Controllers\front\CheckoutController;
use App\Http\Controllers\Front\CurrencyConverterController;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\front\OrdersController;
use App\Http\Controllers\front\PaymentsController;
use App\Http\Controllers\front\ProductController;
use App\Http\Controllers\Front\ShopController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StripeWebhooksController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Laravel\Fortify\Fortify;
use Illuminate\Support\Facades\Route;


require base_path('vendor/laravel/fortify/routes/routes.php');

Route::any('stripe/webhook', [StripeWebhooksController::class, 'handle']);

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function () {

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/about-us', [HomeController::class, 'aboutUs'])->name('aboutUs');
    Route::get('/contact-us', [HomeController::class, 'contactUs'])->name('contactUs');
    Route::post('/contact-us', [HomeController::class, 'storeContactUs'])->name('contact.store');

    Route::get('/blogs', [BlogController::class, 'allNews'])->name('blogs.index');
    Route::get('/blogs/{blog}', [BlogController::class, 'show'])->name('blogs.show');

    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product:slug}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');
    Route::get('/shop', [ShopController::class, 'index'])->name('shop.index');

    Route::post('currency', [CurrencyConverterController::class, 'store'])->name('currency.store');

    Route::resource('cart', CartController::class);

    Route::get('auth/{provider}/redirect', [SocialLoginController::class, 'redirect'])->name('auth.social.redirect');
    Route::get('auth/{provider}/callback', [SocialLoginController::class, 'callback'])->name('auth.social.callback');


    Route::middleware(['auth'])->group(function () {

        Route::get('checkout', [CheckoutController::class, 'create'])->name('checkout');
        Route::post('checkout', [CheckoutController::class, 'store']);

        Route::get('orders/{order}/pay', [PaymentsController::class, 'create'])->name('orders.payments.create');
        Route::post('orders/{order}/stripe/payment-intent', [PaymentsController::class, 'createStripePaymentIntent'])->name('stripe.paymentIntent.create');
        Route::get('orders/{order}/pay/stripe/callback', [PaymentsController::class, 'confirm'])->name('stripe.return');

        Route::get('/orders', [OrdersController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
        Route::put('/orders/{order}/cancel', [OrdersController::class, 'cancel'])->name('orders.cancel');

        Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
        Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
        Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');

        Route::get('auth/user/2fa', [TwoFactorAuthenticationController::class, 'index'])->name('front.2fa');
        Route::get('/user/password', [PasswordController::class, 'edit'])->name('user-password.edit');
        Route::put('/user/password', [PasswordController::class, 'update'])->name('user-password.update');

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });
});
