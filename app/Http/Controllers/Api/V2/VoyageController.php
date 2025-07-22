<?php

namespace App\Http\Controllers\Api\V2;

use Illuminate\Http\Request;
use App\Services\V2\VoyageService;
use App\Http\Controllers\Controller;
use App\Models\Voyage\VoyageInstance;

class VoyageController extends Controller
{
    protected $voyageService;

    public function __construct(VoyageService $voyageService)
    {
        $this->voyageService = $voyageService;
    }

    /**
     * Get all available trips with optional filters
     */
    public function getTrips(Request $request)
    {
        $filters = [
            'departureCity' => $request->query('departureCity'),
            'arrivalCity' => $request->query('arrivalCity'),
            'date' => $request->query('date'),
            'company' => $request->query('company'),
            'passengers' => $request->query('passengers'),
        ];
        $trips = $this->voyageService->getTrips($filters);
        return response()->json($trips);
    }

    /**
     * Get trip details by ID
     */
    public function getTripDetails(string $id)
    {

        $voyage = VoyageInstance::find($id);
        if (!$voyage) {
            return response()->json(['message' => 'Voyage '.$id.' non trouvé'], 404);
        }
        $trip = $this->voyageService->getTripDetails($id);
        return response()->json($trip);
    }

    /**
     * Get seats availability for a specific trip
     */
    public function getTripSeats(string $id)
    {
        $seats = $this->voyageService->getTripSeats($id);
        return response()->json($seats);
    }

    /**
     * Search for trips with advanced filters
     */
    public function searchTrips(Request $request)
    {
        $filters = $request->validate([
            'departureCity' => 'nullable|integer|exists:villes,id',
            'arrivalCity' => 'nullable|integer|exists:villes,id',
            'date' => 'nullable|date_format:Y-m-d',
            'company' => 'nullable|integer|exists:compagnies,id',
            'passengers' => 'nullable|integer|min:1',
            'vehicleType' => 'nullable|string|in:bus,train,ferry',
        ]);
        $trips = $this->voyageService->searchTrips($filters);
        return response()->json($trips);
    }


    /**
     * Get payment modes list
     */
    public function getPaymentModesList()
    {
        $paymentModes = $this->voyageService->getPaymentModesList();
        return response()->json($paymentModes);
    }
}
