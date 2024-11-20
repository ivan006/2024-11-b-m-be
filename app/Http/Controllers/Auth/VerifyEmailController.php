<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Auth\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(Request $request, $id): RedirectResponse
    {
        $user = User::findOrFail($id); // Retrieve the user by ID

        if ($user->hasVerifiedEmail()) {
            return redirect()->intended(
                //config('app.frontend_url').RouteServiceProvider::HOME.'?verified=1'
                config('app.frontend_url').'?verified=1#/login'
            );
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        return redirect()->intended(
            config('app.frontend_url').'?verified=1#/login'
        );
    }
}
