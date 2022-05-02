<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [App\Http\Controllers\Api\LoginController::class, 'login']);

Route::get('v1/productos', [App\Http\Controllers\Api\v1\ProductosController::class, 'index'])->middleware('auth:sanctum');
Route::apiResource('v1/facturas', App\Http\Controllers\Api\v1\FacturasController::class)->middleware('auth:sanctum');
Route::get('v1/productoByFactura/{factura}', [App\Http\Controllers\Api\v1\FacturasController::class, 'productoByFactura'])->middleware('auth:sanctum');
Route::apiResource('v1/facturasDetalle', App\Http\Controllers\Api\v1\FacturasDetalleController::class)->middleware('auth:sanctum');
