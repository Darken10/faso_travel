<?php

namespace App\Services\V2;

use Carbon\Carbon;
use App\Models\Ville;
use App\Models\Compagnie;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\Voyage;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use App\Models\Voyage\VoyageInstance;
use App\Http\Resources\ApiV2\TripResource;

class VoyageService
{
    /**
     * Get all available trips with optional filters
     *
     * @param array $filters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function getTrips(array $filters = [])
    {
        $query = VoyageInstance::query()
            ->with([
                'voyage.trajet.depart',
                'voyage.trajet.arriver',
                'voyage.compagnie',
                'voyage.classe',
                'care'
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

        // Filter by minimum seats if needed
        if (isset($filters['passengers']) && is_numeric($filters['passengers'])) {
            $query->whereHas('voyage.bus', function($q) use ($filters) {
                $q->where('nombre_place', '>=', $filters['passengers']);
            });
        }

        // Order by departure time
        $query->orderBy('date')
              ->orderBy(DB::raw("TIME(heure)"));

        // Get results and apply resource transformation
        $voyageInstances = $query->paginate(20);

        return $voyageInstances;
    }

    /**
     * Get trip details by ID
     *
     * @param string $tripId
     */
    public function getTripDetails(string $tripId) :VoyageInstance
    {
        $instance = VoyageInstance::with([
            'voyage.trajet.depart',
            'voyage.trajet.arriver',
            'voyage.compagnie',
            'voyage.classe',
            'care'
        ])->findOrFail($tripId);

        return $instance;
    }

    /**
     * Get seats availability for a specific trip
     *
     * @param string $tripId
     * @return array
     */
    public function getTripSeats(string $tripId): array
    {
        $instance = VoyageInstance::with('voyage.bus')->findOrFail($tripId);
        $totalSeats = $instance->voyage->bus->nombre_place ?? 50;
        
        $voyage = $instance->voyage;
        $bus = $voyage->bus;
        
        // Calculate available seats
        $totalSeats = $bus->nombre_place ?? 50;
        $occupiedSeats = Ticket::where('voyage_instance_id', $tripId)
            ->where('statut', '!=', 'annuler')
            ->get();
        $availableSeats = $totalSeats - $occupiedSeats->count();
        
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
            'total_seats' => $totalSeats,
            'available_seats' => $availableSeats,
            'occupied_seats' => $occupiedSeats->count(),
            'seats' => $seats
        ];
    }


    /**
     * Search for trips with advanced filters
     *
     * @param array $filters
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function searchTrips(array $filters)
    {
        return $this->getTrips($filters);
    }
}
