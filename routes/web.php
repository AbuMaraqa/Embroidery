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
Route::prefix('cart')->group(function () {
    Route::get('/getCart', [App\Http\Controllers\web\CartController::class, 'getCart'])->name('cart.getCart');
    Route::post('/addToCart', [App\Http\Controllers\web\CartController::class, 'addToCart'])->name('cart.addToCart');
    Route::post('/removeFromCart', [App\Http\Controllers\web\CartController::class, 'removeFromCart'])->name('cart.removeFromCart');
});

Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/get_orders', [App\Http\Controllers\OrdersController::class, 'get_orders'])->name('orders.get_orders');
        Route::post('/processPayment', [App\Http\Controllers\OrdersController::class, 'processPayment'])->name('orders.processPayment');
        Route::post('/cart_order_ajax', [App\Http\Controllers\OrdersController::class, 'cart_order_ajax'])->name('orders.cart_order_ajax');
        Route::post('/update_qty', [App\Http\Controllers\OrdersController::class, 'update_qty'])->name('orders.update_qty');
        Route::get('/my_orders', [App\Http\Controllers\OrdersController::class, 'my_orders'])->name('orders.my_orders');
        Route::get('/order_details/{id}', [App\Http\Controllers\OrdersController::class, 'order_details'])->name('orders.order_details');
    });
    Route::group(['prefix' => 'embroidery'], function () {
        Route::get('/new_embroidery', [App\Http\Controllers\web\EmbroideryController::class, 'new_embroidery'])->name('web.embroidery.new_embroidery');
        Route::post('/create_post', [App\Http\Controllers\web\EmbroideryController::class, 'create_post'])->name('web.embroidery.create_post');
    });
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
        Route::get('/delete/{id}', [App\Http\Controllers\admin\CategoryController::class, 'delete'])->name('admin.category.delete');
    });
    Route::group(['prefix' => 'products'], function () {
        Route::get('/index', [App\Http\Controllers\admin\ProductController::class, 'index'])->name('admin.products.index');
        Route::post('/list_product_ajax', [App\Http\Controllers\admin\ProductController::class, 'list_product_ajax'])->name('admin.products.list_product_ajax');
        Route::get('/add', [App\Http\Controllers\admin\ProductController::class, 'add'])->name('admin.products.add');
        Route::post('/create', [App\Http\Controllers\admin\ProductController::class, 'create'])->name('admin.products.create');
        Route::get('/edit/{id}', [App\Http\Controllers\admin\ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('/update', [App\Http\Controllers\admin\ProductController::class, 'update'])->name('admin.products.update');
        Route::get('/delete/{id}', [App\Http\Controllers\admin\ProductController::class, 'delete'])->name('admin.products.delete');
    });
    Route::group(['prefix' => 'slider'], function () {
        Route::get('/index', [App\Http\Controllers\admin\SliderController::class, 'index'])->name('admin.slider.index');
        Route::get('/add', [App\Http\Controllers\admin\SliderController::class, 'add'])->name('admin.slider.add');
        Route::post('/create', [App\Http\Controllers\admin\SliderController::class, 'create'])->name('admin.slider.create');
        Route::get('/edit/{id}', [App\Http\Controllers\admin\SliderController::class, 'edit'])->name('admin.slider.edit');
        Route::put('/update', [App\Http\Controllers\admin\SliderController::class, 'update'])->name('admin.slider.update');
        Route::get('/delete/{id}', [App\Http\Controllers\admin\SliderController::class, 'delete'])->name('admin.slider.delete');
    });
    Route::group(['prefix' => 'shipping_methods'], function () {
        Route::get('/index', [App\Http\Controllers\admin\ShippingMehtodsController::class, 'index'])->name('admin.shipping_methods.index');
        Route::get('/add', [App\Http\Controllers\admin\ShippingMehtodsController::class, 'add'])->name('admin.shipping_methods.add');
        Route::post('/create', [App\Http\Controllers\admin\ShippingMehtodsController::class, 'create'])->name('admin.shipping_methods.create');
        Route::get('/edit/{id}', [App\Http\Controllers\admin\ShippingMehtodsController::class, 'edit'])->name('admin.shipping_methods.edit');
        Route::post('/update', [App\Http\Controllers\admin\ShippingMehtodsController::class, 'update'])->name('admin.shipping_methods.update');
        Route::get('/delete/{id}', [App\Http\Controllers\admin\ShippingMehtodsController::class, 'delete'])->name('admin.shipping_methods.delete');
    });
    Route::group(['prefix' => 'orders'], function () {
        Route::get('/list_order', [App\Http\Controllers\admin\OrdersController::class, 'list_order'])->name('admin.orders.list_order');
        Route::get('/order_details/{id}', [App\Http\Controllers\admin\OrdersController::class, 'order_details'])->name('admin.orders.order_details');
    });
});


Route::group(['middleware' => ['auth']], function () {
    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
});
