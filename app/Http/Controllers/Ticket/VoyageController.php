<?php

namespace App\Http\Controllers\Ticket;

use App\Http\Requests\Voyage\IsMyTicketBooleanFormRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Voyage\Voyage;

class VoyageController extends Controller
{
    function index() {

        return view('ticket.voyage.index');
    }

    function show(Voyage $voyage){

        return view('ticket.voyage.show',[
            'voyage'=>$voyage,
        ]);
    }

    function acheter(Voyage $voyage){

        return view('ticket.voyage.achaterTicket',[
            'voyage'=>$voyage,
        ]);
    }

    function is_my_ticket(Voyage $voyage)
    {
        return view('ticket.voyage.is-my-ticket',['voyage'=>$voyage]);
    }

    function is_my_ticket_traitement(Voyage $voyage,IsMyTicketBooleanFormRequest $request)
    {
        if ($request->validated()['is_my_ticket'] !== 'is_not_my_ticket'){
            return to_route('voyage.acheter',$voyage);
        }
        dd('acheter pour autre personne');
    }
}
