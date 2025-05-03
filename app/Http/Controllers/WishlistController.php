<?php

namespace App\Http\Controllers;

use App\Http\Resources\WishlistResource;
use App\Http\Requests\Wishlist\DestroyRequest;
use App\Http\Requests\Wishlist\StoreRequest;
use App\Models\Wishlist;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    public function show($wishlistId): JsonResponse 
    {
        $wishlist = Wishlist::findOrFail($wishlistId);

        return response()->json([
            'success' => true,
            'wishlist' => $wishlist,
        ])->setStatusCode(201);
    }

    public function store(StoreRequest $request): WishlistResource 
    {
        $wishlist = Wishlist::create($request->validated());
        return new WishlistResource($wishlist);
    }

    public function destroy(Wishlist $wishlist, DestroyRequest $request): JsonResponse
    {
        $wishlist->delete();
        return response()->json(['message' => 'Wishlist deleted successfully'], 200);
    }
}
