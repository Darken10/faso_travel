<?php

namespace App\Http\Controllers\api\admin\ticket;

use App\Enums\MoyenPayment;
use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Helper\Payement\payement;
use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;

class TicketApiController extends Controller
{


    function verificationByQrCode(string $ticket_code){
        $tickets = Ticket::query()->where('code_qr', $ticket_code)->with('payement')->get();
        if (count($tickets) >0){
            $ticket = $tickets->last();
            $verificationStatusPayement = payement::verificationPayementStatutByPayementApi($ticket->payement->last()->token,MoyenPayment::LigdiCash);
            return response()->json([
                'is_exist'=> true,
                'is_payement_valide'=> $verificationStatusPayement=== StatutPayement::complete,
                'payement_statut'=> $verificationStatusPayement,
                'is_valide'=>($verificationStatusPayement=== StatutPayement::complete and $ticket->statut === StatutTicket::Payer),
                'ticket'=>$tickets->last(),
            ]);
        }

        return response()->json([
            'is_valide'=>false,
            'is_exist'=>false,
            'ticket'=>null,
            'message'=>[
                'error'=>'Le code du ticket est invalide'
            ]
        ]);
    }

}
