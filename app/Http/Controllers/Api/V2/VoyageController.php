<?php

namespace App\Http\Controllers\Api\V2;

use App\Http\Controllers\Controller;
use App\Services\V2\VoyageService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VoyageController extends Controller
{
    protected $voyageService;

    public function __construct(VoyageService $voyageService)
    {
        $this->voyageService = $voyageService;
    }

    /**
     * Get all available trips with optional filters
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getTrips(Request $request): JsonResponse
    {
        try {
            $filters = [
                'departureCity' => $request->query('departureCity'),
                'arrivalCity' => $request->query('arrivalCity'),
                'date' => $request->query('date'),
                'company' => $request->query('company'),
                'passengers' => $request->query('passengers'),
            ];

            $trips = $this->voyageService->getTrips($filters);

            return response()->json([
                'status' => 'success',
                'trips' => $trips
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get trip details by ID
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getTripDetails(int $id): JsonResponse
    {
        try {
            $trip = $this->voyageService->getTripDetails($id);

            return response()->json($trip);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get seats availability for a specific trip
     *
     * @param int $id
     * @return JsonResponse
     */
    public function getTripSeats(int $id): JsonResponse
    {
        try {
            $seats = $this->voyageService->getTripSeats($id);

            return response()->json($seats);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Search for trips with advanced filters
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchTrips(Request $request): JsonResponse
    {
        try {
            $filters = $request->validate([
                'departureCity' => 'nullable|integer|exists:villes,id',
                'arrivalCity' => 'nullable|integer|exists:villes,id',
                'date' => 'nullable|date_format:Y-m-d',
                'company' => 'nullable|integer|exists:compagnies,id',
                'passengers' => 'nullable|integer|min:1',
                'vehicleType' => 'nullable|string|in:bus,train,ferry',
            ]);

            $trips = $this->voyageService->searchTrips($filters);

            return response()->json([
                'status' => 'success',
                'trips' => $trips
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
