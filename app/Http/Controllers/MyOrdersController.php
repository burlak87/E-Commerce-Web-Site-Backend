<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyOrders\UpdateRequest;
use App\Http\Requests\MyOrders\DestroyRequest;
use App\Http\Requests\MyOrders\StoreRequest;
use App\Http\Resources\MyOrdersResource;
use App\http\Resources\MyOrdersCollection;
use App\Models\MyOrders;

class MyOrdersController extends Controller
{
    protected $myOrders;

    public function __construct(MyOrders $myOrders)
    {
        $this->myOrders = $myOrders;
    }
    
    public function index(): MyOrdersCollection
    {
        return new MyOrdersCollection($this->myOrders->all());
    }

    public function show(MyOrders $myOrders): MyOrdersResource
    {
        return $this->myOrdersResponse($myOrders);
    }

    public function store(StoreRequest $request): MyOrdersResource
    {
        $myOrders = auth()->user()->myOrders()->created($request->validated()['myOrder']);
        return $this->myOrdersResponse($myOrders);
    }

    public function update(MyOrders $myOrders, UpdateRequest $request): MyOrdersResource
    {
        $myOrders->update($request->validated()['myOrders']);
        return $this->myOrdersResponse($myOrders);
    }

    public function destroy(MyOrders $myOrders, DestroyRequest $request): void
    {
        $myOrders->delete();
    }

    public function myOrdersResponse(MyOrders $myOrders): MyOrdersResource
    {
        return new MyOrdersResource($myOrders->load('users'));
    }
}
