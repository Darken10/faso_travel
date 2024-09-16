<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\StatutTicket;
use App\Enums\TypeTicket;
use Illuminate\Http\Request;
use App\Helper\TicketHelpers;
use App\Models\Voyage\Voyage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function createTicket(CreateTicketRequest $request,Voyage $voyage)
    {
        $data = $request->validated();
        $data['voyage_id'] = $voyage->id;
        $data['user_id'] = $request->user()->id;
        $data['statut'] = StatutTicket::EnAttente;
        $data['code_ticket'] = TicketHelpers::generateTicketNumber();
        $data['type']  = $data['type'] === 'aller_retour' ? TypeTicket::AllerRetour : TypeTicket::AllerSimple;
        
        $tickets = Ticket::query()
                ->whereBelongsTo(Auth::user())
                ->whereBelongsTo($voyage)
                ->where('statut',StatutTicket::EnAttente)
                ->where('date', $data['date'])->get();
       
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
}
