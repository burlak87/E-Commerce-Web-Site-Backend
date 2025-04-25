<?php

namespace App\Http\Controllers;

use App\Http\Resources\WishlistResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Wishlist\DestroyRequest;
use App\Http\Requests\Wishlist\StoreRequest;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Wishlist",
 *     description="Operations related to user wishlists"
 * )
 */
class WishlistController extends Controller
{
    /**
     * @OA\Get(
     *     path="/wishlist",
     *     tags={"Wishlist"},
     *     summary="Get all items in the wishlist",
     *     @OA\Response(
     *         response=200,
     *         description="A list of items in the wishlist",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="wishlist", type="array", @OA\Items(ref="#/components/schemas/WishlistResource"))
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse 
    {
        $wishlist = Wishlist::all();

        return response()->json([
            'success' => true,
            'wishlist' => $wishlist,
        ])->setStatusCode(201);
    }

    /**
     * @OA\Post(
     *     path="/wishlist",
     *     tags={"Wishlist"},
     *     summary="Create a new wishlist item",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Wishlist item created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/WishlistResource")
     *     )
     * )
     */
    public function store(StoreRequest $request): WishlistResource 
    {
        $wishlist = Wishlist::create($request->validated()->all());
        return new WishlistResource($wishlist);
    }

    /**
     * @OA\Delete(
     *     path="/wishlist/{id}",
     *     tags={"Wishlist"},
     *     summary="Delete a wishlist item",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Wishlist item deleted successfully"
     *     )
     * )
     */
    public function destroy(Wishlist $wishlist, DestroyRequest $request): void
    {
        $wishlist->delete();
    }

    /**
     * @OA\Post(
     *     path="/wishlist/{id}/add",
     *     tags={"Wishlist"},
     *     summary="Add a product to the wishlist",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product added to wishlist",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     )
     * )
     */
    public function addToWishlist(Product $product): ProductResource
    {
        auth()->user()->wishlist()->attach($product->id);

        return $this->productResponse($product);
    }

    /**
     * @OA\Delete(
     *     path="/wishlist/{id}/remove",
     *     tags={"Wishlist"},
     *     summary="Remove a product from the wishlist",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product removed from wishlist",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     )
     * )
     */
    public function removeFromWishlist(Product $product): ProductResource
    {
        auth()->user()->wishlist()->detach($product->id);

        return $this->productResponse($product);
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
