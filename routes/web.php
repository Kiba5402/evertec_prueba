<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
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
Route::get('/', [App\Http\Controllers\V1\ProductoController::class, 'index']);

Auth::routes();

Route::get('/home2', function () {
    $datetime = new DateTime(now());
    $fecha = $datetime->format(DateTime::ATOM);
    $nonce = uniqid();
    //$fecha = str_replace('+', '-', $fecha);
    $nonceBase = base64_encode($nonce);
    $login = '6dd490faf9cb87a9862245da41170ff2';
    $secret = '024h1IlD';
    $tranKey = base64_encode(sha1(($nonce . $fecha . $secret), true));

    $peticion = Http::post('https://dev.placetopay.com/redirection/api/session', [
        "locale" => "es_CO",
        "auth"   => [
            "login"   => "$login",
            "tranKey" => "$tranKey",
            "nonce"   => "$nonceBase",
            "seed"    => "$fecha"
        ],
        "payment" => [
            "reference"   => "1122334455",
            "description" => "Prueba",
            "amount"      => [
                "currency" => "USD",
                "total"    => 100
            ],
            "allowPartial" => false
        ],
        "expiration" => "2022-12-30T00:00:00-05:00",
        "returnUrl"  => "https://dnetix.co/p2p/client",
        "ipAddress"  => "127.0.0.1",
        "userAgent"  => "PlacetoPay Sandbox"
    ])->throw()->json();

    dd($peticion);
});


