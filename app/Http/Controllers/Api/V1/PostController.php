<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api\V1;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $posts = Post::paginate();

        return PostResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request): JsonResponse
    {
        $post = Post::create($request->validated());

        return response()->json(new PostResource($post));
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post): JsonResponse
    {
        return response()->json(new PostResource($post));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post): JsonResponse
    {
        $post->update($request->validated());

        return response()->json(new PostResource($post));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Post $post): Response
    {
        $post->delete();

        return response()->noContent();
    }
}
