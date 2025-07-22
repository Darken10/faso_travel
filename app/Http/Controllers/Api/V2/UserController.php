<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use App\Services\V2\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\V2\AuthResource\UserResource;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Get authenticated user profile
     */
    public function getProfile()
    {
        $user = $this->userService->getProfile();
        return new UserResource($user);
    }

    /**
     * Update user profile
     */
    public function updateProfile(Request $request)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|string|email|max:255|unique:users,email,' . (Auth::check() ? Auth::id() : ''),
            'phone' => 'sometimes|string|max:20',
            'password' => 'sometimes|string|min:8',
        ]);
        $user = $this->userService->updateProfile($validated);
        return new UserResource($user);
    }

    /**
     * Update user profile picture
     */
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|max:2048',
        ]);
        $user = $this->userService->updateProfilePicture($request->file('photo'));
        return new UserResource($user);
    }

    /**
     * Get user travel history
     */
    public function getTravelHistory()
    {
        $history = $this->userService->getTravelHistory();
        return response()->json($history);
    }

    /**
     * Get user favorite routes
     */
    public function getFavoriteRoutes()
    {
        $favorites = $this->userService->getFavoriteRoutes();
        return response()->json($favorites);
    }

    /**
     * Get user statistics
     */
    public function getUserStats()
    {
        $stats = $this->userService->getUserStats();
        return response()->json($stats);
    }
}
