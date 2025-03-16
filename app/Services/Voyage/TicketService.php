<?php

namespace App\Services\Voyage;

use App\Enums\StatutTicket;
use App\Enums\TypeTicket;
use App\Helper\TicketHelpers;
use App\Models\Ticket\AutrePersonne;
use App\Models\Ticket\Ticket;
use App\Models\Voyage\VoyageInstance;
use Illuminate\Support\Facades\Auth;

class TicketService
{

    public static function createTicket(string|int $voyage_instance_id, array $data, bool $is_my_ticket): array
    {
        $voyage_instance = VoyageInstance::find($voyage_instance_id);
        $data['voyage_id'] = $voyage_instance->voyage_id;
        $data['statut'] = StatutTicket::EnAttente;
        $data['numero_ticket'] = TicketHelpers::generateTicketNumber();
        $data['code_sms'] = TicketHelpers::generateTicketCodeSms();
        $data['code_qr'] = TicketHelpers::generateTicketCodeQr();
        $data['type']  = $data['type'] == 'aller_retour' ? TypeTicket::AllerRetour : TypeTicket::AllerSimple;
        $data['user_id'] = \auth()->user()->id ;
        $data['is_my_ticket'] = $is_my_ticket;
        $data['a_bagage']  = array_key_exists('a_bagage',$data);
        $data['date'] = $voyage_instance->date;
        $data['voyage_instance_id'] = $voyage_instance_id;

        $tickets = Ticket::query()
            ->whereBelongsTo(Auth::user())
            ->where('voyage_instance_id',$voyage_instance_id)
            ->where('statut',StatutTicket::EnAttente)
            ->where('is_my_ticket', true)
            ->where('type',$data['type'])
            ->get();

        if($tickets->count()===0){
            \DB::beginTransaction();
                if (array_key_exists('autre_personne_id', $data) && !$is_my_ticket){
                    $data['is_my_ticket']= false;
                    $autre = AutrePersonne::find($data['autre_personne_id']);
                    $data['autre_personne_id'] = $autre->id;
                }
                $ticket = Ticket::create($data);
            \DB::commit();

            return [
                'ticket' => $ticket,
                'create'=> true,
            ];

        }
        else{
            $ticket = $tickets->last();
            return [
                'ticket' => $ticket,
                'create'=> false,
            ];
        }

    }




}
