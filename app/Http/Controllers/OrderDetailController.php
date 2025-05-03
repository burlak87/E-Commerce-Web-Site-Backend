<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderDetailResource;
use App\Http\Requests\OrderDetail\DestroyRequest;
use App\Http\Requests\OrderDetail\StoreRequest;
use App\Models\OrderDetail;
use Illuminate\Http\JsonResponse;

class OrderDetailController extends Controller
{
    public function show($orderDetailId): JsonResponse
    {
        $orderDetail = OrderDetail::findOrFail($orderDetailId);

        return response()->json([
            'success' => true,
            'orderDetail' => $orderDetail,
        ])->setStatusCode(201);
    }

    public function store(StoreRequest $request): OrderDetailResource
    {
        $orderDetail = OrderDetail::create($request->validated());
        return new OrderDetailResource($orderDetail);
    }

    public function destroy(OrderDetail $orderDetail, DestroyRequest $request): JsonResponse
    {
        $orderDetail->delete();
        return response()->json(['message' => 'Order detail deleted successfully'], 200);
    }

    // public function calculateTotalOrderCost($orderId) {
    //     $orderItems = OrderItem::where('order_detail_id', $orderId)->with('product')->get();
    //     $totalCost = 0;

    //     foreach ($orderItems as $item) {
    //         $totalCost += $item->quantity * $item->product->price;
    //     }

    //     return $totalCost;
    // }
}
