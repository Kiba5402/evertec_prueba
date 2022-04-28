<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\V1\ProductoController::class, 'index'])->name('home');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    //Carrito compras
    Route::name('shopping-cart.')->prefix('/shopping-cart')->group(function () {
        Route::get('/get-User-Sc', [App\Http\Controllers\V1\CarritoComprasController::class, 'carroComprasUsuario'])->name('get-User-Sc');
        Route::get('/add-product/{slug_producto}/{cantidad}', [App\Http\Controllers\V1\CarritoComprasController::class, 'adicionProducto'])->name('add-product');
    });

    //Ordenes
    Route::name('order.')->prefix('/order')->group(function () {
        Route::post('/create-order/{slug_carrito}', [App\Http\Controllers\V1\OrdenesController::class, 'createOrder'])->name('create-order');
        Route::get('/init-order/{slug_carrito}', [App\Http\Controllers\V1\OrdenesController::class, 'store'])->name('init-order');
        Route::get('/get-orders', [App\Http\Controllers\V1\OrdenesController::class, 'index'])->name('get-orders');
        Route::get('/get-all-orders', [App\Http\Controllers\V1\OrdenesController::class, 'all'])->name('get-all-orders');
        Route::get('/pay-order/{slug_orden}', [App\Http\Controllers\V1\OrdenesController::class, 'orderPay'])->name('pay-order');
        Route::get('/order-summary/{slug_orden}', [App\Http\Controllers\V1\OrdenesController::class, 'orderSummary'])->name('order-summary');
        Route::get('/return-paygateway/{slug_orden}', [App\Http\Controllers\V1\OrdenesController::class, 'returnPayGateWay'])->name('return-paygateway');
    });
});