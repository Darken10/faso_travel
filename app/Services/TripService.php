<?php

namespace App\Services;

use App\Models\Voyage\Voyage;
use App\Models\Voyage\VoyageInstance;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class TripService
{
    /**
     * Get all available trips with optional filters
     *
     * @param array $filters
     * @return Collection
     */
    public function getTrips(array $filters = []): Collection
    {
        $query = VoyageInstance::with(['voyage.trajet', 'voyage.gareDepart', 'voyage.gareArrive', 'voyage.compagnie'])
            ->disponibles();

        if (!empty($filters['departureCity'])) {
            $query->whereHas('voyage.trajet', function ($q) use ($filters) {
                $q->whereHas('depart', function ($q) use ($filters) {
                    $q->where('nom', 'like', '%' . $filters['departureCity'] . '%');
                });
            });
        }

        if (!empty($filters['arrivalCity'])) {
            $query->whereHas('voyage.trajet', function ($q) use ($filters) {
                $q->whereHas('arriver', function ($q) use ($filters) {
                    $q->where('nom', 'like', '%' . $filters['arrivalCity'] . '%');
                });
            });
        }

        if (!empty($filters['date'])) {
            $query->whereDate('date', Carbon::parse($filters['date'])->format('Y-m-d'));
        }

        if (!empty($filters['company'])) {
            $query->whereHas('voyage.compagnie', function ($q) use ($filters) {
                $q->where('nom', 'like', '%' . $filters['company'] . '%');
            });
        }

        return $query->get();
    }

    /**
     * Get trip details by ID
     *
     * @param string $id
     * @return VoyageInstance
     */
    public function getTripById(string $id): VoyageInstance
    {
        return VoyageInstance::with([
            'voyage.trajet', 
            'voyage.gareDepart', 
            'voyage.gareArrive', 
            'voyage.compagnie',
            'tickets'
        ])->findOrFail($id);
    }

    /**
     * Get seats availability for a trip
     *
     * @param string $id
     * @return array
     */
    public function getSeatsAvailability(string $id): array
    {
        $voyageInstance = VoyageInstance::findOrFail($id);
        $availableSeats = $voyageInstance->chaiseDispo();
        
        $seats = [];
        foreach ($availableSeats as $seatNumber) {
            $seats[] = [
                'id' => (string)$seatNumber,
                'number' => (string)$seatNumber,
                'status' => 'available',
                'price' => $voyageInstance->getPrix(\App\Enums\TypeTicket::AllerSimple),
                'type' => 'standard'
            ];
        }
        
        // Ajouter les sièges occupés
        $occupiedSeats = $voyageInstance->tickets()
            ->where('statut', \App\Enums\StatutTicket::Payer)
            ->pluck('numero_chaise')
            ->toArray();
            
        foreach ($occupiedSeats as $seatNumber) {
            $seats[] = [
                'id' => (string)$seatNumber,
                'number' => (string)$seatNumber,
                'status' => 'occupied',
                'price' => $voyageInstance->getPrix(\App\Enums\TypeTicket::AllerSimple),
                'type' => 'standard'
            ];
        }
        
        return $seats;
    }

    /**
     * Search trips with advanced filters
     *
     * @param array $searchData
     * @return Collection
     */
    public function searchTrips(array $searchData): Collection
    {
        $query = VoyageInstance::with(['voyage.trajet', 'voyage.gareDepart', 'voyage.gareArrive', 'voyage.compagnie'])
            ->disponibles();

        if (!empty($searchData['departureCity'])) {
            $query->whereHas('voyage.trajet', function ($q) use ($searchData) {
                $q->whereHas('depart', function ($q) use ($searchData) {
                    $q->where('nom', 'like', '%' . $searchData['departureCity'] . '%');
                });
            });
        }

        if (!empty($searchData['arrivalCity'])) {
            $query->whereHas('voyage.trajet', function ($q) use ($searchData) {
                $q->whereHas('arriver', function ($q) use ($searchData) {
                    $q->where('nom', 'like', '%' . $searchData['arrivalCity'] . '%');
                });
            });
        }

        if (!empty($searchData['date'])) {
            $query->whereDate('date', Carbon::parse($searchData['date'])->format('Y-m-d'));
        }

        if (!empty($searchData['company'])) {
            $query->whereHas('voyage.compagnie', function ($q) use ($searchData) {
                $q->where('nom', 'like', '%' . $searchData['company'] . '%');
            });
        }

        if (!empty($searchData['vehicleType'])) {
            $query->whereHas('voyage.compagnie.care', function ($q) use ($searchData) {
                $q->where('type', $searchData['vehicleType']);
            });
        }

        return $query->get();
    }
}
