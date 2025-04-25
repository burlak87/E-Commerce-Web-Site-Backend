<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
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

Route::middleware(['middleware' => 'admin'])->group(function () { 
    Route::get('/profile/admin', function () {
        return view('admin');
    })->name('admin_panel');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', []);
});

//patch - части
//put - все

//Address
Route::get('/addresses', [AddressController::class, 'index'])->name('addresses');
Route::get('/addresses/{id}', [AddressController::class, 'show'])->name('address');
Route::post('/addresses', [AddressController::class, 'store'])->name('create-address');
Route::patch('/addresses/{id}', [AddressController::class, 'update'])->name('update-address');
Route::delete('/addresses/{id}', [AddressController::class, 'destroy'])->name('delete-address');

//Cart
Route::get('/cart', [CartController::class, 'index'])->name('cartItem');
Route::post('/cart', [CartController::class, 'store'])->name('create-cartItem');
Route::delete('/cart/{id}', [CartController::class, 'destroy'])->name('delete-cartItem');
Route::post('/cart/product/{productId}/add', [CartController::class, 'addToCart'])->name('addToCart');
Route::delete('/cart/product/{productId}/remove', [CartController::class, 'removeFromCart'])->name('removeFromCart');

//CartItem
Route::get('/cart/items', [CartItemController::class, 'index'])->name('cart');
Route::post('/cart/{cartId}/items', [CartItemController::class, 'store'])->name('create-cart');
Route::delete('/cart/items/{id}', [CartItemController::class, 'destroy'])->name('delete-cart');

//MyOrders
Route::get('/my-orders', [MyOrdersController::class, 'index'])->name('myOrders');
Route::get('/my-orders/{id}', [MyOrdersController::class, 'show'])->name('myOrder');
Route::post('/my-orders', [MyOrdersController::class, 'store'])->name('create-myOrder');
Route::patch('/my-orders/{id}', [MyOrdersController::class, 'update'])->name('update-myOrder');
Route::delete('/my-orders/{id}', [MyOrdersController::class, 'destroy'])->name('delete-myOrder');

//OrderDetail
Route::get('/order-details', [OrderDetailController::class, 'index'])->name('orderDetails');
Route::post('/order-detail', [OrderDetailController::class, 'store'])->name('create-orderDetail');
Route::delete('/order-detail/{id}', [OrderDetailController::class, 'destroy'])->name('delete-orderDetail');
Route::post('/orderDetail/{id}/add', [OrderDetailController::class, 'addToOrderDetail'])->name('addToOrderDetail');
Route::delete('/order-details/{id}/remove', [OrderDetailController::class, 'removeFromOrderDetail'])->name('removeFromOrderDetail');

//OrderItem
Route::get('/order-items', [OrderItemController::class, 'index'])->name('orderItem');
Route::post('/order-items', [OrderItemController::class, 'store'])->name('create-orderItem');
Route::delete('/order-items/{id}', [OrderItemController::class, 'destroy'])->name('delete-orderItem');

//Product
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/products/{id}', [ProductController::class, 'show'])->name('product');
Route::post('/products', [ProductController::class, 'store'])->name('create-product');
Route::patch('/products/{id}', [ProductController::class, 'update'])->name('update-product');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('delete-product');

//Review
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews');
Route::get('/reviews/{id}', [ReviewController::class, 'show'])->name('review');
Route::post('/reviews', [ReviewController::class, 'store'])->name('create-review');
Route::delete('/reviews/{id}', [ReviewController::class, 'destroy'])->name('delete-review');

//User
Route::get('/users/{id}', [UserController::class, 'show'])->name('user');
Route::post('/users', [UserController::class, 'store'])->name('create-user');
Route::patch('/users/{id}', [UserController::class, 'update'])->name('update-user');

// User-log
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlists');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('create-wishlist');
Route::delete('/wishlist/{id}', [WishlistController::class, 'destroy'])->name('delete-wishlist');
Route::post('/wishlist/{id}/add', [WishlistController::class, 'addToCart'])->name('addToWishlist');
Route::delete('/wishlist/{id}/remove', [WishlistController::class, 'update'])->name('removeFromWishlist');

//WishlistItem
Route::get('/wishlist-items', [WishlistItemController::class, 'index'])->name('wishlistItem');
Route::post('/wishlist/{wishlistId}/items', [WishlistItemController::class, 'store'])->name('create-wishlistItem');
Route::delete('/wishlist-items/{id}', [WishlistItemController::class, 'destroy'])->name('delete-wishlistItem');