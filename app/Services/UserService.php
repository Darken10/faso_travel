<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class UserService
{
    /**
     * Get the authenticated user's profile
     *
     * @return User
     */
    public function getProfile(): User
    {
        return Auth::user()->load(['tickets']);
    }

    /**
     * Update the authenticated user's profile
     *
     * @param array $data
     * @return User
     */
    public function updateProfile(array $data): User
    {
        $user = Auth::user();
        
        // Update basic information
        $user->fill([
            'name' => $data['name'] ?? $user->name,
            'email' => $data['email'] ?? $user->email,
            'phone' => $data['phone'] ?? $user->phone,
        ]);
        
        // Update password if provided
        if (!empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }
        
        $user->save();
        
        return $user;
    }

    /**
     * Update the user's profile picture
     *
     * @param UploadedFile $file
     * @return User
     */
    public function updateProfilePicture(UploadedFile $file): User
    {
        $user = Auth::user();
        
        // Delete old profile picture if exists
        if ($user->profile_picture && Storage::disk('public')->exists($user->profile_picture)) {
            Storage::disk('public')->delete($user->profile_picture);
        }
        
        // Store new profile picture
        $path = $file->store('profile_pictures', 'public');
        $user->profile_picture = $path;
        $user->save();
        
        return $user;
    }

    /**
     * Get user's travel history
     *
     * @return array
     */
    public function getTravelHistory(): array
    {
        $user = Auth::user();
        $tickets = $user->tickets()
            ->with(['voyageInstance.voyage'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return [
            'tickets' => $tickets,
            'count' => $tickets->count()
        ];
    }

    /**
     * Get user's favorite routes
     *
     * @return array
     */
    public function getFavoriteRoutes(): array
    {
        $user = Auth::user();
        
        // Get most frequent routes from user's tickets
        $favoriteRoutes = $user->tickets()
            ->with(['voyageInstance.voyage.trajet'])
            ->get()
            ->groupBy(function ($ticket) {
                return $ticket->voyageInstance->voyage->trajet_id;
            })
            ->map(function ($tickets, $trajetId) {
                $firstTicket = $tickets->first();
                $trajet = $firstTicket->voyageInstance->voyage->trajet;
                
                return [
                    'trajet_id' => $trajetId,
                    'depart' => $trajet->ville_depart,
                    'arrivee' => $trajet->ville_arrivee,
                    'count' => $tickets->count(),
                    'last_travel' => $tickets->sortByDesc('created_at')->first()->created_at
                ];
            })
            ->sortByDesc('count')
            ->values()
            ->take(5);
            
        return $favoriteRoutes->toArray();
    }

    /**
     * Get user's statistics
     *
     * @return array
     */
    public function getUserStats(): array
    {
        $user = Auth::user();
        $tickets = $user->tickets;
        
        $totalTrips = $tickets->count();
        $totalSpent = $tickets->sum('prix');
        $canceledTrips = $tickets->where('status', 'annulé')->count();
        $upcomingTrips = $tickets->whereHas('voyageInstance', function ($query) {
            $query->where('date_depart', '>', now());
        })->count();
        
        return [
            'total_trips' => $totalTrips,
            'total_spent' => $totalSpent,
            'canceled_trips' => $canceledTrips,
            'upcoming_trips' => $upcomingTrips
        ];
    }
}
