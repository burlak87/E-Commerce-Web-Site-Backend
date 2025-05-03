<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\MyOrdersController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\WishlistItemController;

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Product - admin
// Route::post('/products', [ProductController::class, 'store'])->name('create-product');
// Route::patch('/products/{id}', [ProductController::class, 'update'])->name('update-product');
// Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('delete-product');

//User
Route::get('/users/{id}', [UserController::class, 'show'])->name('user');
Route::post('/registration', [UserController::class, 'store'])->name('create-user');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//Address
Route::get('/addresses', [AddressController::class, 'index'])->name('addresses');
Route::get('/addresses/{id}', [AddressController::class, 'show'])->name('address');

//Product
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product');

//Review
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('review');

//Cart
Route::get('/carts/{id}', [CartController::class, 'show'])->name('cart');

//CartItem
Route::get('/cart-items', [CartItemController::class, 'index'])->name('cartItem');

//MyOrders
Route::get('/my-orders', [MyOrdersController::class, 'index'])->name('myOrders');
Route::get('/my-orders/{id}', [MyOrdersController::class, 'show'])->name('myOrder');

//OrderDetail
Route::get('/order-details/{id}', [OrderDetailController::class, 'show'])->name('orderDetails');

//OrderItem
Route::get('/order-items', [OrderItemController::class, 'index'])->name('orderItem');

//Wishlist
Route::get('/wishlists/{id}', [WishlistController::class, 'show'])->name('wishlists');

//WishlistItem
Route::get('/wishlist-items', [WishlistItemController::class, 'index'])->name('wishlistItem');

Route::middleware(['auth:sanctum'])->group(function () {
    //User
    Route::patch('/users/{id}', [UserController::class, 'update'])->name('update-user');

    //Address
    Route::post('/addresses', [AddressController::class, 'store'])->name('create-address');
    Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])->name('delete-address');

    //Review
    Route::post('/reviews', [ReviewController::class, 'store'])->name('create-review');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('delete-review');

    //Cart
    Route::post('/carts', [CartController::class, 'store'])->name('create-cart');
    Route::delete('/carts/{cart}', [CartController::class, 'destroy'])->name('delete-cart');

    //CartItem
    Route::post('/cart-items', [CartItemController::class, 'addCartItem'])->name('create-cartItem');
    Route::delete('/cart-items/{cartItem}', [CartItemController::class, 'removeCartItem'])->name('delete-cartItem');

    //MyOrder
    Route::post('/my-orders', [MyOrdersController::class, 'store'])->name('create-myOrder');

    //OrderDetail
    Route::post('/order-details', [OrderDetailController::class, 'store'])->name('create-orderDetail');

    //OrderItem
    Route::post('/order-items', [OrderItemController::class, 'addOrderItem'])->name('create-orderItem');

    //Wishlist
    Route::post('/wishlists', [WishlistController::class, 'store'])->name('create-wishlist');
    Route::delete('/wishlists/{wishlist}', [WishlistController::class, 'destroy'])->name('delete-wishlist');

    //WishlistItem
    Route::post('/wishlist-items', [WishlistItemController::class, 'addWishlistItem'])->name('create-wishlistItem');
    Route::delete('/wishlist-items/{wishlistItem}', [WishlistItemController::class, 'removeWishlistItem'])->name('delete-wishlistItem');
});