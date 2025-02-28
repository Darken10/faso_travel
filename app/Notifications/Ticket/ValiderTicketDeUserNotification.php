<?php

namespace App\Notifications\Ticket;

use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ValiderTicketDeUserNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Ticket  $ticket
    )
    {
    }

    public function via($notifiable): array
    {
        return ['mail','database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->salutation('Bonjour.')
            ->success()
            ->line(`Nous vous informons que votre ticket de vouage`)
            ->line(` de numero : {$this->ticket->numero_ticket} `)
            ->line("de  :  {$this->ticket->voyage->trajet->depart->name} ({$this->ticket->voyage->gareDepart->name})")
            ->action('Voir le Ticket', url(route('ticket.show-ticket',$this->ticket)))
            ->line('Thank you for using our application!');
    }

    public function toArray($notifiable): array
    {
        return [
            'ticket_id' => $this->ticket,
        ];
    }
}
