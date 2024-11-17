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

Route::group(['middleware' => ['auth'] , 'prefix' => 'admin'], function () {
    Route::get('/home', [App\Http\Controllers\admin\HomeController::class, 'index'])->name('admin.home');
    Route::group(['prefix' => 'users'], function () {
        Route::get('/index', [App\Http\Controllers\admin\UserController::class, 'index'])->name('admin.users.index');
        Route::get('add', [App\Http\Controllers\admin\UserController::class, 'add'])->name('admin.users.add');
        Route::post('create', [App\Http\Controllers\admin\UserController::class, 'create'])->name('admin.users.create');
        Route::get('edit/{id}', [App\Http\Controllers\admin\UserController::class, 'edit'])->name('admin.users.edit');
        Route::post('update', [App\Http\Controllers\admin\UserController::class, 'update'])->name('admin.users.update');
    });
    Route::group(['prefix' => 'category'], function () {
        Route::get('/index', [App\Http\Controllers\admin\CategoryController::class, 'index'])->name('admin.category.index');
        Route::get('/add', [App\Http\Controllers\admin\CategoryController::class, 'add'])->name('admin.category.add');
        Route::post('/create', [App\Http\Controllers\admin\CategoryController::class, 'create'])->name('admin.category.create');
        Route::get('/edit/{id}', [App\Http\Controllers\admin\CategoryController::class, 'edit'])->name('admin.category.edit');
        Route::post('/update', [App\Http\Controllers\admin\CategoryController::class, 'update'])->name('admin.category.update');
    });
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
