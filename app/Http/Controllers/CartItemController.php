<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartItemResource;
use App\Http\Requests\CartItem\DestroyRequest;
use App\Http\Requests\CartItem\StoreRequest;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="CartItem",
 *     description="Operations related to user cart items"
 * )
 */
class CartItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/cart/items",
     *     summary="Get all items in the cart",
     *     @OA\Response(response="200", description="List of cart items")
     * )
     */
    public function index(): JsonResponse
    {
        $cartItems = CartItem::all();

        return response()->json([
            'success' => true,
            'cartItems' => $cartItems, 
            'count' => $cartItems->count(),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/cart/{cartId}/items",
     *     summary="Add an item to the cart",
     *     @OA\Parameter(
     *         name="cartId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CartItem")
     *     ),
     *     @OA\Response(response="201", description="Item added to cart")
     * )
     */
    public function store(Cart $cart, StoreRequest $request) 
    {
        $cartItem = $cart->cartItems()->create([
            'quantity' => $request->item['quantity'],
            'product' => $request->product['id'],
        ]);

        return new CartItemResource($cartItem);
    }

    /**
     * @OA\Delete(
     *     path="/cart/items/{id}",
     *     summary="Delete a cart item",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Cart item deleted")
     * )
     */
    public function destroy(CartItem $cartItem, DestroyRequest $request): void
    {
        $cartItem->delete();
    }
}
