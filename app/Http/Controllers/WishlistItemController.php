<?php

namespace App\Http\Controllers;

use App\Http\Resources\WishlistItemResource;
use App\Http\Requests\WishlistItem\DestroyRequest;
use App\Http\Requests\WishlistItem\StoreRequest;
use App\Models\Wishlist;
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

    public function store(wishlist $wishlist, StoreRequest $request) 
    {
        $wishlistItem = $wishlist->wishlistItems()->create([
            'quantity' => $request->item['quantity'],
            'product' => $request->product['id'],
        ]);

        return new WishlistItemResource($wishlistItem);
    }

    public function destroy(WishlistItem $wishlistItem, DestroyRequest $request): void
    {
        $wishlistItem->delete();
        return response()->json(['success' => true, 'message' => 'Wishlist item deleted successfully.'], 204);
    }
}
