<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderItemResource;
use App\Http\Requests\OrderItem\DestroyRequest;
use App\Http\Requests\OrderItem\StoreRequest;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use Illuminate\Http\JsonResponse;

class OrderItemController extends Controller
{
    public function index(): JsonResponse
    {
        $orderItems = OrderItem::all();

        return response()->json([
            'success' => true,
            'orderItems' => $orderItems, 
            'count' => $orderItems->count(),
        ]);
    }

    public function store(OrderDetail $orderDetail, StoreRequest $request) 
    {
        $cartItem = $orderDetail->orderItems()->create([
            'quantity' => $request->item['quantity'],
            'product' => $request->product['id'],
        ]);

        return new OrderItemResource($cartItem);
    }

    public function destroy(OrderDetail $orderDetail, DestroyRequest $request): void
    {
        $orderDetail->delete();
        return response()->json(['success' => true, 'message' => 'Order item deleted successfully.'], 204);
    }
}
