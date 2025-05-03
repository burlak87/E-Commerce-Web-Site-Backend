<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Requests\Cart\StoreRequest;
use App\Http\Requests\Cart\DestroyRequest;
use App\Models\Cart;
use Illuminate\Http\JsonResponse;

class CartController extends Controller
{
    public function show($cartId): JsonResponse 
    {
        $cart = Cart::findOrFail($cartId);

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ])->setStatusCode(201);
    }

    public function store(StoreRequest $request): CartResource 
    {
        $cart = Cart::create($request->validated());
        return new CartResource($cart);
    }

    public function destroy(Cart $cart, DestroyRequest $request): JsonResponse
    {
        $cart->delete();
        return response()->json(['message' => 'Cart deleted successfully'], 200);
    }
}
