<?php

namespace App\Http\Controllers\Ticket\Payement;

use App\Enums\MoyenPayment;
use App\Http\Controllers\Controller;

class PayementTest extends Controller
{

    public function pay(){

        return view('ticket.ticket.payement.testPayementLG');
    }
}
