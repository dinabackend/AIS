<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function store(Request $request) {
        // Validate the review data - support both translation format and simple format
        $validator = Validator::make($request->all(), [
            'rating' => 'required',
            'name' => 'required',
            'text' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        $validatedData = $validator->validated();

        try {
            $review = new Review();
            $review->rating = $validatedData['rating'];
            $review->date = now()->format('Y-m-d H:i:s');
            $review->status = 0;
            $review->save();
            $translations = [];
            foreach (['ru', 'uz', 'en'] as $locale) {
                $translations[$locale] = [
                    'name' => $validatedData['name'],
                    'text' => $validatedData['text'],
                ];
            }
            $review->fill($translations);
            $review->save();

            return response()->json([
                'success' => true,
                'message' => 'Review created successfully'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create review: ' . $e->getMessage()
            ], 500);
        }
    }
}
