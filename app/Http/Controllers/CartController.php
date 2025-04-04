<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Cart\DestroyRequest;
use App\Http\Requests\Cart\StoreRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function index(): JsonResponse 
    {
        $cart = Cart::all();

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ])->setStatusCode(201);
    }

    public function store(StoreRequest $request): CartResource 
    {
        $cart = Cart::create($request->validated()->all());
        return new CartResource($cart);
    }

    public function destroy(Cart $cart, DestroyRequest $request): void
    {
        $cart->delete();
        return response()->json(['success' => true, 'message' => 'Wishlist deleted successfully.'], 204);
    }

    public function addToCart(Product $product): ProductResource
    {
        auth()->user()->cart()->attach($product->id);

        return $this->productResponse($product);
    }

    public function removeFromCart(Product $product): ProductResource
    {
        auth()->user()->cart()->detach($product->id);

        return $this->productResponse($product);
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
