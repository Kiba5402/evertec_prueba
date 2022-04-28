<?php

use App\Models\V1\Payment;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Payments\V1\Payments\PlaceToPayGateWay;

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
        Route::get('/pay-order/{slug_orden}', [App\Http\Controllers\V1\OrdenesController::class, 'orderPay'])->name('pay-order');
        Route::get('/return-paygateway/{slug_orden}', [App\Http\Controllers\V1\OrdenesController::class, 'returnPayGateWay'])->name('return-paygateway');
    });
});

Route::get('/home2', [App\Http\Controllers\V1\OrdenesController::class, 'createOrder']);

