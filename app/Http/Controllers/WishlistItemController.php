<?php

namespace App\Http\Controllers;


use App\Http\Resources\WishlistItemResource;
use App\Http\Resources\WishlistResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\WishlistItem\DestroyRequest;
use App\Http\Requests\WishlistItem\StoreRequest;
use App\Models\Wishlist;
use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Http\JsonResponse;

class WishlistItemController extends Controller
{
    public function index(): JsonResponse
    {
        $wishlistItems = WishlistItem::all();

        return response()->json([
            'success' => true,
            'wishlistItems' => $wishlistItems, 
            'count' => $wishlistItems->count(),
        ]);
    }

    public function addWishlistItem(WishlistItem $wishlistItem, StoreRequest $request): array
    {
        $wishlistItems = $wishlistItem->create([
            'quantity' => $request->item['quantity'],
            'wishlist_id' => $request->wishlist['id'],
            'product_id' => $request->product['id'],
        ]);

        $wishlist = Wishlist::find($request->wishlist['id']);
        $product = Product::find($request->product['id']);

        return [
            'wishlist_item' => new WishlistItemResource($wishlistItems),
            'wishlist' => $this->wishlistResponse($wishlist),
            'product' => $this->productResponse($product),
        ];
    }

    public function removeWishlistItem(WishlistItem $wishlistItem, DestroyRequest $request): JsonResponse
    {
        $wishlistItem->delete();
        return response()->json(['message' => 'Wishlist item deleted successfully'], 201);
    }

    public function wishlistResponse(Wishlist $wishlist): WishlistResource
    {
        return new WishlistResource($wishlist);
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
