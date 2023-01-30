<?php

use App\Http\Controllers\Product\BuyController as ProductsBuy;
use App\Http\Controllers\Product\CreateController as ProductsCreate;
use App\Http\Controllers\Product\DeleteController as ProductsDelete;
use App\Http\Controllers\Product\IndexController as ProductsIndex;
use App\Http\Controllers\Product\SellController as ProductsSell;
use App\Http\Controllers\Product\ShowController as ProductsShow;
use App\Http\Controllers\Product\UpdateController as ProductsUpdate;
use App\Http\Controllers\Product\ValidateStockController as ProductsValidateStock;
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
Route::prefix('/products')->group(function () {
    Route::get('/', ProductsIndex::class);
    Route::get('/validate-stock', ProductsValidateStock::class);
    Route::get('/{id}', ProductsShow::class);
    Route::post('/', ProductsCreate::class);
    Route::post('/{id}/buy', ProductsBuy::class);
    Route::post('/{id}/sell', ProductsSell::class);
    Route::patch('/{id}', ProductsUpdate::class);
    Route::delete('/{id}', ProductsDelete::class);
});
