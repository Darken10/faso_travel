<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\TripService;
use Illuminate\Http\Request;

class TripController extends Controller
{
    protected $tripService;

    public function __construct(TripService $tripService)
    {
        $this->tripService = $tripService;
    }

    /**
     * Get all trips with optional filtering
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        try {
            $filters = [
                'depart_city' => $request->input('depart_city'),
                'arrive_city' => $request->input('arrive_city'),
                'date' => $request->input('date'),
                'compagnie_id' => $request->input('compagnie_id'),
                'price_min' => $request->input('price_min'),
                'price_max' => $request->input('price_max'),
            ];

            $perPage = $request->input('per_page', 15);
            $trips = $this->tripService->getTrips($filters, $perPage);

            return response()->json([
                'status' => 'success',
                'data' => $trips
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get trip by ID
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $trip = $this->tripService->getTripById($id);

            return response()->json([
                'status' => 'success',
                'data' => $trip
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Get seats availability for a trip instance
     *
     * @param int $tripInstanceId
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSeatsAvailability($tripInstanceId)
    {
        try {
            $seatsAvailability = $this->tripService->getSeatsAvailability($tripInstanceId);

            return response()->json([
                'status' => 'success',
                'data' => $seatsAvailability
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 404);
        }
    }

    /**
     * Search trips with advanced filters
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request)
    {
        try {
            $searchParams = [
                'depart_city' => $request->input('depart_city'),
                'arrive_city' => $request->input('arrive_city'),
                'date_depart' => $request->input('date_depart'),
                'date_retour' => $request->input('date_retour'),
                'passengers' => $request->input('passengers', 1),
                'compagnie_id' => $request->input('compagnie_id'),
                'price_min' => $request->input('price_min'),
                'price_max' => $request->input('price_max'),
                'sort_by' => $request->input('sort_by', 'price'),
                'sort_direction' => $request->input('sort_direction', 'asc'),
            ];

            $perPage = $request->input('per_page', 15);
            $results = $this->tripService->searchTrips($searchParams, $perPage);

            return response()->json([
                'status' => 'success',
                'data' => $results
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
