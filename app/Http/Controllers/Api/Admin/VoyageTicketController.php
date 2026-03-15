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
            \Log::info("Fetching voyages for date: {$date}");
            
            $voyageInstances = $this->voyageTicketService->getVoyageInstancesByDate($date);
            \Log::info("Found " . count($voyageInstances) . " voyage instances");

            // Load relationships
            $voyageInstances->load([
                'voyage.trajet.depart',
                'voyage.trajet.arriver',
                'voyage.compagnie',
                'care',
                'chauffer',
                'tickets'
            ]);

            $data = $voyageInstances->map(function ($instance) {
                \Log::debug("Processing voyage instance: {$instance->id}");
                return [
                    'id' => $instance->id,
                    'voyage_id' => $instance->voyage_id,
                    'date' => $instance->date,
                    'heure' => $instance->heure,
                    'nb_place' => $instance->nb_place,
                    'prix' => $instance->prix,
                    'statut' => $instance->statut,
                    'tickets_count' => $instance->tickets ? count($instance->tickets) : 0,
                    'validated_tickets_count' => $instance->tickets ? $instance->tickets->filter(fn($t) => $t->statut === 'Valider')->count() : 0,
                    'voyage' => $instance->voyage ? [
                        'id' => $instance->voyage->id,
                        'trajet_id' => $instance->voyage->trajet_id,
                        'heure' => $instance->voyage->heure,
                        'prix' => $instance->voyage->prix,
                        'compagnie' => $instance->voyage->compagnie ? [
                            'id' => $instance->voyage->compagnie->id,
                            'name' => $instance->voyage->compagnie->name,
                            'sigle' => $instance->voyage->compagnie->sigle,
                        ] : null,
                        'trajet' => $instance->voyage->trajet ? [
                            'id' => $instance->voyage->trajet->id,
                            'depart' => $instance->voyage->trajet->depart ? [
                                'id' => $instance->voyage->trajet->depart->id,
                                'name' => $instance->voyage->trajet->depart->name,
                            ] : null,
                            'arriver' => $instance->voyage->trajet->arriver ? [
                                'id' => $instance->voyage->trajet->arriver->id,
                                'name' => $instance->voyage->trajet->arriver->name,
                            ] : null,
                        ] : null,
                    ] : null,
                    'care' => $instance->care ? [
                        'id' => $instance->care->id,
                        'immatrculation' => $instance->care->immatrculation,
                        'number_place' => $instance->care->number_place,
                        'statut' => $instance->care->statut,
                        'image_uri' => $instance->care->image_uri,
                    ] : null,
                    'chauffer' => $instance->chauffer ? [
                        'id' => $instance->chauffer->id,
                        'first_name' => $instance->chauffer->first_name,
                        'last_name' => $instance->chauffer->last_name,
                        'date_naissance' => $instance->chauffer->date_naissance,
                        'genre' => $instance->chauffer->genre,
                    ] : null,
                    'created_at' => $instance->created_at,
                    'updated_at' => $instance->updated_at,
                ];
            });

            return response()->json([
                'success' => true,
                'message' => 'Voyages récupérés avec succès',
                'data' => $data
            ]);
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
