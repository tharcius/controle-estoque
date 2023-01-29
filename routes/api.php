<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Product\CreateController as ProductsCreate;
use App\Http\Controllers\Product\IndexController as ProductsIndex;
use App\Http\Controllers\Product\DeleteController as ProductsDelete;
use App\Http\Controllers\Product\ShowController as ProductsShow;
use App\Http\Controllers\Product\UpdateController as ProductsUpdate;
use App\Http\Controllers\Product\BuyController as ProductsBuy;
use App\Http\Controllers\Product\SellController as ProductsSell;

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
    Route::post('/', ProductsCreate::class);
    Route::get('/{id}', ProductsShow::class);
    Route::patch('/{id}', ProductsUpdate::class);
    Route::delete('/{id}', ProductsDelete::class);
    Route::post('/buy/{id}', ProductsBuy::class);
    Route::post('/sell/{id}', ProductsSell::class);
});
