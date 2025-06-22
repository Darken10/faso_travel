<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\AuthService;
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
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function register(Request $request): JsonResponse
    {
        try {
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

            return response()->json([
                'status' => 'success',
                'message' => 'Utilisateur enregistré avec succès',
                'data' => $result
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Login user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function login(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|email',
                'password' => 'required|string',
            ]);

            $result = $this->authService->login($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Connexion réussie',
                'data' => $result
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 401);
        }
    }

    /**
     * Logout user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $this->authService->logout();

            return response()->json([
                'status' => 'success',
                'message' => 'Déconnexion réussie'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Send OTP
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function sendOtp(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'phone_or_email' => 'required|string',
            ]);

            $result = $this->authService->sendOtp($validated['phone_or_email']);

            return response()->json([
                'status' => 'success',
                'message' => 'Code OTP envoyé avec succès',
                'data' => ['sent' => $result]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Verify OTP
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function verifyOtp(Request $request): JsonResponse
    {
        try {
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
                    'status' => 'error',
                    'message' => 'Code OTP invalide ou expiré'
                ], 400);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Code OTP vérifié avec succès',
                'data' => ['verified' => true]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Send password reset link
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function forgotPassword(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'email' => 'required|string|email',
            ]);

            $result = $this->authService->forgotPassword($validated['email']);

            if (!$result) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Impossible d\'envoyer le lien de réinitialisation'
                ], 400);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Lien de réinitialisation envoyé avec succès',
                'data' => ['sent' => true]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Reset password
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function resetPassword(Request $request): JsonResponse
    {
        try {
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
                    'status' => 'error',
                    'message' => 'Impossible de réinitialiser le mot de passe'
                ], 400);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Mot de passe réinitialisé avec succès',
                'data' => ['reset' => true]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
