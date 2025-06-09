<?php

namespace App\Http\Controllers\Api\Voyage;

use App\Http\Controllers\Controller;
use App\Http\Resources\VoyageInstanceResource;
use App\Http\Resources\VoyageInstanceDetailResource;
use App\Http\Resources\TicketResource;
use App\Http\Resources\PassengerResource;
use App\Models\Voyage\VoyageInstance;
use App\Services\Voyage\VoyageInstanceService;
use App\Services\Voyage\TicketService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class VoyageApiContoller extends Controller
{
    public function __construct(
        protected VoyageInstanceService $voyageInstanceService,
        protected TicketService $ticketService
    ) {}

    /**
     * Display a listing of the available voyages.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        $voyages = $this->voyageInstanceService->getAvailableVoyages()->get();
        return response()->json([
            'status' => true,
            'data' => VoyageInstanceResource::collection($voyages)
        ]);
    }

    public function show(string $voyageInstanceId): JsonResponse
    {
        $voyage = $this->voyageInstanceService->getVoyageInstanceWithBasicRelations($voyageInstanceId);
        return response()->json([
            'status' => true,
            'data' => new VoyageInstanceResource($voyage)
        ]);
    }

    public function details(string $voyageInstanceId): JsonResponse
    {
        $voyage = $this->voyageInstanceService->getVoyageInstanceWithFullDetails($voyageInstanceId);
        return response()->json([
            'status' => true,
            'data' => new VoyageInstanceDetailResource($voyage)
        ]);
    }

    public function tickets(string $voyageInstanceId): JsonResponse
    {
        $voyage = VoyageInstance::findOrFail($voyageInstanceId);
        $tickets = $voyage->tickets()
            ->with(['user', 'autre_personne', 'payements'])
            ->get();

        return response()->json([
            'status' => true,
            'data' => TicketResource::collection($tickets)
        ]);
    }

    public function book(Request $request, string $voyageInstanceId): JsonResponse
    {
        $validated = $request->validate([
            'numero_chaise' => 'required|integer',
            'type' => 'required|in:aller_simple,aller_retour',
            'is_my_ticket' => 'required|boolean',
            'autre_personne' => 'required_if:is_my_ticket,false|array',
            'a_bagage' => 'boolean',
            'bagages_data' => 'array'
        ]);

        $result = $this->ticketService->create($voyageInstanceId, $validated, $validated['is_my_ticket']);

        return response()->json([
            'status' => true,
            'message' => 'Ticket réservé avec succès',
            'data' => new TicketResource($result)
        ]);
    }

    public function cancel(string $voyageInstanceId): JsonResponse
    {
        // Implementation selon vos besoins business
        return response()->json([
            'status' => true,
            'message' => 'Réservation annulée'
        ]);
    }

    public function availableSeats(string $voyageInstanceId): JsonResponse
    {
        $voyage = VoyageInstance::findOrFail($voyageInstanceId);

        return response()->json([
            'status' => true,
            'data' => [
                'total_seats' => $voyage->nb_place,
                'available_seats' => $voyage->chaiseDispo(),
                'occupied_seats' => array_diff(
                    range(1, $voyage->nb_place),
                    $voyage->chaiseDispo()
                )
            ]
        ]);
    }

    public function passengers(string $voyageInstanceId): JsonResponse
    {
        $voyage = VoyageInstance::findOrFail($voyageInstanceId);
        $passengers = $voyage->tickets()
            ->with(['user', 'autre_personne'])
            ->get();

        return response()->json([
            'status' => true,
            'data' => PassengerResource::collection($passengers)
        ]);
    }

    public function status(string $voyageInstanceId): JsonResponse
    {
        $voyage = VoyageInstance::with(['care', 'chauffer'])
            ->findOrFail($voyageInstanceId);

        return response()->json([
            'status' => true,
            'data' => [
                'statut' => $voyage->statut,
                'total_places' => $voyage->nb_place,
                'places_disponibles' => count($voyage->chaiseDispo()),
                'places_occupees' => $voyage->nb_place - count($voyage->chaiseDispo()),
                'vehicule' => $voyage->care ? [
                    'immatriculation' => $voyage->care->immatrculation,
                    'status' => $voyage->care->statut
                ] : null,
                'chauffeur' => $voyage->chauffer ? [
                    'nom' => $voyage->chauffer->nom,
                    'contact' => $voyage->chauffer->contact
                ] : null,
                'date_depart' => $voyage->date->format('Y-m-d'),
                'heure_depart' => $voyage->heure->format('H:i')
            ]
        ]);
    }
}
