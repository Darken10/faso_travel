<?php

namespace App\Listeners;

use App\Enums\TypeNotification;
use App\Events\SendClientTicketByMail;
use App\Events\SendClientTicketByMailEvent;
use App\Helper\TicketHelpers;
use App\Mail\Ticket\TicketMail;
use App\Models\User;
use App\Notifications\GlobaleTicketNotification;
use App\Notifications\Ticket\PayerTicketNotification;
use App\Notifications\Ticket\TicketNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendClientTicketByMailListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SendClientTicketByMailEvent $event): void
    {
        $email = TicketHelpers::getEmailToSendMail($event->ticket);
        Mail::to($email)->send(new TicketMail($event->ticket));
        $title = "Achat de Ticket {$event->ticket->villeDepart()->name} a {$event->ticket->villeArriver()->name}";
        $message = "votre ticket a bien ete payer, un mail vous a ete envoyer avec plus d'information";
        $event->ticket->user->notify(new TicketNotification($event->ticket,TypeNotification::PayerTicket,$title,$message));

        $event->ticket->user->notify(new GlobaleTicketNotification(TypeNotification::PayerTicket,$event->ticket));
    }
}
