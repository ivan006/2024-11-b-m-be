<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */

    public function store(LoginRequest $request): JsonResponse
    {
        // Authenticate the user
        $request->authenticate();

        $user = $request->user();

        // Check if the user's email is verified
        if (is_null($user->email_verified_at)) {
            return response()->json([
                'message' => 'Your email address is not verified.',
            ], 403);
        }

        // Regenerate session (if needed)
        // $request->session()->regenerate();

        // Delete existing tokens
        $user->tokens()->delete();

        // Create a new token
        $token = $user->createToken('api-token');

        // Return the response with user data and the token
        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken,
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
