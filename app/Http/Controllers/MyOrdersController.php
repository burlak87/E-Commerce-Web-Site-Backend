<?php

namespace App\Http\Controllers;

use App\Http\Requests\MyOrders\UpdateRequest;
use App\Http\Requests\MyOrders\DestroyRequest;
use App\Http\Requests\MyOrders\StoreRequest;
use App\Http\Resources\MyOrdersResource;
use App\Http\Resources\MyOrdersCollection;
use App\Models\MyOrders;
use Illuminate\Http\JsonResponse;

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

    public function show($id): JsonResponse
    {
        $address = MyOrders::findOrFail($id);
        return response()->json($address);
    }

    public function store(StoreRequest $request): MyOrdersResource
    {
        $user = $request->user();

        \Log::info('Authenticated user:', ['user' => $user]);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        
        $myOrdersData = $request->validated()['my-order'];

        $myOrdersData['user_id'] = $user->id;

        \Log::info('My Orders data before insert:', $myOrdersData);

        $myOrder = $user->myorders()->create($myOrdersData);

        return $this->myOrdersResponse($myOrder);
    }

    public function destroy(MyOrders $myOrders, DestroyRequest $request): void
    {
        $myOrders->delete();
    }

    public function myOrdersResponse(MyOrders $myOrders): MyOrdersResource
    {
        return new MyOrdersResource($myOrders->load('user'));
    }
}
