<?php

namespace App\Http\Controllers;

use App\Http\Resources\WishlistResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\Wishlist\DestroyRequest;
use App\Http\Requests\Wishlist\StoreRequest;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class WishlistController extends Controller
{
    public function index(): JsonResponse 
    {
        $wishlist = Wishlist::all();

        return response()->json([
            'success' => true,
            'wishlist' => $wishlist,
        ])->setStatusCode(201);
    }

    public function store(StoreRequest $request): WishlistResource 
    {
        $wishlist = Wishlist::create($request->validated()->all());
        return new WishlistResource($wishlist);
    }

    public function destroy(Wishlist $wishlist, DestroyRequest $request): void
    {
        $wishlist->delete();
        return response()->json(['success' => true, 'message' => 'Wishlist deleted successfully.'], 204);
    }

    public function addToWishlist(Product $product): ProductResource
    {
        auth()->user()->wishlist()->attach($product->id);

        return $this->productResponse($product);
    }

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
