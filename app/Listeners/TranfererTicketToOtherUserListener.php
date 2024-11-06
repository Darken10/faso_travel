<?php

namespace App\Listeners;

use App\Events\PayementEffectuerEvent;
use App\Events\TranfererTicketToOtherUserEvent;
use App\Helper\TicketHelpers;
use App\Mail\Ticket\TicketMail;
use App\Mail\Ticket\TransfertTicketToOrherUserMyMail;
use App\Mail\Ticket\TransfertTicketToUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TranfererTicketToOtherUserListener
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
    public function handle(TranfererTicketToOtherUserEvent $event): void
    {
        PayementEffectuerEvent::dispatch($event->ticket);
        $email = TicketHelpers::getEmailToSendMail($event->ticket);
        Mail::to($email)->send(new TransfertTicketToUserMail($event->ticket));
        Mail::to($event->ticket->user->email)->send(new TransfertTicketToOrherUserMyMail($event->ticket));
    }
}
