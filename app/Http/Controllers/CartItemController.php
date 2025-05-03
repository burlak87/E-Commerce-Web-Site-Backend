<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\CartItem\DestroyRequest;
use App\Http\Requests\CartItem\StoreRequest;
use App\Models\Cart;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\JsonResponse;

class CartItemController extends Controller
{
    public function index(): JsonResponse
    {
        $cartItems = CartItem::all();

        return response()->json([
            'success' => true,
            'cartItems' => $cartItems, 
            'count' => $cartItems->count(),
        ]);
    }

    public function addCartItem(CartItem $cartItem, StoreRequest $request): array
    {
        $cartItems = $cartItem->create([
            'quantity' => $request->item['quantity'],
            'cart_id' => $request->cart['id'],
            'product_id' => $request->product['id'],
        ]);

        $cart = Cart::find($request->cart['id']);
        $product = Product::find($request->product['id']);

        return [
            'cart_item' => new CartItemResource($cartItems),
            'cart' => $this->cartResponse($cart),
            'product' => $this->productResponse($product),
        ];
    }

    public function removeCartItem(CartItem $cartItem, DestroyRequest $request): JsonResponse
    {
        $cartItem->delete();
        return response()->json(['message' => 'Cart Item deleted successfully'], 200);
    }

    public function cartResponse(Cart $cart): CartResource
    {
        return new CartResource($cart);
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
