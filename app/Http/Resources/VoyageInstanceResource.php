<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoyageInstanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'date' => $this->date,
            'heure' => $this->heure,
            'nb_place' => $this->nb_place,
            'statut' => $this->statut,
            'voyage' => [
                'id' => $this->voyage->id,
                'trajet' => [
                    'depart' => $this->voyage->trajet->depart->name,
                    'arriver' => $this->voyage->trajet->arriver->name,
                ],
                'compagnie' => [
                    'id' => $this->voyage->compagnie->id,
                    'name' => $this->voyage->compagnie->name,
                ],
            ],
            'chauffeur' => $this->chauffer ? [
                'id' => $this->chauffer->id,
                'nom' => $this->chauffer->first_name . ' ' . $this->chauffer->last_name,
            ] : null,
            'car' => $this->care ? [
                'id' => $this->care->id,
                'immatriculation' => $this->care->immatrculation,
                'places' => $this->care->number_place,
            ] : null,
            'places_disponibles' => count($this->chaiseDispo()),
            'created_at' => $this->created_at,
        ];
    }
}
