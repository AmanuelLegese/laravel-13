<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api\V1;

use App\Models\PostMedia;
use Illuminate\Http\Request;
use App\Http\Requests\PostMediaRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostMediaResource;

class PostMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $postMedia = PostMedia::paginate();

        return PostMediaResource::collection($postMedia);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostMediaRequest $request): JsonResponse
    {
        $postMedia = PostMedia::create($request->validated());

        return response()->json(new PostMediaResource($postMedia));
    }

    /**
     * Display the specified resource.
     */
    public function show(PostMedia $postMedia): JsonResponse
    {
        return response()->json(new PostMediaResource($postMedia));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostMediaRequest $request, PostMedia $postMedia): JsonResponse
    {
        $postMedia->update($request->validated());

        return response()->json(new PostMediaResource($postMedia));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(PostMedia $postMedia): Response
    {
        $postMedia->delete();

        return response()->noContent();
    }
}
