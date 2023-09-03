<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ProviderController;
use App\Http\Controllers\API\SaleController;
use App\Http\Controllers\API\SaleDetailController;
use App\Http\Controllers\API\UserController;
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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'getUsers')->name('api.get.users');
    Route::get('/user/{user}', 'show')->name('api.get.users');
    Route::post('/user', 'store');
    Route::put('/user-update/{user}', 'update');
});

Route::controller(CustomerController::class)->group(function () {
    Route::get('/customers', 'getCustomers')->name('api.get.customers');
    Route::get('/customer/{customer}', 'show')->name('api.get.customer');
    Route::post('/customer', 'store');
    Route::put('/customer-update/{customer}', 'update');
});

Route::controller(ProviderController::class)->group(function () {
    Route::get('/providers', 'getProviders')->name('api.get.providers');
    Route::get('/provider/{provider}', 'show')->name('api.get.providers');
    Route::post('/provider', 'store');
    Route::put('/provider-update/{provider}', 'update');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'getCategories')->name('api.get.categories');
    Route::get('/category/{category}', 'show')->name('api.get.category');
    Route::post('/category', 'store');
    Route::put('/category-update/{category}', 'update');
});

Route::controller(SaleController::class)->group(function () {
    Route::get('/sales', 'getSales')->name('api.get.sales');
    Route::get('/sale/{sale}', 'show')->name('api.get.sale');
    Route::post('/sale', 'store');
    Route::put('/sale-update/{sale}', 'update');
});

Route::controller(SaleDetailController::class)->group(function () {
    Route::get('/sale_details', 'getSales')->name('api.get.sale_details');
    Route::get('/sale_details/{sale_details}', 'show')->name('api.get.sale');
    Route::post('/sale_detail', 'store');
    Route::put('/sale_details-update/{sale_details}', 'update');
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'getProducts')->name('api.get.products');
    Route::get('/product/{product}', 'show')->name('api.get.product');
    Route::post('/product', 'store');
    Route::put('/product-update/{product}', 'update');
});



