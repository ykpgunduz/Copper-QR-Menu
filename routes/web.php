<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\DessertController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReceiptController;
use App\Http\Controllers\NewOrderController;

Route::get('/', function () {return redirect('https://harpysocial.com');});

Route::get('/qr-menu', [HomeController::class, 'index'])->name('index');
Route::post('/qr-menu', [HomeController::class, 'addToCart'])->name('addToCart');
Route::get('/sepet', [CartController::class, 'viewCart'])->name('sepet');
Route::post('/sepet', [OrderController::class, 'store'])->name('store');
Route::post('/cart/remove/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::get('/order', [OrderController::class, 'show'])->name('order');
Route::post('/order', [OrderController::class, 'come'])->name('order.come');
Route::post('/cart/decrease/{id}', [CartController::class, 'decreaseQuantity'])->name('cart.decrease');
Route::post('/cart/update/{id}', [CartController::class, 'ajaxUpdate'])->name('cart.ajaxUpdate');
Route::post('/cart/remove/{id}', [CartController::class, 'ajaxRemove'])->name('cart.ajaxRemove');
Route::get('/cart/get-items', [CartController::class, 'getCartItems'])->name('cart.getItems');
Route::get('/admin/adisyon/{table_number}', [ReceiptController::class, 'show'])->name('receipt.show');
Route::get('/print-receipt/{calculation}', [ReceiptController::class, 'print'])->name('print.receipt');
Route::get('/past-order/{orderNumber}', [OrderController::class, 'showPastOrder'])->name('past.order.show');
Route::get('/rating/{orderNumber}', [RatingController::class, 'screen'])->name('rating.show');
Route::post('rating/{orderNumber}', [RatingController::class, 'store'])->name('rating.store');
Route::get('/product/{id}', [ProductController::class, 'getDetails'])->name('product.details');
Route::get('/receipt/print/{calculation}', [ReceiptController::class, 'print'])->name('receipt.print');
Route::get('/dessert', [DessertController::class, 'create'])->name('orders.create-by-weight');
Route::post('/dessert', [DessertController::class, 'store'])->name('orders.store-by-weight');
Route::get('/add-order', [NewOrderController::class, 'index'])->name('order.index');
Route::post('/add-order', [NewOrderController::class, 'store'])->name('order.store');
Route::post('/siparis/kaydet', [NewOrderController::class, 'saveOrder'])->name('siparis.kaydet');
Route::post('/siparis/ekle', [NewOrderController::class, 'siparisEkle'])->name('siparis.ekle');
