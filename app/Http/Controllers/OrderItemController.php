<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemResource;
use App\Http\Requests\OrderItem\DestroyRequest;
use App\Http\Requests\OrderItem\StoreRequest;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="OrderItem",
 *     description="Operations related to order items"
 * )
 */
class OrderItemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/order-items",
     *     tags={"OrderItem"},
     *     summary="Get all order items",
     *     @OA\Response(
     *         response=200,
     *         description="A list of order items",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean"),
     *             @OA\Property(property="orderItems", type="array", @OA\Items(ref="#/components/schemas/OrderItemResource"))
     *         )
     *     )
     * )
     */
    public function index(): JsonResponse
    {
        $orderItems = OrderItem::all();

        return response()->json([
            'success' => true,
            'orderItems' => $orderItems, 
            'count' => $orderItems->count(),
        ]);
    }

    /**
     * @OA\Post(
     *     path="/order-items",
     *     tags={"OrderItem"},
     *     summary="Create a new order item",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/StoreRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Order item created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/OrderItemResource")
     *     )
     * )
     */
    public function store(OrderDetail $orderDetail, StoreRequest $request) 
    {
        $cartItem = $orderDetail->orderItems()->create([
            'quantity' => $request->item['quantity'],
            'product' => $request->product['id'],
        ]);

        return new OrderItemResource($cartItem);
    }

    /**
     * @OA\Delete(
     *     path="/order-items/{id}",
     *     tags={"OrderItem"},
     *     summary="Delete an order item",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Order Item ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Order item deleted successfully"
     *     )
     * )
     */
    public function destroy(OrderDetail $orderDetail, DestroyRequest $request): void
    {
        $orderDetail->delete();
    }
}
