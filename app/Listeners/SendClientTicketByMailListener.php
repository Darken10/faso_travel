<?php

namespace App\Listeners;

use App\Events\SendClientTicketByMail;
use App\Events\SendClientTicketByMailEvent;
use App\Helper\TicketHelpers;
use App\Mail\Ticket\TicketMail;
use App\Models\User;
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
    }
}
