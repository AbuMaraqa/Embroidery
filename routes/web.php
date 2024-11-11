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
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});