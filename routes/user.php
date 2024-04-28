<?php

use App\Http\Controllers\Web\CartController;
use App\Http\Controllers\Web\CheckoutController;
use App\Http\Controllers\Web\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [\App\Http\Controllers\Web\HomeController::class, 'index'])
    ->name("home.show");

Route::get('/detail/{id}', [\App\Http\Controllers\Web\ProductDetailController::class, 'index'])
    ->name("detail.show");

Route::get('/home/ajax/products',[\App\Http\Controllers\Admin\AjaxController::class, 'getProductsHomePage'])
    ->name('ajaxGetProductHomePage');

// Cart
Route::get('/cart', [CartController::class, 'index'])
    ->name("cart.show");

Route::post('/cart/add', [CartController::class, 'addToCart'])
    ->name("cart.add");

Route::post('/cart/update', [CartController::class, 'update'])
    ->name("cart.update");

Route::post('/cart/remove', [CartController::class, 'removeItem'])
    ->name("cart.remove");

Route::post('/cart/update-address', [CartController::class, 'updateAddress'])
    ->name("cart.update-address");

// Checkout

Route::get('/checkout', [CheckoutController::class, 'index'])
    ->name("checkout.show");

// Order

Route::post('/order/store', [OrderController::class, 'store'])
    ->name("order.store");
