<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AttributeController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::resource('categories', CategoryController::class);
//Route::get('categories/{id}', [CategoryController::class, 'getCategory'])->name('category.get');
Route::resource('products', ProductController::class);
Route::post('/products/search', [ProductController::class, 'search'])->name('products.search');
Route::get('/products/attributes/{product}', [ProductController::class, 'attributesview'])->name('products.attributes.view');
Route::post('/products/attributes/store/{product}', [ProductController::class, 'attributesstore'])->name('products.attributes.store');
Route::resource('attributes', AttributeController::class);