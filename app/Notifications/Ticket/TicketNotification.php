<?php

namespace App\Notifications\Ticket;

use App\Enums\TypeNotification;
use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private Ticket $ticket,
        private TypeNotification $type,
        private string $title,
        private string $message,
    )
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Bonjour Mr.' . $notifiable->name)
            ->line("Nous vous notifions que votre ticket a ete modifier avec succes.")
            ->line("Et qu'un nouveau ticket a ete regener automatiquement.")
            ->line("Le Numero du Ticket  :".$this->ticket->numero_ticket)
            ->line("Le Code du Ticket  :".$this->ticket->code_sms)
            ->action('Voir le Ticket', url(route('ticket.show-ticket',$this->ticket)))
            ->line('Merci Pour votre Confiance!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user'=>$notifiable,
            'ticket'=> $this->ticket,
            'type'=> $this->type,
            'title'=> $this->title,
            'message'=> $this->message,
        ];
    }
}
