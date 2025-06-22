<?php

namespace App\Services\V2;

use App\Models\User;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\Trajet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Carbon\Carbon;

class UserService
{
    /**
     * Get authenticated user profile
     *
     * @return User
     */
    public function getProfile(): User
    {
        return Auth::user()->load(['favoris', 'tickets']);
    }

    /**
     * Update user profile
     *
     * @param array $data
     * @return User
     */
    public function updateProfile(array $data): User
    {
        $user = Auth::user();
        
        $user->name = $data['name'] ?? $user->name;
        $user->email = $data['email'] ?? $user->email;
        $user->phone = $data['phone'] ?? $user->phone;
        
        if (isset($data['password']) && !empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        
        $user->save();
        
        return $user;
    }

    /**
     * Update user profile picture
     *
     * @param UploadedFile $file
     * @return User
     */
    public function updateProfilePicture(UploadedFile $file): User
    {
        $user = Auth::user();
        
        // Supprimer l'ancienne image si elle existe
        if ($user->photo && Storage::disk('public')->exists($user->photo)) {
            Storage::disk('public')->delete($user->photo);
        }
        
        // Enregistrer la nouvelle image
        $path = $file->store('users/profile', 'public');
        $user->photo = $path;
        $user->save();
        
        return $user;
    }

    /**
     * Get user travel history
     *
     * @return array
     */
    public function getTravelHistory(): array
    {
        $user = Auth::user();
        
        $tickets = Ticket::with(['voyageInstance.voyage.trajet.depart', 'voyageInstance.voyage.trajet.arriver'])
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        
        return [
            'count' => $tickets->count(),
            'tickets' => $tickets
        ];
    }

    /**
     * Get user favorite routes
     *
     * @return array
     */
    public function getFavoriteRoutes(): array
    {
        $user = Auth::user();
        
        $favoriteRoutes = $user->favoris()
            ->with(['depart', 'arriver'])
            ->get();
        
        return [
            'count' => $favoriteRoutes->count(),
            'routes' => $favoriteRoutes
        ];
    }

    /**
     * Get user statistics
     *
     * @return array
     */
    public function getUserStats(): array
    {
        $user = Auth::user();
        
        $totalTickets = Ticket::where('user_id', $user->id)->count();
        
        $ticketsThisMonth = Ticket::where('user_id', $user->id)
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();
        
        $favoriteRoutes = $user->favoris()->count();
        
        $mostVisitedRoute = Ticket::with(['voyageInstance.voyage.trajet.depart', 'voyageInstance.voyage.trajet.arriver'])
            ->where('user_id', $user->id)
            ->get()
            ->groupBy('voyageInstance.voyage.trajet_id')
            ->map(function ($group) {
                return [
                    'count' => $group->count(),
                    'trajet' => $group->first()->voyageInstance->voyage->trajet
                ];
            })
            ->sortByDesc('count')
            ->first();
        
        return [
            'total_tickets' => $totalTickets,
            'tickets_this_month' => $ticketsThisMonth,
            'favorite_routes' => $favoriteRoutes,
            'most_visited_route' => $mostVisitedRoute ?? null
        ];
    }
}
