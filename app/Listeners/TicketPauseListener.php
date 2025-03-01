<?php

namespace App\Listeners;

use App\Enums\TypeNotification;
use App\Events\Ticket\TicketBlockerEvent;
use App\Events\Ticket\TicketPauseEvent;
use App\Helper\TicketHelpers;
use App\Mail\Ticket\TicketMail;
use App\Notifications\Ticket\TicketNotification;
use Illuminate\Support\Facades\Mail;

class TicketPauseListener
{
    public function __construct()
    {
    }

    public function handle(TicketPauseEvent $event): void
    {
        $email = TicketHelpers::getEmailToSendMail($event->ticket);
        Mail::to($email)->send(new TicketMail($event->ticket));
        $title = "Le Ticket n° {$event->ticket->numero_ticket}  a ete mis en pause ";
        $message = "Le Ticket n° {$event->ticket->numero_ticket} ({$event->ticket->villeDepart()->name} - {$event->ticket->villeArriver()->name})  a ete mise en pause et vous pouvez l'active en cas de besoin";
        $event->ticket->user->notify(new TicketNotification($event->ticket,TypeNotification::UpdateTicket,$title,$message));

    }
}
