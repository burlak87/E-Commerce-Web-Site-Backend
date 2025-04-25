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

/**
 * @OA\Tag(
 *     name="Products",
 *     description="Operations about products"
 * )
 */
class ProductController extends Controller
{
    protected $product;

    protected $user;

    public function __construct(Product $product, User $user )
    {
        $this->product = $product;
        $this->user = $user;
    }

    /**
     * @OA\Get(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Get list of products",
     *     @OA\Response(
     *         response=200,
     *         description="A list of products",
     *         @OA\JsonContent(ref="#/components/schemas/ProductCollection")
     *     )
     * )
     */
    public function index(FilterRequest $request): ProductCollection
    {
        $data = $request->validated();

        $filter = app()->make(ProductFilter::class, ['queryParams' => array_filter($data)]);

        $posts = Product::filter($filter);

        // $data = $request->validated();

        // $query = Product::query();

        // if (isset($data['category_id'])) {
        //     $query->where('category_id', $data['category_id']);
        // }

        // if (isset($data['title'])) {
        //     $query->where('title', 'like', "%{$data['title']}%");
        // }

        // $posts = $query->get();
        // dd($posts);

        return new ProductCollection($this->product->all());
    }

    /**
     * @OA\Get(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Get a single product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single product",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     )
     * )
     */
    public function show(Product $product): ProductResource 
    {
        return $this->productResponse($product);
    }

    /**
     * @OA\Post(
     *     path="/api/products",
     *     tags={"Products"},
     *     summary="Create a new product",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     )
     * )
     */
    public function store(StoreRequest $request): ProductResource 
    {
        $product = auth()->user()->products()->create($request->validated()['product']);
        return $this->productResponse($product);
    }

    /**
    * @OA\Put(
    *     path="/api/products/{id}",
    *     tags={"Products"},
    *     summary="Update an existing product",
    *     @OA\Parameter(
    *         name="id",
    *         in="path",
    *         required=true,
    *         @OA\Schema(type="integer")
    *     ),
    *     @OA\RequestBody(
    *         required=true,
    *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
    *     ),
    *     @OA\Response(
    *         response=200,
    *         description="Product updated",
    *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
    *     )
    * )
    */
    public function update(Product $product, UpdateRequest $request): ProductResource 
    {
        $product->update($request->validated()['product']);
        return $this->productResponse($product);
    }

    /**
     * @OA\Delete(
     *     path="/api/products/{id}",
     *     tags={"Products"},
     *     summary="Delete a product",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Product deleted"
     *     )
     * )
     */
    public function destroy(Product $product, DestroyRequest $request): void 
    {
        $product->delete();
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
