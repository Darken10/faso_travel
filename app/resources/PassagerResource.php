<?php

namespace App\resources;

use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Ticket */
class PassagerResource extends JsonResource
{
    /**
     * @param Request $request
     * @return array
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'a_bagage' => $this->a_bagage,
            'date' => $this->date,
            'type' => $this->type,
            'statut' => $this->statut,
            'numero_ticket' => $this->numero_ticket,
            'numero_chaise' => $this->numero_chaise,
            'is_my_ticket' => $this->is_my_ticket,
            'transferer_at' => $this->transferer_at,

            'valider_at' => $this->valider_at,
            'transferer_a_user_id' => $this->transferer_a_user_id,
            'user' => MiniUserResource::make($this->user),
            'voyage_id' => $this->voyage_id,
            'autre_personne_id' => $this->autre_personne_id,
        ];
    }
}
