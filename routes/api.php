<?php

use App\Http\Controllers\Categories;
use App\Http\Controllers\Product;
use App\Http\Controllers\Products;
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
Route::prefix('products')->group(function () {
    Route::get('list', [Products::class, 'getProductList']);
    Route::get('value', [Products::class, 'getProductValue']);
});

Route::prefix('categories')->group(function () {
    Route::get('list', [Categories::class, 'getCategoryList']);
});

Route::prefix('product')->group(function () {
    Route::get('/{product}', [Product::class, 'getProduct']);
    Route::post('/', [Product::class, 'createProduct']);
    Route::put('/{product}', [Product::class, 'saveProduct']);
    Route::delete('/{product}', [Product::class, 'deleteProduct']);
});
