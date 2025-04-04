<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Http\Requests\CartItem\DestroyRequest;
use App\Http\Requests\CartItem\StoreRequest;
use App\Models\Cart;
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

    public function store(Cart $cart, StoreRequest $request) 
    {
        $cartItem = $cart->cartItems()->create([
            'quantity' => $request->item['quantity'],
            'product' => $request->product['id'],
        ]);

        return new CartItemResource($cartItem);
    }

    public function destroy(CartItem $cartItem, DestroyRequest $request): void
    {
        $cartItem->delete();
        return response()->json(['success' => true, 'message' => 'Cart item deleted successfully.'], 204);
    }
}
