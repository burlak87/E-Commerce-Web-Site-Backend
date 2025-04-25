<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\Address\DestroyAddressRequest;
use App\Http\Requests\Address\StoreAddressRequest;
use App\Http\Resources\AddressResource;
use App\Http\Resources\AddressCollection;
use App\Models\Address;
use App\Models\User;

/**
 * @OA\Tag(
 *     name="Address",
 *     description="Operations related to user addresses"
 * )
 */
class AddressController extends Controller
{
    protected $address;
    protected $user;

    public function __construct(Address $address, User $user) 
    {
        $this->address = $address;
        $this->user = $user;
    }

    /**
     * @OA\Get(
     *     path="/addresses",
     *     summary="Get a list of addresses",
     *     @OA\Response(response="200", description="A list of addresses")
     * )
     */
    public function index(): AddressCollection
    {
        return new AddressCollection($this->address->all());
    }

    /**
     * @OA\Get(
     *     path="/addresses/{id}",
     *     summary="Get a specific address",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="200", description="Address details")
     * )
     */
    public function show(Address $address): AddressResource
    {
        return $this->addressResponse($address);
    }

    /**
     * @OA\Post(
     *     path="/addresses",
     *     summary="Create a new address",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Address")
     *     ),
     *     @OA\Response(response="201", description="Address created")
     * )
     */
    public function store(StoreAddressRequest $request): AddressResource
    {
        $address = auth()->user()->addresses()->create($request->validated()['addresses']);
        return $this->addressResponse($address);
    }

    /**
     * @OA\Put(
     *     path="/addresses/{id}",
     *     summary="Update an existing address",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Address")
     *     ),
     *     @OA\Response(response="200", description="Address updated")
     * )
     */
    public function update(Address $address, UpdateAddressRequest $request): AddressResource
    {
        $address->update($request->validated()['address']);
        return $this->addressResponse($address);
    }

    /**
     * @OA\Delete(
     *     path="/addresses/{id}",
     *     summary="Delete an address",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(response="204", description="Address deleted")
     * )
     */
    public function destroy(Address $address, DestroyAddressRequest $request): void
    {
        $address->delete();
    }

    public function addressResponse(Address $address): AddressResource
    {
        return new AddressResource($address->load('users'));
    }
}
