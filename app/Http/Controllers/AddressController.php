<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\Address\DestroyAddressRequest;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\AddressCollection;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressController extends Controller
{
    protected $address;
    protected $user;

    public function __construct(Address $address, User $user) 
    {
        $this->address = $address;
        $this->user = $user;
    }

    public function index(): AddressCollection
    {
        return new AddressCollection($this->address->all());
    }

    public function show($id): JsonResponse
    {
        $address = Address::findOrFail($id);
        return response()->json($address);
    }

    public function store(StoreAddressRequest $request)
    {
        $user = $request->user();

        \Log::info('Authenticated user:', ['user' => $user]);

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $addressData = $request->validated()['addresses'];

        if (empty($addressData['country']) || empty($addressData['street'])) {
            return response()->json(['message' => 'Country and street are required'], 400);
        }

        $addressData['user_id'] = $user->id;

        \Log::info('Address data before insert:', $addressData);

        $address = $user->addresses()->create($addressData);

        return $this->addressResponse($address);
    }

    public function update(Address $address, UpdateAddressRequest $request): AddressResource
    {
        $address->update($request->validated()['address']);
        return $this->addressResponse($address);
    }

    public function destroy(Address $address, DestroyAddressRequest $request): JsonResponse
    {
        $address->delete();

        return response()->json(['message' => 'Address deleted successfully'], 200);
    }

    public function addressResponse(Address $address): AddressResource
    {
        return new AddressResource($address->load('users'));
    }
}
