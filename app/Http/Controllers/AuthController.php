<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // POST /login  (devuelve token Sanctum)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);

        if (! Auth::attempt($credentials)) {
            return response()->json(['message' => 'Credenciales inválidas'], 422);
        }

        /** @var \App\Models\User $user */
        $user = $request->user();
        $token = $user->createToken('api')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'              => $user->id,
                'email'           => $user->email,
                'email_verified'  => $user->hasVerifiedEmail(),
            ],
        ]);
    }

    // POST /logout (revoca token actual o cierra sesión stateful)
    public function logout(Request $request)
    {
        $user = $request->user();

        // Si es token de Sanctum (Bearer)
        if ($user && $user->currentAccessToken()) {
            $user->currentAccessToken()->delete();
        } else {
            // Por si usas Sanctum stateful (cookies)
            Auth::guard('web')->logout();
            $request->session()?->invalidate();
            $request->session()?->regenerateToken();
        }

        return response()->json(['message' => 'Logout ok']);
    }

    // POST /email/verification-notification
    public function resendVerification(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email ya verificado']);
        }

        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Email de verificación enviado']);
    }
}
