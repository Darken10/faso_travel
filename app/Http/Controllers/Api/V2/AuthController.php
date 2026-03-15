<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\AuthService;
use App\DTOs\Auth\LoginDTO;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register a new user
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'first_name' => 'nullable|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'sexe' => 'nullable|string',
            'numero' => 'nullable|integer',
            'numero_identifiant' => 'nullable|string|max:10',
            'role' => 'nullable|string',
            'compagnie_id' => 'nullable|exists:compagnies,id',
        ]);

        $result = $this->authService->register($validated);

        return response()->json($result, 201);
    }

    /**
     * Login user
     */
    public function login(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $result = $this->authService->login(LoginDTO::fromRequest($validated));

        return response()->json($result);
    }

    /**
     * Logout user
     */
    public function logout(Request $request): JsonResponse
    {
        $this->authService->logout();

        return response()->json(['message' => 'Déconnexion réussie']);
    }

    /**
     * Send OTP
     */
    public function sendOtp(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'phone_or_email' => 'required|string',
        ]);

        $result = $this->authService->sendOtp($validated['phone_or_email']);

        return response()->json(['sent' => $result]);
    }

    /**
     * Verify OTP
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'phone_or_email' => 'required|string',
            'otp' => 'required|string|size:6',
        ]);

        $result = $this->authService->verifyOtp(
            $validated['phone_or_email'],
            $validated['otp']
        );

        if (!$result) {
            return response()->json([
                'error' => true,
                'message' => 'Code OTP invalide ou expiré',
                'status' => 400
            ], 400);
        }

        return response()->json(['verified' => true]);
    }

    /**
     * Send password reset link
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
        ]);

        $result = $this->authService->forgotPassword($validated['email']);

        if (!$result) {
            return response()->json([
                'error' => true,
                'message' => "Impossible d'envoyer le lien de réinitialisation",
                'status' => 400
            ], 400);
        }

        return response()->json(['sent' => true]);
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'email' => 'required|string|email',
            'token' => 'required|string',
            'password' => 'required|string|min:8',
        ]);

        $result = $this->authService->resetPassword(
            $validated['token'],
            $validated['password'],
            $validated['email']
        );

        if (!$result) {
            return response()->json([
                'error' => true,
                'message' => 'Impossible de réinitialiser le mot de passe',
                'status' => 400
            ], 400);
        }

        return response()->json(['reset' => true]);
    }
}
