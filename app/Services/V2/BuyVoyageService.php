<?php

namespace App\Services\V2;

use App\Models\Ticket\AutrePersonne;
use App\Models\Voyage\VoyageInstance;

use App\Services\Voyage\TicketService;

class BuyVoyageService
{
    /**
     * Buy a ticket for a voyage instance.
     *
     * @param string $id
     * @param array $data
     * @return array
     */
    public function buyTicket(VoyageInstance $voyage_instance, array $data)
    {
        $autrePersonne = null;
        if (!$data['isForSelf']) {
            $autrePersonne = AutrePersonne::create([
                'first_name' => $data['passenger']['first_name'],
                'last_name' => $data['passenger']['last_name'],
                'name' => strtoupper($data['passenger']['first_name']) . ' ' . $data['passenger']['last_name'],
                'email' => $data['passenger']['email'] ?? null,
                'sexe' => $data['passenger']['sexe'] ?? "Homme",
                'numero' => $data['passenger']['numero'] ?? null ,
                'numero_identifiant' => $data['passenger']['numero_identifiant'] ?? '226',
                'lien_relation' => $data['passenger']['lien_relation'] ?? 'Autre',
            ]);
        }


        $res = $this->createReservationTicket($voyage_instance, $data, $autrePersonne);

        // Assuming the purchase is successful, return relevant data
        return [
            'success' => true,
            'message' => $res['message'],
            'ticket' => $res['ticket'] ?? null,
        ];
    }


    private function createReservationTicket(VoyageInstance $voyage_instance, array $data, AutrePersonne $autrePersonne): array
    {
        $dataToCreate =  [
            'voyage_id' => $voyage_instance->voyage_id,
            'accepter' => true,
            'type' => $data['tripType'] == 'round-trip' ? 'aller_retour' : 'aller_simple',
            'autre_personne_id'=> $autrePersonne?->id,
        ];
        $is_my_ticket = $data['isForSelf'] && $autrePersonne!==null ? false : true ;
        $result = TicketService::createTicket($voyage_instance->id,$dataToCreate, $is_my_ticket);
        if (!$result['create']) {
            return [
                'message' => 'A ticket already exists for this voyage instance.',
            ];
        }

        return [
            'message' => 'Ticket created successfully',
        ];
    }
}
