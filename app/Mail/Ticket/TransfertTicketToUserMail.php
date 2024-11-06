<?php

namespace App\Mail\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TransfertTicketToUserMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $storage_public_dir = 'app/public/';


    /**
     * Create a new message instance.
     */
    public function __construct(public Ticket $ticket)
    {
        //
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Transfert Ticket To User Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.ticket.transfert-ticket-to-user-mail',

        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [
            Attachment::fromPath(storage_path($this->storage_public_dir.$this->ticket->pdf_uri))
                ->as('ticket.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
