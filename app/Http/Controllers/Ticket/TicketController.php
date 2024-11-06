<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\StatutTicket;
use App\Enums\StatutUser;
use App\Enums\TypeTicket;
use App\Events\CreatedQrCodeEvent;
use App\Events\PayementEffectuerEvent;
use App\Events\SendClientTicketByMailEvent;
use App\Models\Ticket\AutrePersonne;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helper\TicketHelpers;
use App\Models\Voyage\Voyage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\Auth;
use Spatie\Browsershot\Browsershot;

class TicketController extends Controller
{
    private string $storage_public_dir = 'app/public/';

    public function createTicket(CreateTicketRequest $request, Voyage $voyage)
    {
        $data = $request->validated();
        $data['voyage_id'] = $voyage->id;
        $data['statut'] = StatutTicket::EnAttente;
        $data['numero_ticket'] = TicketHelpers::generateTicketNumber();
        $data['code_sms'] = TicketHelpers::generateTicketCodeSms();
        $data['code_qr'] = TicketHelpers::generateTicketCodeQr();
        $data['type']  = $data['type'] === 'aller_retour' ? TypeTicket::AllerRetour : TypeTicket::AllerSimple;
        $data['user_id'] = $request->user()->id;
        $data['a_bagage']  = array_key_exists('a_bagage',$data);

        $tickets = Ticket::query()
                ->whereBelongsTo(Auth::user())
                ->whereBelongsTo($voyage)
                ->where('statut',StatutTicket::EnAttente)
                ->where('date', $data['date'])
                ->where('is_my_ticket', true)
                ->get();

       if($tickets->count()===0){
           if (array_key_exists('autre_personne_id', $data)){
               $data['is_my_ticket']= false;
               $autre = AutrePersonne::find($data['autre_personne_id']);
           }

           $ticket = Ticket::create($data);
       }
       else{
            $ticket = $tickets->last();
       }



        return view('ticket.ticket.choix-moyen-payment',[
            'ticket' => $ticket,
        ]);
    }


    function myTickets(){

        $tickets = Ticket::query()->whereBelongsTo(Auth::user())->latest()->get();

        return view('ticket.ticket.my-tickets',[
            'tickets' => $tickets,
        ]);
    }


    function showMyTicket(Ticket $ticket){

        return view('ticket.ticket.show-my-ticket',[
            'ticket' => $ticket,
        ]);
    }

    public function reenvoyer(Ticket $ticket){

        if ($ticket->statut === StatutTicket::Payer or $ticket->statut === StatutTicket::EnAttente or $ticket->statut === StatutTicket::Pause){
            PayementEffectuerEvent::dispatch($ticket);
            SendClientTicketByMailEvent::dispatch($ticket);
        }
        else{
            return back()->with('error', 'Desole votre ticket est invalide');
        }
        return back()->with('success', 'Votre ticket a été re-envoyer par mail');
    }

    public function regenerer(Ticket $ticket){
        try {

            $ticket->image_uri = null;
            $ticket->code_qr = TicketHelpers::generateTicketCodeQr();
            $ticket->code_sms = TicketHelpers::generateTicketCodeSms();
            $ticket->code_qr_uri = null;
            $ticket->pdf_uri = null;
            $ticket->save();

            if ($ticket->statut === StatutTicket::Payer or $ticket->statut === StatutTicket::EnAttente or $ticket->statut === StatutTicket::Pause){
                PayementEffectuerEvent::dispatch($ticket);
                SendClientTicketByMailEvent::dispatch($ticket);
            }
            else{
                return back()->with('error', 'Desole votre ticket est invalide');
            }
        }catch (\Exception $e){
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', 'Votre ticket a été bien regener et vous serez envoyser par mail');
    }

    public function tranfererTicketToOtherUser(Ticket $ticket)
    {
        return view('ticket.ticket.transferer.transfert-choix-user', [
            'ticket' => $ticket,
        ]);
    }

    public function tranfererTicketToOtherUserTraitement(Ticket $ticket,Request $request)
    {
        $data = $request->validate([
            'user_selected'=>['required'],
        ]);
        $user = User::find($data['user_selected']);
        if ($user instanceof User ) {
            if ($user->statut === StatutUser::Active){
                return view('ticket.ticket.transferer.tranferer-ticket-valider-choix',[
                    'user' => $user,
                    'ticket' => $ticket
                ]);
            }
            return back()->with('error',"L'utilisateur choisie n'est pas autoriser a utiliser le syteme");

        }
        return back()->with('error',"L'utilisateur choisie est invalide");

    }


    public function tranfererTicket(Ticket $ticket,Request $request)
    {

    }


}
