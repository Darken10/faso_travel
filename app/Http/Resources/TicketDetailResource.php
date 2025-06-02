<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketDetailResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'numero_ticket' => $this->numero_ticket,
            'code_qr' => $this->code_qr,
            'code_sms' => $this->code_sms,
            'statut' => $this->statut,
            'type' => $this->type,
            'numero_chaise' => $this->numero_chaise,
            'date' => $this->date->format('Y-m-d'),
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
            'voyage' => [
                'depart' => [
                    'ville' => $this->villeDepart()->nom,
                    'gare' => $this->gareDepart()->nom,
                ],
                'destination' => [
                    'ville' => $this->villeArriver()->nom,
                    'gare' => $this->gareArriver()->nom,
                ],
                'heure_depart' => $this->heureDepart()->format('H:i'),
                'heure_arrivee' => $this->heureArriver()->format('H:i'),
                'heure_rdv' => $this->heureRdv()->format('H:i'),
            ],
            'validation' => [
                'valide' => $this->valider_at !== null,
                'date_validation' => $this->valider_at?->format('Y-m-d H:i:s'),
                'valide_par' => $this->validerBy?->name,
            ],
            'prix' => $this->prix(),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
