<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

class UserController extends Controller
{
  protected User $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }

  public function show($id)
  {
    $user = User::findOrFail($id);
    return response()->json($user);
  }

  public function store(StoreRequest $request)
  {
    $user = $this->user->create($request->validated()['user']);

    $token = $user->createToken('token-name')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token], 201);
  }

  public function update(UpdateRequest $request, $id)
  {
    $user = auth()->user(); 
    $user->update($request->validated()['user']);

    return response()->json($user);
  }

  public function login(LoginRequest $request): array
  {
    $credentials = $request->validated()['user'];

    if (auth()->attempt($credentials)) {
      $user = auth()->user();
      $token = $user->createToken('token-name')->plainTextToken;

      return response()->json(['token' => $token, 'user' => $user]);
    }

    return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
  }

  public function logout(Request $request)
  {
    auth()->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out successfully']);
  }
}