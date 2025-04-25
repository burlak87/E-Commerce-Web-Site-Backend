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
Route::get('/address', [AddressController::class, 'index'])->name('addresses');
Route::get('/address/{id}', [AddressController::class, 'show'])->name('address');
Route::post('/address', [AddressController::class, 'store'])->name('create-address');
Route::patch('/address/update/{id}', [AddressController::class, 'update'])->name('update-address');
Route::delete('/address', [AddressController::class, 'destroy'])->name('delete-address');

//Cart
Route::get('/cartItem', [CartController::class, 'index'])->name('cartItem');
Route::post('/cartItem', [CartController::class, 'store'])->name('create-cartItem');
Route::delete('/cartItem', [CartController::class, 'destroy'])->name('delete-cartItem');
Route::post('/cartItem/addToCart', [CartController::class, 'addToCart'])->name('addToCart');
Route::delete('/cartItem/removeFromCart', [CartController::class, 'removeFromCart'])->name('removeFromCart');

//CartItem
Route::get('/cart', [CartItemController::class, 'index'])->name('cart');
Route::post('/cart', [CartItemController::class, 'store'])->name('create-cart');
Route::delete('/cart', [CartItemController::class, 'destroy'])->name('delete-cart');

//MyOrders
Route::get('/myOrder', [MyOrdersController::class, 'index'])->name('myOrders');
Route::get('/myOrder/{id}', [MyOrdersController::class, 'show'])->name('myOrder');
Route::post('/myOrder', [MyOrdersController::class, 'store'])->name('create-myOrder');
Route::patch('/myOrder/{id}', [MyOrdersController::class, 'update'])->name('update-myOrder');
Route::delete('/myOrder', [MyOrdersController::class, 'destroy'])->name('delete-myOrder');

//OrderDetail
Route::get('/orderDetail', [OrderDetailController::class, 'index'])->name('orderDetails');
Route::post('/orderDetail', [OrderDetailController::class, 'store'])->name('create-orderDetail');
Route::delete('/orderDetail', [OrderDetailController::class, 'destroy'])->name('delete-orderDetail');
Route::post('/orderDetail/addToOrderDetail', [OrderDetailController::class, 'addToOrderDetail'])->name('addToOrderDetail');
Route::delete('/orderDetail/removeFromOrderDetail', [OrderDetailController::class, 'removeFromOrderDetail'])->name('removeFromOrderDetail');

//OrderItem
Route::get('/orderItem', [OrderItemController::class, 'index'])->name('orderItem');
Route::post('/orderItem', [OrderItemController::class, 'store'])->name('create-orderItem');
Route::delete('/orderItem', [OrderItemController::class, 'destroy'])->name('delete-orderItem');

//Product
Route::get('/product', [ProductController::class, 'index'])->name('products');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product');
Route::post('/product', [ProductController::class, 'store'])->name('create-product');
Route::patch('/product/update', [ProductController::class, 'update'])->name('update-product');
Route::delete('/product', [ProductController::class, 'destroy'])->name('delete-product');

//Review
Route::get('/review', [ReviewController::class, 'index'])->name('reviews');
Route::get('/review/{id}', [ReviewController::class, 'show'])->name('review');
Route::post('/review', [ReviewController::class, 'store'])->name('create-review');
Route::delete('/review', [ReviewController::class, 'destroy'])->name('delete-review');

//User
Route::get('/user/{id}', [UserController::class, 'show'])->name('user');
Route::post('/user', [UserController::class, 'store'])->name('create-user');
Route::patch('/user/update', [UserController::class, 'update'])->name('update-user');

// User-log
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//Wishlist
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlists');
Route::post('/wishlist', [WishlistController::class, 'store'])->name('create-wishlist');
Route::delete('/wishlist', [WishlistController::class, 'destroy'])->name('delete-wishlist');
Route::post('/wishlist/addToWishlist', [WishlistController::class, 'addToCart'])->name('addToWishlist');
Route::delete('/wishlist/removeFromWishlist', [WishlistController::class, 'update'])->name('removeFromWishlist');

//WishlistItem
Route::get('/wishlistItem', [WishlistItemController::class, 'index'])->name('wishlistItem');
Route::post('/wishlistItem', [WishlistItemController::class, 'store'])->name('create-wishlistItem');
Route::delete('/wishlistItem', [WishlistItemController::class, 'destroy'])->name('delete-wishlistItem');

// Route::get('/admin-dashboard', [MovieController::class, 'indexAll'])->middleware(['auth', 'verified'])->name('admin-dashboard');