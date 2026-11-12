<?php

use App\Http\Controllers\Api\AccessTokenControler;
use App\Http\Controllers\Api\DeliveryController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return Auth::guard('sanctum')->user();
// });

// Route::apiResource('products', ProductController::class)->middleware('auth:sanctum')->except('index','show');
// Route::apiResource('products', ProductController::class);

// Route::post('auth/access-tokens', [AccessTokenControler::class, 'store'])->middleware('guest:sanctum');

// Route::delete('auth/access-tokens/{token?}', [AccessTokenControler::class, 'destroy'])->middleware('auth:sanctum');

// // Route::middleware('auth:sanctum')->group(function () {
// Route::get('deliveries/{delivery}', [DeliveryController::class, 'show']);
// Route::put('deliveries/{delivery}', [DeliveryController::class, 'update']);

// });
