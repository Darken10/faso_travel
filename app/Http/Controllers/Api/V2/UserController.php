<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get authenticated user profile
     *
     * @return JsonResponse
     */
    public function getProfile(): JsonResponse
    {
        try {
            $user = $this->userService->getProfile();

            return response()->json([
                'status' => 'success',
                'message' => 'Profil utilisateur récupéré avec succès',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update user profile
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProfile(Request $request): JsonResponse
    {
        try {
            $validated = $request->validate([
                'name' => 'sometimes|string|max:255',
                'email' => 'sometimes|string|email|max:255|unique:users,email,' . auth()->id(),
                'phone' => 'sometimes|string|max:20',
                'password' => 'sometimes|string|min:8',
            ]);

            $user = $this->userService->updateProfile($validated);

            return response()->json([
                'status' => 'success',
                'message' => 'Profil mis à jour avec succès',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Update user profile picture
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function updateProfilePicture(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'photo' => 'required|image|max:2048',
            ]);

            $user = $this->userService->updateProfilePicture($request->file('photo'));

            return response()->json([
                'status' => 'success',
                'message' => 'Photo de profil mise à jour avec succès',
                'data' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }

    /**
     * Get user travel history
     *
     * @return JsonResponse
     */
    public function getTravelHistory(): JsonResponse
    {
        try {
            $history = $this->userService->getTravelHistory();

            return response()->json([
                'status' => 'success',
                'message' => 'Historique de voyage récupéré avec succès',
                'data' => $history
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user favorite routes
     *
     * @return JsonResponse
     */
    public function getFavoriteRoutes(): JsonResponse
    {
        try {
            $favorites = $this->userService->getFavoriteRoutes();

            return response()->json([
                'status' => 'success',
                'message' => 'Trajets favoris récupérés avec succès',
                'data' => $favorites
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get user statistics
     *
     * @return JsonResponse
     */
    public function getUserStats(): JsonResponse
    {
        try {
            $stats = $this->userService->getUserStats();

            return response()->json([
                'status' => 'success',
                'message' => 'Statistiques utilisateur récupérées avec succès',
                'data' => $stats
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
