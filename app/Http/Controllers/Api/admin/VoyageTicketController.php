<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Services\Admin\VoyageTicketService;

class VoyageTicketController extends Controller
{
    protected $voyageTicketService;

    public function __construct(VoyageTicketService $voyageTicketService)
    {
        $this->voyageTicketService = $voyageTicketService;
    }

    /**
     * Récupère les instances de voyage par date pour la compagnie de l'utilisateur connecté
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getVoyageInstancesByDate(Request $request)
    {
        try {
            $date = $request->query('date');
            $voyageInstances = $this->voyageTicketService->getVoyageInstancesByDate($date);

            return response()->json( $voyageInstances->map(function ($instance) {
                    return [
                        'id' => $instance->id,
                        'date' => $instance->date,
                        'heure' => $instance->heure,
                        'trajet' => [
                            'depart' => $instance->voyage->trajet->depart->nom,
                            'arrivee' => $instance->voyage->trajet->arriver->nom
                        ],
                        'care' => $instance->care ? [
                            'id' => $instance->care->id,
                            'matricule' => $instance->care->matricule,
                            'model' => $instance->care->model
                        ]: null,
                        'nb_place_total' => $instance->nb_place,
                        'nb_tickets' => $instance->tickets->count(),
                        'statut' => $instance->statut
                    ];
                })
            );
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des voyages',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Récupère les tickets pour une instance de voyage donnée
     *
     * @param string $voyageInstanceId
     * @return JsonResponse
     */
    public function getTicketsByVoyageInstance($voyageInstanceId)
    {
        try {
            $tickets = $this->voyageTicketService->getTicketsByVoyageInstance($voyageInstanceId);

            return response()->json($tickets);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Une erreur est survenue lors de la récupération des tickets',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
