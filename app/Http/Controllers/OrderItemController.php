<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\OrderItemResource;
use App\Http\Requests\OrderItem\DestroyRequest;
use App\Http\Requests\OrderItem\StoreRequest;
use App\Models\OrderDetail;
use App\Models\OrderItem;
use App\Models\Product;
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

    public function addOrderItem(OrderItem $orderItem, StoreRequest $request): array
    {
        $orderItems = $orderItem->create([
            'quantity' => $request->item['quantity'],
            'order_detail_id' => $request->orderdetail['id'],
            'product' => $request->product['id'],
        ]);

        $orderDetail = OrderDetail::find($request->orderdetail['id']);
        $product = Product::find($request->product['id']);

        return [
            'order_item' => new OrderItemResource($orderItems),
            'order_detail' => $this->orderDetailResponse($orderDetail),
            'product' => $this->productResponse($product),
        ];
    }

    public function removeOrderItem(OrderItem $orderItem, DestroyRequest $request): ProductResource
    {
        $orderItem->delete();
        return response()->json(['message' => 'Order Item deleted successfully'], 200);
    }

    public function orderDetailResponse(OrderDetail $orderDetail): OrderDetailResource
    {
        return new OrderDetailResource($orderDetail);
    }

    public function productResponse(Product $product): ProductResource
    {
        return new ProductResource($product);
    }
}
