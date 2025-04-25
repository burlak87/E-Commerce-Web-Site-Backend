<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;

/**
 * @OA\Tag(
 *     name="Users",
 *     description="Operations about users"
 * )
 */
class UserController extends Controller
{
  protected User $user;

  public function __construct(User $user)
  {
    $this->user = $user;
  }


  /**
   * @OA\Get(
   *     path="/users/{id}",
   *     tags={"Users"},
   *     summary="Get a single user",
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         required=true,
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="A single user",
   *         @OA\JsonContent(ref="#/components/schemas/User")
   *     ),
   *     @OA\Response(
   *         response=404,
   *         description="User  not found"
   *     )
   * )
   */
  public function show($id)
  {
    $user = User::findOrFail($id);
    return response()->json($user);
  }

  /**
   * @OA\Post(
   *     path="/users",
   *     tags={"Users"},
   *     summary="Create a new user",
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(ref="#/components/schemas/UserRequest")
   *     ),
   *     @OA\Response(
   *         response=201,
   *         description="User  created",
   *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
   *     )
   * )
   */
  public function store(StoreRequest $request)
  {
    $user = $this->user->create($request->validated()['user']);

    $token = $user->createToken('token-name')->plainTextToken;

    return response()->json(['user' => $user, 'token' => $token], 201);
  }

  /**
   * @OA\Put(
   *     path="/users/{id}",
   *     tags={"Users"},
   *     summary="Update an existing user",
   *     @OA\Parameter(
   *         name="id",
   *         in="path",
   *         required=true,
   *         @OA\Schema(type="integer")
   *     ),
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(ref="#/components/schemas/UserRequest")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="User  updated",
   *         @OA\JsonContent(ref="#/components/schemas/UserResponse")
   *     )
   * )
   */
  public function update(UpdateRequest $request, $id)
  {
    $user = auth()->user(); 
    $user->update($request->validated()['user']);

    return response()->json($user);
  }

  /**
   * @OA\Post(
   *     path="/login",
   *     tags={"Users"},
   *     summary="User  login",
   *     @OA\RequestBody(
   *         required=true,
   *         @OA\JsonContent(ref="#/components/schemas/LoginRequest")
   *     ),
   *     @OA\Response(
   *         response=200,
   *         description="User  logged in",
   *         @OA\JsonContent(ref="#/components/schemas/LoginResponse")
   *     ),
   *     @OA\Response(
   *         response=401,
   *         description="Unauthorized"
   *     )
   * )
   */
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

  /**
   * @OA\Post(
   *     path="/logout",
   *     tags={"Users"},
   *     summary="User  logout",
   *     @OA\Response(
   *         response=200,
   *         description="User  logged out successfully",
   *         @OA\JsonContent(
   *             @OA\Property(property="message", type="string", example="Logged out successfully")
   *         )
   *     )
   * )
   */
  public function logout(Request $request)
  {
    auth()->user()->tokens()->delete();
    return response()->json(['message' => 'Logged out successfully']);
  }
}