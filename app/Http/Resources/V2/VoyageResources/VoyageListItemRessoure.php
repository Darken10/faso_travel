<?php

namespace App\Http\Resources\V2\VoyageResources;

use Carbon\Carbon;
use App\Enums\TypeTicket;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VoyageListItemRessoure extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'departure' => [
                'city' => $this->voyage->trajet->depart->name,
                'station' => $this->voyage->gareDepart->name,
                'time' => Carbon::parse($this->getHeureDepart()),
                'country' => $this->voyage->trajet->depart->region->pays->name,
            ],
            'arrival' => [
                'city' => $this->voyage->trajet->arriver->name,
                'station' => $this->voyage->gareArriver->name,
                'time' => Carbon::parse($this->getHeureArrive()),
                'country' => $this->voyage->trajet->arriver->region->pays->name,
            ],
            'company' => $this->voyage->compagnie->name,
            'price' => $this->voyage->prix,
            'aller_retour_price' => $this->voyage->getPrix(TypeTicket::AllerRetour),
            'aller_simple_price' => $this->voyage->getPrix(TypeTicket::AllerSimple),
            'duration' => Carbon::parse($this->voyage->temps)->format('H\h i'),
            'availableSeats' => $this->availableSeats(),
            'vehicleType' => 'bus',
            'popularity' => rand(1, 5)
        ];
    }
}


