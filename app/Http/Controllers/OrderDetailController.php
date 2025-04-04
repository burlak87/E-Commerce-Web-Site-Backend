<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderDetailResource;
use App\Http\Resources\ProductResource;
use App\Http\Requests\OrderDetail\DestroyRequest;
use App\Http\Requests\OrderDetail\StoreRequest;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class OrderDetailController extends Controller
{
    public function index(): JsonResponse
    {
        $orderDetail = OrderDetail::all();

        return response()->json([
            'success' => true,
            'orderDetail' => $orderDetail,
        ])->setStatusCode(201);
    }

    public function store(StoreRequest $request): OrderDetailResource
    {
        $orderDetail = OrderDetail::create($request->validated()->all());
        return new OrderDetailResource($orderDetail);
    }

    public function destroy(OrderDetail $orderDetail, DestroyRequest $request): void
    {
        $orderDetail->delete();
        return response()->json(['success' => true, 'message' => 'Order Detail deleted successfully.'], 204);
    }

    public function addToOrderDetail(Product $product): ProductResource
    {
        auth()->user()->order_detail()->attach($product->id);

        return $this->productResponse($product);
    }

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
