<?php

namespace App\Listeners;

use App\Enums\TypeNotification;
use App\Events\SendClientTicketByMail;
use App\Events\SendClientTicketByMailEvent;
use App\Helper\TicketHelpers;
use App\Mail\Ticket\TicketMail;
use App\Mail\ticket\TicketNotificationMail;
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
        if ($event->type == TypeNotification::PayerTicket || $event->type == TypeNotification::TICKET_PAYER){
            Mail::to($email)->send(new TicketMail($event->ticket));
        } else if ($event->type==TypeNotification::TICKET_ACTIVE){
            if ($event->ticket->is_my_ticket){
                $event->ticket->user->notify(new TicketNotification($event->ticket,TypeNotification::TICKET_ACTIVE,"Activation de ticket"));
            } else{
                Mail::to($email)->send(new TicketNotificationMail($event->ticket,TypeNotification::TICKET_ACTIVE,$email,"Activation de ticket"));
            }
        } else if ($event->type==TypeNotification::TICKET_UPDATED){
            if ($event->ticket->is_my_ticket){
                $event->ticket->user->notify(new TicketNotification($event->ticket,TypeNotification::TICKET_UPDATED,"Modification du ticket"));
            } else{
                Mail::to($email)->send(new TicketNotificationMail($event->ticket,TypeNotification::TICKET_UPDATED,$email,"Modification du ticket"));
            }
        } else if ($event->type==TypeNotification::TICKET_REDELIVERED){
            if ($event->ticket->is_my_ticket){
                $event->ticket->user->notify(new TicketNotification($event->ticket,TypeNotification::TICKET_REDELIVERED,"Re-envoi du ticket"));
            } else{
                Mail::to($email)->send(new TicketNotificationMail($event->ticket,TypeNotification::TICKET_REDELIVERED,$email,"Re-envoi du ticket"));
            }
        } else if ($event->type==TypeNotification::TICKET_REGENERATED){
            if ($event->ticket->is_my_ticket){
                $event->ticket->user->notify(new TicketNotification($event->ticket,TypeNotification::TICKET_REGENERATED,"Regeneration du ticket"));
            } else{
                Mail::to($email)->send(new TicketNotificationMail($event->ticket,TypeNotification::TICKET_REGENERATED,$email,"Regeneration du ticket"));
            }
        }

    }
}
