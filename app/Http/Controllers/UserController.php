<?php

namespace App\Http\Controllers;

use App\Http\Requests\Address\AddressRequest;
use App\Http\Requests\Address\UpdateAddressRequest;
use App\Http\Requests\User\UpdateUserRequest;
use App\Http\Requests\User\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index() 
    {
      return User::all();
    }

    public function show($id) 
    {
      return User::find($id);
    }

    public function store(UserRequest $request) 
    {
      User::create($request->validated()->all());
      return response()->json('user is added', 201);
    }

    public function update(UpdateUserRequest $request, $id) 
    {
      $user = User::find($id);

      if (!$user) return response()->json(['message'=> 'No user found'],404);

      $user->update($request->validated()->all());

      return response()->json('user is updated', 201);
    }

    public function destroy($id) 
    {
      User::find($id)->delete();
      return response()->json('user is deleted', 201);

      // $user = User::withTrashed()->find($id);
      // $user->restore();
      // dd('restored');
    }
}
