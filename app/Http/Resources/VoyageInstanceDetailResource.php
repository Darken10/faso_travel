<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoyageInstanceDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date->format('Y-m-d'),
            'heure' => $this->heure->format('H:i'),
            'nb_place' => $this->nb_place,
            'statut' => $this->statut,
            'prix' => $this->prix,
            'voyage' => [
                'id' => $this->voyage->id,
                'trajet' => [
                    'depart' => [
                        'ville' => $this->villeDepart()->name,
                        'gare' => $this->gareDepart()->name,
                    ],
                    'destination' => [
                        'ville' => $this->villeArrive()->name,
                        'gare' => $this->gareArrive()->name,
                    ],
                    'duree' => $this->voyage->temps
                ],
                'compagnie' => [
                    'id' => $this->compagnie()->id,
                    'name' => $this->compagnie()->name,
                    'logo' => $this->compagnie()->logo,
                    'contact' => $this->compagnie()->contact,
                ],
                'classe' => [
                    'id' => $this->classe()->id,
                    'libelle' => $this->classe()->libelle,
                    'description' => $this->classe()->description,
                    'conforts' => ConfortResource::collection($this->conforts()),
                ],
            ],
            'tickets' => TicketDetailResource::collection($this->tickets),
            'chauffeur' => $this->chauffer ? [
                'id' => $this->chauffer->id,
                'nom_complet' => $this->chauffer->nom,
                'contact' => $this->chauffer->contact,
                'numero_licence' => $this->chauffer->numero_licence,
            ] : null,
            'vehicule' => $this->care ? [
                'id' => $this->care->id,
                'immatriculation' => $this->care?->immatriculation,
                'marque' => $this->care?->marque,
                'modele' => $this->care?->modele,
                'nombre_places' => $this->care?->number_place,
                'climatisation' => $this->care?->climatisation,
            ] : null,
            'statistiques' => [
                'places_disponibles' => $this->chaiseDispo(),
                'places_occupees' => array_diff(range(1, $this->nb_place), $this->chaiseDispo()),
                'total_tickets' => $this->tickets->count(),
                'montant_total' => $this->tickets->sum('prix'),
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
