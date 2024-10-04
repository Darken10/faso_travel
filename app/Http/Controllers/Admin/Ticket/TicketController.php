<?php

namespace App\Http\Controllers\Admin\Ticket;

use App\Enums\StatutTicket;
use App\Events\Admin\TicketValiderEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Ticket\searchTicketByNumeroRequest;
use App\Models\Ticket\Payement;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class TicketController extends Controller
{

    public function searchByTelAndCodePage(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('admin.ticket.search-by-numero-and-code');
    }

    public function searchByTelAndCode(SearchTicketByNumeroRequest $request)
    {
        $data = $request->validated();
        $client = User::query()->where('numero', $data['numero'])->get()->first();
        $tickets = Ticket::query()->where('user_id',$client->id)->orWhere('numero_ticket', 'TK '.$data['numero'])->get();
        if (count($tickets) > 0){
            $ticket = $tickets->where('code_sms',$data['code'])->last();
            return  to_route('admin.validation.verification',$ticket);
        }
        return back()->with('error','Les données sont invalides');
    }

    public function verification(Ticket $ticket): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('admin.ticket.info-ticket',[
            'ticket' => $ticket
        ]);
    }

    public function valider(Ticket $ticket)
    {
        if($ticket->statut===StatutTicket::Payer) {
            DB::beginTransaction();
                $ticket->statut = StatutTicket::Valider;
                $ticket->save();
                TicketValiderEvent::dispatch($ticket);

            DB::commit();
            return back()->with('success',`Le ticket de M {$ticket->user->name}  a bien ete valider`);
        }
        return back()->with('error',`Le Ticket de M {$ticket->user->name} est invalide`);

    }

}
