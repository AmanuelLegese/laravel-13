<?php

namespace App\Http\Controllers\Api;

use App\Models\Account;
use Illuminate\Http\Request;
use App\Http\Requests\AccountRequest;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\AccountResource;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $accounts = Account::paginate();

        return AccountResource::collection($accounts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AccountRequest $request): JsonResponse
    {
        $account = Account::create($request->validated());

        return response()->json(new AccountResource($account));
    }

    /**
     * Display the specified resource.
     */
    public function show(Account $account): JsonResponse
    {
        return response()->json(new AccountResource($account));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AccountRequest $request, Account $account): JsonResponse
    {
        $account->update($request->validated());

        return response()->json(new AccountResource($account));
    }

    /**
     * Delete the specified resource.
     */
    public function destroy(Account $account): Response
    {
        $account->delete();

        return response()->noContent();
    }
}
