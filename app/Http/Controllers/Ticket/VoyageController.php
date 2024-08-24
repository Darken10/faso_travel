<?php

namespace App\Http\Controllers\Ticket;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Ville\Ville;

class VoyageController extends Controller
{
    function index() {
         
        return view('ticket.voyage.index');
    }
}
