<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PassengerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'ticket_numero' => $this->numero_ticket,
            'siege' => $this->numero_chaise,
            'passager' => $this->is_my_ticket ? [
                'type' => 'client',
                'nom' => $this->user->name,
                'telephone' => $this->user->numero,
                'email' => $this->user->email,
            ] : [
                'type' => 'autre',
                'nom' => $this->autre_personne->nom,
                'telephone' => $this->autre_personne->contact,
            ],
            'statut' => $this->statut,
            'a_bagage' => $this->a_bagage,
            'bagages' => $this->bagages_data,
        ];
    }
}
