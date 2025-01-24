<?php

namespace App\Http\Controllers\Ticket;

use App\Enums\StatutTicket;
use App\Enums\StatutUser;
use App\Enums\TypeTicket;
use App\Events\PayementEffectuerEvent;
use App\Events\SendClientTicketByMailEvent;
use App\Events\TranfererTicketToOtherUserEvent;
use App\Models\Ticket\AutrePersonne;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use App\Helper\TicketHelpers;
use App\Models\Voyage\Voyage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\CreateTicketRequest;
use App\Models\Ticket\Ticket;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    private string $storage_public_dir = 'app/public/';

    public function createTicket(CreateTicketRequest $request, Voyage $voyage,Ticket $ticket=null)
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

        $tickets = Ticket::query()
            ->where('transferer_a_user_id',null)
            ->whereBelongsTo(Auth::user())
            ->orWhere('transferer_a_user_id',Auth::user()->id)
            ->latest()->get();

        return view('ticket.ticket.my-tickets',[
            'tickets' => $tickets,
        ]);
    }


    function showMyTicket(Ticket $ticket){

        return view('ticket.ticket.show-my-ticket',[
            'ticket' => $ticket,
        ]);
    }


    function editTicket(Ticket $ticket)
    {
        return view('ticket.ticket.edit-ticket',['ticket' => $ticket]);
    }

    function updateTicket(Ticket $ticket)
    {

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
        $response = TicketHelpers::regenerateTicket($ticket);
        if ($response===true){
            if ($ticket->statut === StatutTicket::Payer  or $ticket->statut === StatutTicket::Pause){
                try {
                    PayementEffectuerEvent::dispatch($ticket);
                    SendClientTicketByMailEvent::dispatch($ticket);

                }catch (Exception $e){
                    return back()->with('error', 'Une erreur inconnu est survenue');
                }
            }
            return back()->with('success', 'Votre ticket a été bien regener et vous serez envoyser par mail');
        }
        elseif($response===false){
            return back()->with('error', 'Desole votre ticket est invalide');
        }else{
            return back()->with('error', 'Une erreur inconnu est survenue');
        }

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



    public function tranfererTicketTraitement(Ticket $ticket, Request $request)
    {
        $data = $request->validate([
            'password'=> ['required'],
            'accepted'=> ['required'],
            'user_id'=> ['required'],
        ]);
        if (\Hash::check($data['password'],$ticket->user->password) ){
            if (($ticket->statut === StatutTicket::Payer or $ticket->statut === StatutTicket::Pause )){
                if (!$ticket->is_my_ticket){
                    return to_route('ticket.myTickets')->with('error', "Desole ce ticket n'est plus en votre possession");
                }
                try {
                    \DB::beginTransaction();
                    $ticket->is_my_ticket = false;
                    $ticket->transferer_at = now();
                    $ticket->transferer_a_user_id = $data['user_id'];
                    $ticket->save();
                    $response = TicketHelpers::regenerateTicket($ticket);

                    \DB::commit();

                }catch(\Exception|\Throwable $e){
                    \DB::rollBack();

                    return back()->with('error',"Une erreur inattendu est survenue! veullier contact l'administrateur");
                }

                if ($response===true){
                    TranfererTicketToOtherUserEvent::dispatch($ticket);
                    return to_route('ticket.myTickets')->with('success', "Votre ticket a été bien transfere vous n'etes plus en possession de ce Ticket");
                }
                elseif($response===false){
                    return back()->with('error', 'Desole votre ticket est invalide');
                }
            }else{
                return back()->with('error',"Le ticket est invalide");
            }
        }else{
            return back()->with('error',"Votre mot de passe incorrect ");
        }
        return back()->with('error',"Une erreur inconun ");
    }

    /*
     *
     */
    function mettreEnPause(Request $request,Ticket $ticket)
    {
            if ($ticket->statut === StatutTicket::Payer){
                if (!$ticket->is_my_ticket and $ticket->transferer_a_user_id !== null){
                    return to_route('ticket.myTickets')->with('error', "Desole ce ticket n'est plus en votre possession");
                }
            }

            try {
                \DB::beginTransaction();
                $ticket->statut = StatutTicket::Pause;
                $ticket->save();
                \DB::commit();
                return to_route('ticket.show-ticket',$ticket)->with('success', "Votre ticket a bien ete mise en pause");

            }catch(\Exception|\Throwable $e){
                \DB::rollBack();
                return back()->with('error',"Une erreur inattendu est survenue! veullier contact l'administrateur");
            }

            }


    function gotoPayment(Ticket $ticket)
    {
        if ($ticket->statut === StatutTicket::EnAttente){
            return view('ticket.ticket.choix-moyen-payment',[
                'ticket' => $ticket,
            ]);
        }
        return redirect()->back()->with('error',"Une erreur inattendu est survenue! Le ticket nest pas en etat d'attent de payement");
    }


}
