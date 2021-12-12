<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\DeliveredProduct\DeliveredProductController;
use App\Http\Controllers\Order\OrderController;
use App\Http\Controllers\Product\ProductController;
use App\Http\Controllers\User\UserController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/user/register', [UserController::class, 'store'])->name('user.store');
Route::post('/user/login', [UserController::class, 'login'])->name('user.login');

Route::post('/admin/register', [AdminController::class, 'store'])->name('admin.store');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');


Route::resource("product", ProductController::class);

Route::middleware(['auth:sanctum', 'type.admin'])->group(function(){
    Route::post('/logout', [UserController::class, 'logout'])->name('admin.logout');
    Route::get('/product/edit/{product:_id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::post('/product/update/{product:_id}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
   Route::post('/order/deliveredProduct/{order:_id}', [DeliveredProductController::class, 'store'])->name('deliveredProduct.store');
   Route::get('/orders/all', [DeliveredProductController::class, 'getAllOrders'])->name('deliveredProduct.getAllOrders');
});

Route::middleware(['auth:sanctum', 'type.user'])->group(function (){
    Route::post('/product/order/{product:_id}', [OrderController::class, 'store'])->name('order.store');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');

    Route::put('/order/{order:_id}', [OrderController::class, 'update'])->name('order.update');
    Route::delete('/order/{order:_id}', [OrderController::class, 'destroy'])->name('order.destroy');
    Route::post('/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::get('/deliveredProduct', [DeliveredProductController::class, 'index'])->name('deliveredProduct.index');
    Route::delete('/deliveredProduct/{id}', [DeliveredProductController::class, 'destroy'])->name('deliveredProduct.destroy');
});

Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');





