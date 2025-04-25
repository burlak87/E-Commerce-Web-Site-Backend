<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Http\Requests\Review\DestroyRequest;
use App\Http\Requests\Review\StoreRequest;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

/**
 * @OA\Tag(
 *     name="Reviews",
 *     description="Operations about reviews"
 * )
 */
class ReviewController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/reviews",
     *     tags={"Reviews"},
     *     summary="Get list of reviews",
     *     @OA\Response(
     *         response=200,
     *         description="A list of reviews",
     *         @OA\JsonContent(ref="#/components/schemas/ReviewCollection")
     *     )
     * )
     */
    public function index(): JsonResponse 
    {
        $reviews = Review::all();

        return response()->json([
            'success' => true,
            'reviews' => $reviews, 
            'count' => $reviews->count(),
        ])->setStatusCode(201);
    }

    /**
     * @OA\Get(
     *     path="/api/reviews/{id}",
     *     tags={"Reviews"},
     *     summary="Get a single review",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A single review",
     *         @OA\JsonContent(ref="#/components/schemas/ReviewResource")
     *     )
     * )
     */
    public function show($id): JsonResponse
    {
        $review = Review::find($id);

        return response()->json([
            'success' => true,
            'review' => $review,
        ])->setStatusCode(201);
    }

    /**
     * @OA\Post(
     *     path="/api/reviews",
     *     tags={"Reviews"},
     *     summary="Create a new review",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ReviewRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Review created",
     *         @OA\JsonContent(ref="#/components/schemas/ReviewResource")
     *     )
     * )
     */
    public function store(StoreRequest $request): ReviewResource 
    {
        $review = Review::create($request->validated()->all());
        return (new ReviewResource($review))->response()->setStatusCode(201);
    }

    /**
     * @OA\Delete(
     *     path="/api/reviews/{id}",
     *     tags={"Reviews"},
     *     summary="Delete a review",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Review deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Review not found"
     *     )
     * )
     */
    public function destroy(Review $review, DestroyRequest $request): void
    {
        $review->delete();
    }
}
