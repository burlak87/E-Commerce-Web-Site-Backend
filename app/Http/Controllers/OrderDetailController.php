<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\OrderDetail\DestroyRequest;
use App\Http\Requests\OrderDetail\StoreRequest;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="OrderDetail",
 *     description="Operations related to order details"
 * )
 */
class OrderDetailController extends Controller
{
    /**
     * @OA\Get(
     *     path="/order-details",
     *     tags={"OrderDetail"},
     *     summary="Get all order details",
     *     @OA\Response(
     *         response=200,
     *         description="A list of order details",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="orderDetail", type="array", @OA\Items(ref="#/components/schemas/OrderDetailResource"))
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $orderDetail = OrderDetail::all();

        return response()->json([
            'success' => true,
            'orderDetail' => $orderDetail,
        ])->setStatusCode(201);
    }

    /**
     * @OA\Post(
     *     path="/order-details",
     *     tags={"OrderDetail"},
     *     summary="Create a new order detail",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Order detail created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/OrderDetailResource")
     *     )
     * )
     */
    public function store(StoreRequest $request): OrderDetailResource
    {
        $orderDetail = OrderDetail::create($request->validated()->all());
        return new OrderDetailResource($orderDetail);
    }

    /**
     * @OA\Delete(
     *     path="/order-details/{id}",
     *     tags={"OrderDetail"},
     *     summary="Delete an order detail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order Detail ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Order detail deleted successfully"
     *     )
     * )
     */
    public function destroy(OrderDetail $orderDetail, DestroyRequest $request): void
    {
        $orderDetail->delete();
    }

    /**
     * @OA\Post(
     *     path="/order-details/{id}/add",
     *     tags={"OrderDetail"},
     *     summary="Add product to order detail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order Detail ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product added to order detail",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     )
     * )
     */
    public function addToOrderDetail(Product $product): ProductResource
    {
        auth()->user()->order_detail()->attach($product->id);

        return $this->productResponse($product);
    }

    /**
     * @OA\Delete(
     *     path="/order-details/{id}/remove",
     *     tags={"OrderDetail"},
     *     summary="Remove product from order detail",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order Detail ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product removed from order detail",
     *         @OA\JsonContent(ref="#/components/schemas/ProductResource")
     *     )
     * )
     */
    public function removeFromOrderDetail(Product $product): ProductResource
    {
        auth()->user()->order_detail()->detach($product->id);

        return $this->productResponse($product);
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
