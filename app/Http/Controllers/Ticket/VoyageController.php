<?php

namespace App\Http\Controllers\Ticket;

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
}
