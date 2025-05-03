<?php

namespace App\Http\Controllers;

use GuzzleHttp\Psr7\Message;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\JsonResponse;
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
    $data = $request->validated()['user'];

    $data['password'] = bcrypt($data['password']);

    $user = $this->user->create($data);

    $token = $user->createToken('token-name')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token], 201);
  }

  public function update(UpdateRequest $request, $id): JsonResponse
  {
    $user = $request->user();

    \Log::info('Authenticated user:', ['user' => $user]);

    if (!$user || $user->id !== (int)$id) {
      return response()->json(['message' => 'Unauthorized'], 403);
    }

    $data = $request->input('user');

    if (isset($data['first_name'])) {
      $user->first_name = $data['first_name'];
    }

    if (isset($data['last_name'])) {
      $user->last_name = $data['last_name'];
    }

    if (isset($data['role'])) {
      $user->role = $data['role'];
    }

    if (isset($data['phone'])) {
      $user->phone = $data['phone'];
    }

    if (isset($data['email'])) {
      $user->email = $data['email'];
    }

    if (isset($data['password'])) {
      $user->password = bcrypt($data['password']);
    }

    $user->save();

    return response()->json(['message' => 'User  updated successfully', 'user' => $user], 200);
  }

  public function login(LoginRequest $request): JsonResource
  {
    $credentials = $request->validated()['user'];
    $credentials['password'] = bcrypt($credentials['password']);

    if (auth()->attempt($credentials)) {
      $user = auth()->user();
      $token = $user->createToken('token-name')->plainTextToken;
      
      return new JsonResource(['message' => $token, 'user' => $user]);
    }

    return new JsonResource(['message' => 'Unauthorized']);
  }

  public function logout(Request $request)
  {
    auth()->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out successfully']);
  }
}