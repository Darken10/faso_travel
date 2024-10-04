<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\StatutTicket;
use App\Enums\TypeTicket;
use App\Events\CreatedQrCodeEvent;
use App\Events\PayementEffectuerEvent;
use App\Events\SendClientTicketByMailEvent;
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
        $data['user_id'] = $request->user()->id;
        $data['statut'] = StatutTicket::EnAttente;
        $data['numero_ticket'] = TicketHelpers::generateTicketNumber();
        $data['code_sms'] = TicketHelpers::generateTicketCodeSms();
        $data['code_qr'] = TicketHelpers::generateTicketCodeQr();
        $data['type']  = $data['type'] === 'aller_retour' ? TypeTicket::AllerRetour : TypeTicket::AllerSimple;

        $tickets = Ticket::query()
                ->whereBelongsTo(Auth::user())
                ->whereBelongsTo($voyage)
                ->where('statut',StatutTicket::EnAttente)
                ->where('date', $data['date'])
                ->get();

       if($tickets->count()===0){
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

    public function regenerer(Ticket $ticket){
        PayementEffectuerEvent::dispatch($ticket);
        SendClientTicketByMailEvent::dispatch($ticket);
        return back()->with('success', 'Votre ticket a été regener avec succes et vous sera envoyer par mail');
    }



}
