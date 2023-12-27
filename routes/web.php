<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ログイン画面
Route::get('/', function () {
    return view('auth.login');
});


Route::group(['middleware' => 'auth'], function () {
    // 商品一覧画面を表示する
    Route::get('/products.index', [ProductController::class, 'productsIndex'])->name('productsIndex');

    // 商品新規登録画面を表示する
    Route::get('/product.create', [ProductController::class, 'productCreate'])->name('productCreate');

    // 商品を新規登録する
    Route::post('/product.store', [ProductController::class, 'productStore'])->name('productStore');

    // 商品情報詳細画面を表示する
    Route::get('/product.show/{id}', [ProductController::class, 'productShow'])->name('productShow');

    // 商品情報編集画面を表示する
    Route::get('/product.edit/{id}', [ProductController::class, 'productEdit'])->name('productEdit');

    // 商品情報を編集する
    Route::put('/product.update/{id}', [ProductController::class, 'productUpdate'])->name('productUpdate');

    // 商品を削除する
    Route::delete('/products.destroy/{id}', [ProductController::class, 'productDelete'])->name('productDelete');
});
