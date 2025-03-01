<?php

namespace App\Listeners;

use App\Enums\TypeNotification;
use App\Events\Ticket\TicketBlockerEvent;
use App\Helper\TicketHelpers;
use App\Mail\Ticket\TicketMail;
use App\Notifications\Ticket\TicketNotification;
use Illuminate\Support\Facades\Mail;

class TicketBlockerListener
{
    public function __construct()
    {
    }

    public function handle(TicketBlockerEvent $event): void
    {
        $email = TicketHelpers::getEmailToSendMail($event->ticket);
        Mail::to($email)->send(new TicketMail($event->ticket));
        $title = "Le Ticket n° {$event->ticket->numero_ticket}  a ete Bloquer ";
        $message = "Le Ticket n° {$event->ticket->numero_ticket} ({$event->ticket->villeDepart()->name} - {$event->ticket->villeArriver()->name})  a ete Bloquer bien vouloir contacter l'administrateur pour plus d'informations.";
        $event->ticket->user->notify(new TicketNotification($event->ticket,TypeNotification::UpdateTicket,$title,$message));

    }
}
