<?php

namespace App\Notifications\Ticket;

use App\Enums\TypeNotification;
use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayerTicketNotification extends Notification
{
    use Queueable;


    /**
     * Create a new notification instance.
     */
    public function __construct( private Ticket $ticket)
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
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Bonjour.')
                    ->tag('notifiable')
                    ->salutation('Bonjour Comment aller vous ?')
                    ->success()
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'type'=> TypeNotification::PayerTicket,
            'title'=> "Achat de Ticket {$this->ticket->villeDepart()->name} a {$this->ticket->villeArriver()->name}",
            'message'=>"votre ticket a bien ete payer, un mail vous a ete envoyer avec plus d'information"
        ];
    }
}
