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
            'numero_chaise' => $this->numero_chaise,
            'type' => $this->type,
            'statut' => $this->statut,
            'a_bagage' => $this->a_bagage,
            'bagages_data' => $this->bagages_data,
            'code_qr' => $this->code_qr,
            'code_qr_uri' => $this->code_qr_uri,
            'passager' => [
                'type' => $this->is_my_ticket ? 'client' : 'autre_personne',
                'donnees' => $this->is_my_ticket ? [
                    'id' => $this->user->id,
                    'nom' => $this->user->name,
                    'email' => $this->user->email,
                    'contact' => $this->user->numero,
                ] : [
                    'id' => $this->autre_personne->id,
                    'nom' => $this->autre_personne->nom,
                    'contact' => $this->autre_personne->contact,
                ],
            ],
            'paiements' => $this->payements->map(fn($paiement) => [
                'id' => $paiement->id,
                'montant' => $paiement->montant,
                'methode' => $paiement->methode,
                'status' => $paiement->status,
                'reference' => $paiement->reference,
                'date' => $paiement->created_at->format('Y-m-d H:i:s'),
            ]),
            'validation' => [
                'valide_par' => $this->valider_by_id ? [
                    'id' => $this->validerBy->id,
                    'nom' => $this->validerBy->name,
                ] : null,
                'date_validation' => $this->valider_at,
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
