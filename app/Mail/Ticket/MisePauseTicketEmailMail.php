<?php

namespace App\Mail\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MisePauseTicketEmailMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct( public Ticket $ticket )
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Mise en Pause du Ticket',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.mise-pause-ticket-email',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
