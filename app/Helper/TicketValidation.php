<?php

namespace App\Helper;

use App\Enums\StatutTicket;
use App\Events\Admin\TicketValiderEvent;
use App\Events\Ticket\TicketActiveEvent;
use App\Events\Ticket\TicketBlockerEvent;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TicketValidation
{
    /**
     * permet de valider un ticket
     * @param Ticket $ticket
     * @return bool
     * @throws \Throwable
     */
    public static function valider(Ticket $ticket):bool
    {
        DB::beginTransaction();
        $ticket->statut = StatutTicket::Valider;
        $ticket->valider_by_id = \Auth::user()->id?? 1;
        $ticket->valider_at = now();
        $ticket->save();
        DB::commit();

        if ($ticket->statut === StatutTicket::Valider){
            TicketValiderEvent::dispatch($ticket);
            return true;
        }else{
            return false;
        }
    }


    /**
     * rechercher un ticket a travers le numero de tel ou numero_Ticket et le code SMS
     * @param $numero
     * @param $codeSMS
     * @return Ticket|null
     */
    public static function searchTicketByNumberAndCodeSMS($numero, $codeSMS): Ticket|null
    {

        /** @var User $user */
        $user = User::query()->where('numero', $numero)->get()->first();

        /** @var Collection<Ticket> $tickets */
        $tickets = Ticket::query()->where('user_id',$user?->id)->orWhere('numero_ticket', 'TK '.$numero)->get();
        if (count($tickets) > 0){
            /** @var Ticket $ticket */
            $ticket = $tickets->where('code_sms',$codeSMS)->last();
            if (($ticket instanceof Ticket)){
                return $ticket;
            }
        }
            return  null;
    }

    /**
     * permet de valider un ticket
     * @param Ticket $ticket
     * @return bool
     * @throws \Throwable
     */
    public static function bloque(Ticket $ticket):bool
    {
        DB::beginTransaction();
        $ticket->statut = StatutTicket::Bloquer;
        $ticket->save();
        DB::commit();

        if ($ticket->statut === StatutTicket::Bloquer){
            TicketBlockerEvent::dispatch($ticket);
            return true;
        }else{
            return false;
        }
    }


    /**
     * permet de valider un ticket
     * @param Ticket $ticket
     * @return bool
     * @throws \Throwable
     */
    public static function pause(Ticket $ticket):bool
    {
        DB::beginTransaction();
        $ticket->statut = StatutTicket::Pause;
        $ticket->save();
        DB::commit();

        if ($ticket->statut === StatutTicket::Pause){
            TicketBlockerEvent::dispatch($ticket);
            return true;
        }else{
            return false;
        }
    }

    /**
     * @throws \Throwable
     */
    public static function active(Ticket $ticket): bool
    {
        DB::beginTransaction();
        $ticket->statut = StatutTicket::Pause;
        $ticket->save();
        DB::commit();

        if ($ticket->statut === StatutTicket::Pause){
            TicketActiveEvent::dispatch($ticket);
            return true;
        }else{
            return false;
        }
    }


}
