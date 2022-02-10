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

Route::get('/', "HomeController@index");
Route::get('/login', "AuthController@show")->name('login');
Route::post('/login', "AuthController@login");

Route::middleware(['auth'])->group(function () {
    Route::resource("products",ProductController::class);
    Route::resource("product_categories",ProductCategoryController::class);
    Route::get('/logout', "AuthController@logout");
});
