<?php

namespace App\Http\Controllers\api\admin\ticket;

use Throwable;
use Illuminate\Http\Request;
use App\Models\Ticket\Ticket;
use App\Helper\TicketValidation;
use App\Helper\Payement\Payement;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Models\Voyage\VoyageInstance;
use App\Services\ticket\TicketService;
use App\Events\Admin\TicketValiderEvent;

use Illuminate\Support\Facades\Validator;
use App\Notifications\Ticket\ValiderTicketDeUserNotification;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class TicketApiController extends Controller
{

    public function __construct(private TicketService $ticketService)
    {
    }


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
                'is_valide' => true,
                'is_exist' => true,
                'ticket' => $tickets->last(),
                'message' => [
                    'error' => 'Le code QR du ticket est invalide'
                ]
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
     * @return JsonResponse
     * @throws Throwable
     */
    function validerTicket(Request $request)
    {
        $data = $request->validate([
            'ticket_id' => ['required'],
            'numero_ticket' => ['required'],
            "ticket_code_qr" =>['required'],
        ]);
        /** @var Ticket $ticket */
        $ticket = Ticket::query()->find($data['ticket_id']);

        if ($data['numero_ticket'] === $ticket->numero_ticket and $data['ticket_code_qr'] === $ticket->code_qr) {
            if (TicketValidation::valider($ticket)) {
                TicketValiderEvent::dispatch($ticket);
                $ticket->user->notify(new ValiderTicketDeUserNotification($ticket));
                return response()->json([
                    'success' => true,
                    'error' => false,
                    'ticket' => $ticket->load(["user",'payements','voyage']),
                    'message' => [
                        'success' => 'Ticket Valider avec success'
                    ]
                ],200);
            }
            return response()->json([
                'success' => false,
                'error' => true,
                'ticket' => $ticket,
                'message' => [
                    'error' => 'Le numero de ticket est incorrect'
                ]
            ],200);
        }

        return response()->json([
            'success' => false,
            'error' => true,
            'ticket' => null,
            'message' => [
                'error' => 'Une erreur est survenu lors de la validation du ticket',
            ]
        ]);

    }


    /**
     * @throws Throwable
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


    public function debutAchat(Request $request,VoyageInstance $voyage_instance): JsonResponse
    {

        $user = FacadesAuth::user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => [
                    'error' => 'Vous devez être connecté pour acheter un ticket'
                ]
            ], 401);
        }

        $validator = Validator::make($request->all(),[
            'numero_chaise' => ['required', 'integer'],
            'type' => ['required', 'string', 'in:aller_simple,aller_retour'],
            'is_my_ticket' => ['required', 'boolean'],
            'autre_personne' => ['required_if:is_my_ticket,false', 'array'],
            'a_bagage' => ['boolean'],
            'bagages_data' => ['array']
        ],
            [
                'numero_chaise.required' => 'Le numéro de chaise est requis.',
                'type.required' => 'Le type de ticket est requis.',
                'is_my_ticket.required' => 'Le statut du ticket est requis.',
                'autre_personne.required_if' => 'Les informations de l\'autre personne sont requises si le ticket n\'est pas pour vous.',
            ],
            [
                'numero_chaise' => 'Le numéro de chaise doit être un entier.',
                'type' => 'Le type de ticket doit être soit "aller_simple" soit "aller_retour".',
                'is_my_ticket' => 'Le statut du ticket doit être un booléen.',
                'autre_personne' => 'Les informations de l\'autre personne doivent être un tableau.'
            ]
        );

        $data = $request->all();

        if ($data['is_my_ticket']) {
            $request->validate([
                'autre_personne' => 'nullable',
                'autre_personne.first_name' => 'nullable|string|max:255',
                'autre_personne.last_name' => 'nullable|string|max:20',
                'autre_personne.sexe' => 'nullable|string|max:20',
                'autre_personne.numero_identifiant' => 'nullable|string|max:20',
                'autre_personne.numero' => 'nullable|string|max:100',
                'autre_personne.email' => 'nullable|email|max:255',
                'autre_personne.lien_relation' => 'nullable|string|max:100',

            ], [
                'autre_personne.first_name.string' => 'Le prénom doit être une chaîne de caractères.',
                'autre_personne.last_name.string' => 'Le nom doit être une chaîne de caractères.',
                'autre_personne.sexe.string' => 'Le sexe doit être une chaîne de caractères.',
                'autre_personne.numero_identifiant.string' => 'Le numéro d\'identifiant doit être une chaîne de caractères.',
                'autre_personne.numero.string' => 'Le numéro de téléphone doit être une chaîne de caractères.',
                'autre_personne.email.email' => 'L\'email doit être une adresse email valide.',
                'autre_personne.lien_relation.string' => 'La relation doit être une chaîne de caractères.'
            ],[
                'autre_personne' => 'Les informations de l\'autre personne doivent être un tableau.',
                'autre_personne.first_name' => 'Le prénom de l\'autre personne doit être une chaîne de caractères.',
                'autre_personne.last_name' => 'Le nom de l\'autre personne doit être une chaîne de caractères.',
                'autre_personne.sexe' => 'Le sexe de l\'autre personne doit être une chaîne de caractères.',
                'autre_personne.numero_identifiant' => 'Le numéro d\'identifiant de l\'autre personne doit être une chaîne de caractères.',
                'autre_personne.numero' => 'Le numéro de téléphone de l\'autre personne doit être une chaîne de caractères.',
            ]);
        }



        if ($validator->fails()) {
            return response()->json([
                'message' => 'Validation échouée',
                'errors' => $validator->errors(),
            ], 422);
        }


        $data['user_id'] = FacadesAuth::user()->id();

        $data['voyage_instance_id'] = $voyage_instance->id;

        $ticket = $this->ticketService->createTicket($data);

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => [
                    'error' => 'Une erreur est survenue lors de la création du ticket'
                ]
            ], 500);
        }

        return response()->json([
            'success' => true,
            'ticket' => $ticket,
            'message' => [
                'success' => 'Ticket créé avec succès'
            ]
        ]);
    }

}
