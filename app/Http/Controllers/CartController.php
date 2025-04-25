<?php

namespace App\Http\Controllers;

use App\Http\Resources\CartResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Cart\DestroyRequest;
use App\Http\Requests\Cart\StoreRequest;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Cart",
 *     description="Operations related to user carts"
 * )
 */
class CartController extends Controller
{
    /**
     * @OA\Get(
     *     path="/cart",
     *     summary="Get the user's cart",
     *     @OA\Response(response="200", description="Cart details")
     * )
     */
    public function index(): JsonResponse 
    {
        $cart = Cart::all();

        return response()->json([
            'success' => true,
            'cart' => $cart,
        ])->setStatusCode(201);
    }

    /**
     * @OA\Post(
     *     path="/cart",
     *     summary="Add an item to the cart",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Cart")
     *     ),
     *     @OA\Response(response="201", description="Item added to cart")
     * )
     */
    public function store(StoreRequest $request): CartResource 
    {
        $cart = Cart::create($request->validated()->all());
        return new CartResource($cart);
    }

    /**
     * @OA\Delete(
     *     path="/cart/{id}",
     *     summary="Delete an item from the cart",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Item deleted from cart")
     * )
     */
    public function destroy(Cart $cart, DestroyRequest $request): void
    {
        $cart->delete();
    }

    /**
     * @OA\Post(
     *     path="/cart/products/{productId}/add",
     *     summary="Add a product to the cart",
     *     @OA\Parameter(
     *         name="productId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Product added to cart")
     * )
     */
    public function addToCart(Product $product): ProductResource
    {
        auth()->user()->cart()->attach($product->id);

        return $this->productResponse($product);
    }

    /**
     * @OA\Delete(
     *     path="/cart/products/{productId}/remove",
     *     summary="Remove a product from the cart",
     *     @OA\Parameter(
     *         name="productId",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Product removed from cart")
     * )
     */
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
