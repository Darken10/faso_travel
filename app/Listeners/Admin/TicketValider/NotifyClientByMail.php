<?php

namespace App\Listeners\Admin\TicketValider;

use App\Events\Admin\TicketValiderEvent;
use App\Mail\Admin\ValidateClientTicketMail;
use App\Mail\Ticket\TicketMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class NotifyClientByMail
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
    public function handle(TicketValiderEvent $event): void
    {
        Mail::to($event->ticket->user->email)->send(new ValidateClientTicketMail($event->ticket));
    }
}
