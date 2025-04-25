<?php

namespace App\Http\Controllers;

use App\Http\Resources\WishlistItemResource;
use App\Http\Requests\WishlistItem\DestroyRequest;
use App\Http\Requests\WishlistItem\StoreRequest;
use App\Models\Wishlist;
use App\Models\WishlistItem;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="WishlistItem",
 *     description="Operations related to items in the wishlist"
 * )
 */
class WishlistItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/wishlist-items",
     *     tags={"WishlistItem"},
     *     summary="Get all items in the wishlist",
     *     @OA\Response(
     *         response=200,
     *         description="A list of items in the wishlist",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="wishlistItems", type="array", @OA\Items(ref="#/components/schemas/WishlistItemResource")),
     *             @OA\Property(property="count", type="integer")
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $wishlistItems = WishlistItem::all();

        return response()->json([
            'success' => true,
            'wishlistItems' => $wishlistItems, 
            'count' => $wishlistItems->count(),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/wishlist/{wishlistId}/items",
     *     tags={"WishlistItem"},
     *     summary="Add a new item to the wishlist",
     *     @OA\Parameter(
     *         name="wishlistId",
     *         in="path",
     *         required=true,
     *         description="Wishlist ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Wishlist item created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/WishlistItemResource")
     *     )
     * )
     */
    public function store(wishlist $wishlist, StoreRequest $request) 
    {
        $wishlistItem = $wishlist->wishlistItems()->create([
            'quantity' => $request->item['quantity'],
            'product' => $request->product['id'],
        ]);

        return new WishlistItemResource($wishlistItem);
    }

    /**
     * @OA\Delete(
     *     path="/wishlist-items/{id}",
     *     tags={"WishlistItem"},
     *     summary="Delete a wishlist item",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Wishlist Item ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Wishlist item deleted successfully"
     *     )
     * )
     */
    public function destroy(WishlistItem $wishlistItem, DestroyRequest $request): void
    {
        $wishlistItem->delete();
    }
}
