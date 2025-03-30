<?php

namespace App\Services\ticket;

use App\Enums\StatutTicket;
use App\Enums\TypeTicket;
use App\Helper\TicketHelpers;
use App\Models\Ticket\AutrePersonne;
use App\Models\Ticket\Ticket;

class TicketService
{

    public function create($voyageInstaceId,$data = null,bool $isMine = true)
    {
        $oldeTicket = Ticket::where('voyage_instance_id',$voyageInstaceId)
                        ->where('is_my_ticket',true)
                        ->where('numero_chaise',$data['numero_chaise'])
                        ->where('statut',StatutTicket::EnAttente)
                        ->where('type',$data['voyageType'])
                        ->get();
        if ($oldeTicket->isNotEmpty()){
            return $oldeTicket;
        }

        $data['user_id'] = auth()->id();
        $data['voyage_instance_id'] = $voyageInstaceId;
        $data['statut'] = StatutTicket::EnAttente;
        $data['numero_ticket'] = TicketHelpers::generateTicketNumber();
        $data['code_sms'] = TicketHelpers::generateTicketCodeSms();
        $data['code_qr'] = TicketHelpers::generateTicketCodeQr();
        $data['type']  = $data['voyageType'] == 'aller_retour'? TypeTicket::AllerRetour : TypeTicket::AllerSimple;
        $data['is_my_ticket'] = $isMine;
        if (!$isMine){
            $otherPersonData = $data['otherPerson'];
            $otherPerson = AutrePersonne::create($otherPersonData);
            $data['autre_personne_id'] = $otherPerson->id;
        }
        $data['date'] = now();
        $data['heure'] = now();

        return Ticket::create($data);

    }
}
