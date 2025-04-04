<?php

namespace App\Http\Controllers;

use App\Http\Resources\ReviewResource;
use App\Http\Requests\Review\DestroyRequest;
use App\Http\Requests\Review\StoreRequest;
use App\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    public function index(): JsonResponse 
    {
        $reviews = Review::all();

        return response()->json([
            'success' => true,
            'reviews' => $reviews, 
            'count' => $reviews->count(),
        ])->setStatusCode(201);
    }

    public function show($id): JsonResponse
    {
        $review = Review::find($id);

        return response()->json([
            'success' => true,
            'review' => $review,
        ])->setStatusCode(201);
    }

    public function store(StoreRequest $request): ReviewResource 
    {
        $review = Review::create($request->validated()->all());
        return (new ReviewResource($review))->response()->setStatusCode(201);
    }

    public function destroy(Review $review, DestroyRequest $request): void
    {
        $review->delete();
        return response()->json(['success' => true, 'message' => 'Review deleted successfully.'], 204);
    }
}
