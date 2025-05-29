<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{


    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'numero_ticket' => $this->numero_ticket,
            'numero_chaise' => $this->numero_chaise,
            'statut' => $this->statut,
            'type' => $this->type,
            'client' => [
                'id' => $this->user->id,
                'name' => $this->user->name,
                'phone' => $this->user->numero,
            ],
            'voyage' => [
                'date' => $this->voyageInstance->date,
                'heure' => $this->voyageInstance->heure,
                'prix' => $this->voyageInstance->getPrix($this->type),
                'ville_depart' => $this->villeDepart()->name,
                'ville_arrive' => $this->villeArriver()->name,
                'compagnie' => $this->compagnie()->name,
            ],
            'validated_at' => $this->valider_at,
            'created_at' => $this->created_at,
        ];
    }
}
