<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\UpdateRequest;
use App\Http\Requests\Product\DestroyRequest;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    protected $product;

    protected $user;

    public function __construct(Product $product, User $user )
    {
        $this->product = $product;
        $this->user = $user;
    }

    public function index(): ProductCollection
    {
        return new ProductCollection($this->product->all());
    }

    public function show(Product $product): ProductResource 
    {
        return $this->productResponse($product);
    }

    public function store(StoreRequest $request): ProductResource 
    {
        $product = auth()->user()->products()->create($request->validated()['product']);
        return $this->productResponse($product);
    }

    public function update(Product $product, UpdateRequest $request): ProductResource 
    {
        $product->update($request->validated()['product']);
        return $this->productResponse($product);
    }

    public function destroy(Product $product, DestroyRequest $request): void 
    {
        $product->delete();
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
