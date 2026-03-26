<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;

use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Middleware\checkUserType;

Route::group([
    'middleware'=> ['auth', 'auth.type:admin,super-admin'],
    'prefix'=> 'dashboard',
    'as' => 'dashboard.'

], function () {
    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('categories/trash', [CategoriesController::class, 'trash'])->name('categories.trash');
    Route::put('categories/{category}/restore', [CategoriesController::class, 'restore'])->name('categories.restore');
    Route::delete('categories/{category}/force-delete', [CategoriesController::class, 'forceDelete'])->name('categories.force-delete');

    Route::resource('/categories', CategoriesController::class);

    Route::get('products/trash', [ProductsController::class, 'trash'])->name('products.trash');
    Route::resource('/products', ProductsController::class);
});

