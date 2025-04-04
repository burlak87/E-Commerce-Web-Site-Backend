<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\Address\DestroyAddressRequest;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\AddressCollection;
use App\Models\Address;
use App\Models\User;

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

    public function show(Address $address): AddressResource
    {
        return $this->addressResponse($address);
    }

    public function store(StoreAddressRequest $request): AddressResource
    {
        $address = auth()->user()->addresses()->created($request->validated()['address']);
        return $this->addressResponse($address);
    }

    public function update(Address $address, UpdateAddressRequest $request): AddressResource
    {
        $address->update($request->validated()['address']);
        return $this->addressResponse($address);
    }

    public function destroy(Address $address, DestroyAddressRequest $request): void
    {
        $address->delete();
    }

    public function addressResponse(Address $address): AddressResource
    {
        return new AddressResource($address->load('users'));
    }
}
