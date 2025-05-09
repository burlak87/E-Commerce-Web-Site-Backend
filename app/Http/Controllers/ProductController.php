<?php

namespace App\Http\Controllers;

use App\Http\Filters\ProductFilter;
use App\Http\Requests\Product\FilterRequest;
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

    public function index(FilterRequest $request): ProductCollection
    {
        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $products = Product::filter($filter)->get();

        return new ProductCollection($products);
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
