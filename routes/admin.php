<?php

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

Route::prefix('admin')->group(function () {
    Route::get('product_image/{file_id}/delete', [\App\Http\Controllers\Admin\FileController::class,'delete'])
        ->name('file.delete');

    Route::get('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showFormRegister'])
        ->name("admin.register.show");

    Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'create'])
        ->name("admin.register.create");

    Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'index'])
        ->name("admin.login.show");

    Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'authenticate'])
        ->name("admin.post.login");

    Route::any('/logout', function () {
        \Illuminate\Support\Facades\Auth::logout();

        return redirect("/admin/login");
    })->name('admin.logout');

    Route::get('/ajax/attribute-value', [App\Http\Controllers\Admin\AjaxController::class, 'getAttributeValue'])
        ->name('ajaxGetAttributeValue');

    Route::post('/products/set_default/{productId}', [\App\Http\Controllers\Admin\ProductController::class, 'setDefault'])
        ->name('admin.products.set_default');
});

Route::middleware(['auth', 'check_login_admin'])->group(function (){
    Route::get('/admin', [App\Http\Controllers\Admin\HomeController::class, 'index'])
        ->name("admin.home.show");

    Route::prefix('admin/users')->group(function (){
        Route::get('/', [\App\Http\Controllers\Admin\UserController::class, 'index'])
            ->name('admin.users.index');

        Route::post('update_status/{id}',[\App\Http\Controllers\Admin\UserController::class, 'updateStatus'])
            ->name('admin.users.update_status');
    });

    Route::resource('admin/attributes', App\Http\Controllers\Admin\AttributeController::class)
        ->names([
            'index' => 'admin.attributes.index',
            'store' => 'admin.attributes.store',
            'show' => 'admin.attributes.show',
            'update' => 'admin.attributes.update',
            'destroy' => 'admin.attributes.destroy',
            'create' => 'admin.attributes.create',
            'edit' => 'admin.attributes.edit'
        ]);

    Route::resource('admin/attributeValues', App\Http\Controllers\Admin\AttributeValueController::class)
        ->names([
            'index' => 'admin.attributeValues.index',
            'store' => 'admin.attributeValues.store',
            'show' => 'admin.attributeValues.show',
            'update' => 'admin.attributeValues.update',
            'destroy' => 'admin.attributeValues.destroy',
            'create' => 'admin.attributeValues.create',
            'edit' => 'admin.attributeValues.edit'
        ]);

    Route::resource('admin/products', App\Http\Controllers\Admin\ProductController::class)
        ->names([
            'index' => 'admin.products.index',
            'store' => 'admin.products.store',
            'show' => 'admin.products.show',
            'update' => 'admin.products.update',
            'destroy' => 'admin.products.destroy',
            'create' => 'admin.products.create',
            'edit' => 'admin.products.edit',
        ]);

    Route::resource('admin/product-variants', App\Http\Controllers\Admin\ProductVariantController::class)
        ->names([
            'index' => 'admin.productVariants.index',
            'store' => 'admin.productVariants.store',
            'show' => 'admin.productVariants.show',
            'update' => 'admin.productVariants.update',
            'destroy' => 'admin.productVariants.destroy',
            'create' => 'admin.productVariants.create',
            'edit' => 'admin.productVariants.edit'
        ]);

    Route::resource('admin/product-inventories', App\Http\Controllers\Admin\ProductInventoryController::class)
        ->names([
            'index' => 'admin.productInventories.index',
            'store' => 'admin.productInventories.store',
            'show' => 'admin.productInventories.show',
            'update' => 'admin.productInventories.update',
            'destroy' => 'admin.productInventories.destroy',
            'create' => 'admin.productInventories.create',
            'edit' => 'admin.productInventories.edit'
        ]);

    Route::resource('admin/locations', App\Http\Controllers\Admin\LocationController::class)
        ->names([
            'index' => 'admin.locations.index',
            'store' => 'admin.locations.store',
            'show' => 'admin.locations.show',
            'update' => 'admin.locations.update',
            'destroy' => 'admin.locations.destroy',
            'create' => 'admin.locations.create',
            'edit' => 'admin.locations.edit'
        ]);

    Route::resource('admin/warehouse-receipts', App\Http\Controllers\Admin\WarehouseReceiptController::class)
        ->names([
            'index' => 'admin.warehouseReceipts.index',
            'store' => 'admin.warehouseReceipts.store',
            'show' => 'admin.warehouseReceipts.show',
            'update' => 'admin.warehouseReceipts.update',
            'destroy' => 'admin.warehouseReceipts.destroy',
            'create' => 'admin.warehouseReceipts.create',
            'edit' => 'admin.warehouseReceipts.edit'
        ]);

    Route::resource('admin/warehouse-exports', App\Http\Controllers\Admin\WarehouseExportController::class)
        ->names([
            'index' => 'admin.warehouseExports.index',
            'store' => 'admin.warehouseExports.store',
            'show' => 'admin.warehouseExports.show',
            'update' => 'admin.warehouseExports.update',
            'destroy' => 'admin.warehouseExports.destroy',
            'create' => 'admin.warehouseExports.create',
            'edit' => 'admin.warehouseExports.edit'
        ]);

    Route::resource('admin/categories', App\Http\Controllers\Admin\CategoryController::class)
        ->names([
            'index' => 'admin.categories.index',
            'store' => 'admin.categories.store',
            'show' => 'admin.categories.show',
            'update' => 'admin.categories.update',
            'destroy' => 'admin.categories.destroy',
            'create' => 'admin.categories.create',
            'edit' => 'admin.categories.edit'
        ]);

    Route::resource('admin/banners', App\Http\Controllers\Admin\BannerController::class)
        ->names([
            'index' => 'admin.banners.index',
            'store' => 'admin.banners.store',
            'show' => 'admin.banners.show',
            'update' => 'admin.banners.update',
            'destroy' => 'admin.banners.destroy',
            'create' => 'admin.banners.create',
            'edit' => 'admin.banners.edit'
        ]);
});

Route::get('/files/{file_id}', [\App\Http\Controllers\Admin\FileController::class, 'index'])
    ->name("file.show");
