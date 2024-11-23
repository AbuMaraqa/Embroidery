<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\web\HomeController::class, 'index'])->name('home');
Route::prefix('product')->group(function () {
    Route::get('/index', [App\Http\Controllers\web\ProductController::class, 'index'])->name('product.index');
});
Route::prefix('category')->group(function () {
    Route::get('/index/{id}', [App\Http\Controllers\web\CategoryController::class, 'index'])->name('category.index');
});


Route::group(['middleware' => ['auth'] , 'prefix' => 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('admin.home');
    Route::group(['prefix' => 'users'], function () {
        Route::get('/index', [App\Http\Controllers\admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('add', [App\Http\Controllers\admin\UserController::class, 'add'])->name('admin.users.add');
        Route::post('create', [App\Http\Controllers\admin\UserController::class, 'create'])->name('admin.users.create');
        Route::get('edit/{id}', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('update', [App\Http\Controllers\admin\UserController::class, 'update'])->name('admin.users.update');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/index', [App\Http\Controllers\admin\CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/add', [App\Http\Controllers\admin\CategoryController::class, 'add'])->name('admin.category.add');
        Route::post('/create', [App\Http\Controllers\admin\CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('/edit/{id}', [App\Http\Controllers\admin\CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/update', [App\Http\Controllers\admin\CategoryController::class, 'update'])->name('admin.category.update');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/index', [App\Http\Controllers\admin\ProductController::class, 'index'])->name('admin.products.index');
        Route::post('/list_product_ajax', [App\Http\Controllers\admin\ProductController::class, 'list_product_ajax'])->name('admin.products.list_product_ajax');
        Route::get('/add', [App\Http\Controllers\admin\ProductController::class, 'add'])->name('admin.products.add');
        Route::post('/create', [App\Http\Controllers\admin\ProductController::class, 'create'])->name('admin.products.create');
        Route::get('/edit/{id}', [App\Http\Controllers\admin\ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/update', [App\Http\Controllers\admin\ProductController::class, 'update'])->name('admin.products.update');
    });
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
