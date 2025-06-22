<?php

namespace App\Services\V2;

use Carbon\Carbon;
use App\Models\Voyage\Voyage;
use App\Models\Voyage\VoyageInstance;
use App\Models\Voyage\Trajet;
use App\Models\Ville\Ville;
use App\Models\Compagnie\Compagnie;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class VoyageService
{
    /**
     * Get all available trips with optional filters
     *
     * @param array $filters
     * @return Collection
     */
    public function getTrips(array $filters = []): Collection
    {
        $query = VoyageInstance::query()
            ->with([
                'voyage.trajet.depart',
                'voyage.trajet.arriver',
                'voyage.compagnie',
                'voyage.classe'
            ])
            ->whereHas('voyage', function ($q) {
                $q->where('is_quotidient', true);
            });

        // Filter by departure city
        if (isset($filters['departureCity']) && !empty($filters['departureCity'])) {
            $query->whereHas('voyage.trajet.depart', function ($q) use ($filters) {
                $q->where('id', $filters['departureCity']);
            });
        }

        // Filter by arrival city
        if (isset($filters['arrivalCity']) && !empty($filters['arrivalCity'])) {
            $query->whereHas('voyage.trajet.arriver', function ($q) use ($filters) {
                $q->where('id', $filters['arrivalCity']);
            });
        }

        // Filter by date
        if (isset($filters['date']) && !empty($filters['date'])) {
            $date = Carbon::parse($filters['date'])->format('Y-m-d');
            $query->whereDate('date', $date);
        } else {
            // Default to future dates
            $query->whereDate('date', '>=', Carbon::now()->format('Y-m-d'));
        }

        // Filter by company
        if (isset($filters['company']) && !empty($filters['company'])) {
            $query->whereHas('voyage.compagnie', function ($q) use ($filters) {
                $q->where('id', $filters['company']);
            });
        }

        // Get results
        $voyageInstances = $query->get();

        // Transform to API format
        return $voyageInstances->map(function ($instance) use ($filters) {
            $voyage = $instance->voyage;
            $trajet = $voyage->trajet;
            $depart = $trajet->depart;
            $arriver = $trajet->arriver;
            $compagnie = $voyage->compagnie;
            
            // Calculate available seats
            $totalSeats = $voyage->bus->nombre_place ?? 50;
            $occupiedSeats = Ticket::where('voyage_instance_id', $instance->id)
                ->where('statut', '!=', 'annuler')
                ->count();
            $availableSeats = $totalSeats - $occupiedSeats;
            
            // Filter by available seats if needed
            if (isset($filters['passengers']) && $availableSeats < $filters['passengers']) {
                return null;
            }
            
            // Calculate estimated arrival time
            $departureTime = Carbon::parse($instance->date . ' ' . $voyage->heure);
            $duration = $voyage->temps ?? '02:00:00'; // Default 2 hours if not set
            $arrivalTime = (clone $departureTime)->addMinutes(Carbon::parse($duration)->diffInMinutes(Carbon::today()));
            
            return [
                'id' => $instance->id,
                'departure' => [
                    'city' => $depart->nom,
                    'station' => $compagnie->nom,
                    'time' => $departureTime->format('Y-m-d H:i:s')
                ],
                'arrival' => [
                    'city' => $arriver->nom,
                    'station' => $compagnie->nom,
                    'time' => $arrivalTime->format('Y-m-d H:i:s')
                ],
                'company' => $compagnie->nom,
                'price' => $voyage->prix,
                'duration' => $duration,
                'availableSeats' => $availableSeats,
                'vehicleType' => 'bus',
                'popularity' => rand(1, 5) // Placeholder for popularity
            ];
        })->filter()->values();
    }

    /**
     * Get trip details by ID
     *
     * @param int $tripId
     * @return array
     */
    public function getTripDetails(int $tripId): array
    {
        $instance = VoyageInstance::with([
            'voyage.trajet.depart',
            'voyage.trajet.arriver',
            'voyage.compagnie',
            'voyage.classe',
            'voyage.bus'
        ])->findOrFail($tripId);
        
        $voyage = $instance->voyage;
        $trajet = $voyage->trajet;
        $depart = $trajet->depart;
        $arriver = $trajet->arriver;
        $compagnie = $voyage->compagnie;
        $bus = $voyage->bus;
        
        // Calculate available seats
        $totalSeats = $bus->nombre_place ?? 50;
        $occupiedSeats = Ticket::where('voyage_instance_id', $instance->id)
            ->where('statut', '!=', 'annuler')
            ->get();
        $availableSeats = $totalSeats - $occupiedSeats->count();
        
        // Calculate estimated arrival time
        $departureTime = Carbon::parse($instance->date . ' ' . $voyage->heure);
        $duration = $voyage->temps ?? '02:00:00'; // Default 2 hours if not set
        $arrivalTime = (clone $departureTime)->addMinutes(Carbon::parse($duration)->diffInMinutes(Carbon::today()));
        
        // Generate seats information
        $seats = [];
        for ($i = 1; $i <= $totalSeats; $i++) {
            $occupiedSeat = $occupiedSeats->firstWhere('numero_place', $i);
            $status = $occupiedSeat ? 'occupied' : 'available';
            
            $seats[] = [
                'id' => $i,
                'number' => (string) $i,
                'status' => $status,
                'price' => $voyage->prix,
                'type' => 'standard' // Default to standard, can be enhanced later
            ];
        }
        
        return [
            'id' => $instance->id,
            'departure' => [
                'city' => $depart->nom,
                'station' => $compagnie->nom,
                'time' => $departureTime->format('Y-m-d H:i:s')
            ],
            'arrival' => [
                'city' => $arriver->nom,
                'station' => $compagnie->nom,
                'time' => $arrivalTime->format('Y-m-d H:i:s')
            ],
            'company' => $compagnie->nom,
            'price' => $voyage->prix,
            'duration' => $duration,
            'availableSeats' => $availableSeats,
            'vehicleType' => 'bus',
            'popularity' => rand(1, 5), // Placeholder for popularity
            'seats' => $seats
        ];
    }

    /**
     * Get seats availability for a specific trip
     *
     * @param int $tripId
     * @return array
     */
    public function getTripSeats(int $tripId): array
    {
        $instance = VoyageInstance::with(['voyage.bus'])->findOrFail($tripId);
        
        $totalSeats = $instance->voyage->bus->nombre_place ?? 50;
        $occupiedSeats = Ticket::where('voyage_instance_id', $instance->id)
            ->where('statut', '!=', 'annuler')
            ->get();
        
        $seats = [];
        for ($i = 1; $i <= $totalSeats; $i++) {
            $occupiedSeat = $occupiedSeats->firstWhere('numero_place', $i);
            $status = $occupiedSeat ? 'occupied' : 'available';
            
            $seats[] = [
                'id' => $i,
                'number' => (string) $i,
                'status' => $status,
                'price' => $instance->voyage->prix,
                'type' => 'standard' // Default to standard, can be enhanced later
            ];
        }
        
        return ['seats' => $seats];
    }

    /**
     * Search for trips with advanced filters
     *
     * @param array $filters
     * @return Collection
     */
    public function searchTrips(array $filters): Collection
    {
        return $this->getTrips($filters);
    }
}
