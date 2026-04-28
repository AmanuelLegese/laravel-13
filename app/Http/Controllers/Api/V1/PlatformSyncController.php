<?php

declare(strict_types=1);
namespace App\Http\Controllers\Api\V1;

use App\Models\PlatformSync;
use Illuminate\Http\Request;
use App\Http\Requests\PlatformSyncRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PlatformSyncResource;

class PlatformSyncController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $platformSyncs = PlatformSync::paginate();

        return PlatformSyncResource::collection($platformSyncs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlatformSyncRequest $request): JsonResponse
    {
        $platformSync = PlatformSync::create($request->validated());

        return response()->json(new PlatformSyncResource($platformSync));
    }

    /**
     * Display the specified resource.
     */
    public function show(PlatformSync $platformSync): JsonResponse
    {
        return response()->json(new PlatformSyncResource($platformSync));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlatformSyncRequest $request, PlatformSync $platformSync): JsonResponse
    {
        $platformSync->update($request->validated());

        return response()->json(new PlatformSyncResource($platformSync));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(PlatformSync $platformSync): Response
    {
        $platformSync->delete();

        return response()->noContent();
    }
}
