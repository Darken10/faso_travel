<?php

namespace App\Http\Controllers\api\admin\ticket;

use App\Enums\MoyenPayment;
use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Events\Admin\TicketValiderEvent;
use App\Helper\Payement\Payement;
use App\Helper\TicketValidation;
use App\Http\Controllers\Controller;
use App\Models\Ticket\Ticket;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketApiController extends Controller
{


    /**
     * chercher une Ticket a travers les infromation inscrite sur le Code QR
     *
     * @param string $ticket_code
     * @return JsonResponse
     * @static
     */

    function verificationByQrCode(string $ticket_code){

        $tickets = Ticket::query()->where('code_qr', $ticket_code)->with(['payements','user'])->get();

        if (count($tickets) >0){
            $ticket = $tickets->last();
            $verificationStatusPayement = Payement::verificationPayementStatutByPayementApi($ticket?->payements->last()?->token,$ticket?->payements?->last()?->moyen_payment);

            return response()->json([
                'is_exist'=> true,
                'is_payement_valide'=> $verificationStatusPayement=== StatutPayement::Complete,
                'payement_statut'=> $verificationStatusPayement,
                'is_valide'=>($verificationStatusPayement=== StatutPayement::Complete and $ticket->statut === StatutTicket::Payer),
                'ticket'=>$tickets->last(),
            ]);
        }

        return response()->json([
            'is_valide' => false,
            'is_exist' => false,
            'ticket' => null,
            'message' => [
                'error' => 'Le code QR du ticket est invalide'
            ]
        ]);
    }


    /**
     * Valide un ticket si l'on a les informations a travers QR Code
     * @param Request $request
     * @param string $ticket_code
     * @return JsonResponse
     * @throws \Throwable
     */
    function validerTicket(Request $request, string $ticket_code)
    {
        $data = $request->validate([
            'ticket_id' => ['required'],
            'numero_ticket' => ['required'],
        ]);
        /** @var Ticket $ticket */
        $ticket = Ticket::query()->find($data['ticket_id']);

        if ($data['numero_ticket'] === $ticket->numero_ticket and $ticket_code === $ticket->code_qr) {
            if (TicketValidation::valider($ticket)) {
                TicketValiderEvent::dispatch($ticket);
                return response()->json([
                    'success' => true,
                    'error' => false,
                    'ticket' => $ticket,
                    'message' => 'Le ticket a ete bien validé',
                ]);
            }
            return response()->json([
                'success' => false,
                'error' => true,
                'ticket' => $ticket,
                'message' => [
                    'error' => 'Le numero de ticket est incorrect'
                ]
            ]);
        }

        return response()->json([
            'is_valide' => false,
            'is_exist' => false,
            'ticket' => null,
            'message' => [
                'error' => 'Une erreur est survenu lors de la validation du ticket',
            ]
        ]);

    }


    /**
     * @throws \Throwable
     */
    function verificationByNumber(Request $request)
    {
        $data = $request->validate([
            'numero' => ['required', 'numeric'],
            'code_sms' => ['required', 'numeric'],
        ]);

        $ticket = TicketValidation::searchTicketByNumberAndCodeSMS($data['numero'], $data['code_sms']);

        if ($ticket instanceof Ticket) {
           return self::verificationByQrCode($ticket->code_qr);
        }
        return response()->json([
            'is_valide' => false,
            'is_exist' => false,
            'ticket' => null,
            'message' => [
                'error' => 'Le numero et ou le code est invalide'
            ]
        ]);
    }


}
