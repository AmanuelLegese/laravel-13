<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\PersonalAccessToken;

class AuthController extends Controller
{
    /**
     * Handle the login request.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthRequest $request): \Illuminate\Http\JsonResponse
    {
        if (!auth()->attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials. check your email and password and try again.',
            ], 401);
        }

        // Generate a new token for the authenticated user
        $token = $request->user()->createToken('Personal Access Token');
        $token->accessToken->expires_at = now()->addDays(7); // Set token expiration (optional)
        $token->accessToken->save();
        return response()->json([
            'message' => 'Login successful',
            'user'  => $request->user(),
            'token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_at' => now()->diffAsCarbonInterval($token->accessToken->expires_at)->forHumans(['parts' => 2]) ,
        ]);
    }

    /**
     * Handle the logout request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): \Illuminate\Http\JsonResponse
    {
        auth()->user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logout successful',
        ]);
    }

    /**
     * Handle the token refresh request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(): \Illuminate\Http\JsonResponse
    {
        $user = auth()->user();
        $user->currentAccessToken()->delete(); // Revoke the current token
        $token = $user->createToken('Personal Access Token'); // Create a new token
        $token->accessToken->expires_at = now()->addDays(7); // Set token expiration (optional)
        $token->accessToken->save();
        return response()->json([
            'message' => 'Token refreshed successfully',
            'token' => $token->plainTextToken,
            'token_type' => 'Bearer',
            'expires_at' => now()->diffAsCarbonInterval($token->accessToken->expires_at)->forHumans(['parts' => 2]) ,
        ]);
    }

    /**
     * Handle the token validation request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function validateToken(Request $request): \Illuminate\Http\JsonResponse
    {
        $tokenString = $request->token; // The plain text token from the user

        // 1. Find the token in the database
        $token = PersonalAccessToken::findToken($tokenString);

        // 2. Check if it exists and isn't expired
        if (! $token) {
            return response()->json(['message' => 'Token not found'], 401);
        }

        if ($token->expires_at && $token->expires_at->isPast()) {
            return response()->json(['message' => 'Token expired'], 401);
        }

        return response()->json([
            'message' => 'Token is valid',
            'user' => $token->tokenable // This is the User model
        ]);
    }

    /**
     * Handle the token revocation request.
     * @return \Illuminate\Http\JsonResponse
     */
    public function revoke(Request $request): \Illuminate\Http\JsonResponse
    {
        $tokenString = $request->token; // The plain text token from the user
        $token = PersonalAccessToken::findToken($tokenString);
        if (! $token) {
            return response()->json(['message' => 'Token not found'], 401);
        }
        $token->delete(); // Revoke the token
        return response()->json(['message' => 'Token revoked successfully']);
    }

    /**
     * Register a new user.
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = \App\Models\User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user
        ], 201);
    }
}
