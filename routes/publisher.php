<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/publishers', [App\Http\Controllers\Publisher\HomeController::class, 'index'])
    ->name("publisher.home.show");

Route::get('/publishers/register', [App\Http\Controllers\Publisher\Auth\RegisterController::class, 'showFormRegister'])
    ->name("publisher.register.show");

Route::get('/waiting', [\App\Http\Controllers\Publisher\Auth\RegisterController::class, 'showWaitScreen'])
    ->name('publisher.register.wait');

Route::post('/publishers/register', [App\Http\Controllers\Publisher\Auth\RegisterController::class, 'create'])
    ->name("publisher.register.create");

Route::get('/publishers/login', [App\Http\Controllers\Publisher\Auth\LoginController::class, 'index'])
    ->name("publisher.login.show");

Route::post('/publishers/login', [App\Http\Controllers\Publisher\Auth\LoginController::class, 'authenticate'])
    ->name("publisher.post.login");

Route::any('/logout', function () {
    Auth::logout();

    return redirect()->route('publisher.home.show');
})->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::prefix('publishers')->group(function () {
        Route::get('/dashboards', [App\Http\Controllers\Publisher\DashboardController::class, 'index'])
            ->name("dashboards.show");

        Route::prefix('products')->group(function () {
            Route::get('/', [\App\Http\Controllers\Publisher\ProductController::class, 'index'])
                ->name('products');

            Route::get('/detail/{id}', [\App\Http\Controllers\Publisher\ProductController::class, 'detail'])
                ->name('products.detail');
        });
    });
});
