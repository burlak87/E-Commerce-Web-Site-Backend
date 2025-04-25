<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyOrders\UpdateRequest;
use App\Http\Requests\MyOrders\DestroyRequest;
use App\Http\Requests\MyOrders\StoreRequest;
use App\Http\Resources\MyOrdersResource;
use App\http\Resources\MyOrdersCollection;
use App\Models\MyOrders;

/**
 * @OA\Tag(
 *     name="MyOrders",
 *     description="Operations related to user orders"
 * )
 */
class MyOrdersController extends Controller
{
    protected $myOrders;

    public function __construct(MyOrders $myOrders)
    {
        $this->myOrders = $myOrders;
    }
    
    /**
     * @OA\Get(
     *     path="/my-orders",
     *     tags={"MyOrders"},
     *     summary="Get all user orders",
     *     @OA\Response(
     *         response=200,
     *         description="A list of user orders",
     *         @OA\JsonContent(ref="#/components/schemas/MyOrders")
     *     )
     * )
     */
    public function index(): MyOrdersCollection
    {
        return new MyOrdersCollection($this->myOrders->all());
    }

    /**
     * @OA\Get(
     *     path="/my-orders/{id}",
     *     tags={"MyOrders"},
     *     summary="Get a specific order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order details",
     *         @OA\JsonContent(ref="#/components/schemas/MyOrdersResource")
     *     )
     * )
     */
    public function show(MyOrders $myOrders): MyOrdersResource
    {
        return $this->myOrdersResponse($myOrders);
    }

    /**
     * @OA\Post(
     *     path="/my-orders",
     *     tags={"MyOrders"},
     *     summary="Create a new order",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Order created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/MyOrdersResource")
     *     )
     * )
     */
    public function store(StoreRequest $request): MyOrdersResource
    {
        $myOrders = auth()->user()->myOrders()->created($request->validated()['myOrder']);
        return $this->myOrdersResponse($myOrders);
    }

    /**
     * @OA\Put(
     *     path="/my-orders/{id}",
     *     tags={"MyOrders"},
     *     summary="Update an existing order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/UpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Order updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/MyOrdersResource")
     *     )
     * )
     */
    public function update(MyOrders $myOrders, UpdateRequest $request): MyOrdersResource
    {
        $myOrders->update($request->validated()['myOrders']);
        return $this->myOrdersResponse($myOrders);
    }

    /**
     * @OA\Delete(
     *     path="/my-orders/{id}",
     *     tags={"MyOrders"},
     *     summary="Delete an order",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Order deleted successfully"
     *     )
     * )
     */
    public function destroy(MyOrders $myOrders, DestroyRequest $request): void
    {
        $myOrders->delete();
    }

    public function myOrdersResponse(MyOrders $myOrders): MyOrdersResource
    {
        return new MyOrdersResource($myOrders->load('users'));
    }
}
