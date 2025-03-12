<?php

namespace App\Notifications;

use App\Enums\TypeNotification;
use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class GlobaleTicketNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct( public TypeNotification $typeNotification,public Ticket $ticket )
    {

    }

    public function via($notifiable): array
    {
        return ["mail", "database", "broadcast"];
    }

    public function toMail($notifiable): MailMessage
    {


        $mail = (new MailMessage)->greeting('Bonjour ' . $notifiable->name);

        switch ($this->typeNotification) {
            case TypeNotification::PayerTicket:
                $mail->subject('Achat de ticket confirmé')
                    ->line('Bonjour ' . $this->ticket->user->name . ',')
                    ->line('Nous avons le plaisir de vous confirmer que votre achat de ticket a été effectué avec succès. Vous trouverez ci-dessous les détails de votre voyage : ' )
                    ->line('Détails du voyage :')
                    ->line('🛫 **Départ :** ' . $this->ticket->villeDepart()->name . ' - ' . $this->ticket->date->format('D d M Y'))
                    ->line('🛬 **Arrivée :** ' . $this->ticket->villeArriver()->name)
                    ->line('🚌 **Compagnie :** ' . $this->ticket->voyage->compagnie->name)
                    ->line('🎟️ **Code du ticket :** ' . $this->ticket->code_sms)
                    ->line('📄 **Numéro du ticket :** ' . $this->ticket->numero_ticket)
                    ->action('Voir mon ticket', route('ticket.show-ticket',$this->ticket))
                    ->line('Veuillez vous présenter à la gare à ' . $this->ticket->heureRdv() . ' pour l’embarquement.')
                    ->action('Voir mon ticket', route('ticket.show-ticket', $this->ticket))

                    ->attach(storage_path('app/public/'. $this->ticket->pdf_uri), [
                        'as'   => 'Ticket_' . $this->ticket->numero_ticket . '.pdf',
                        'mime' => 'application/pdf'
                    ]);
                break;

            case 'validation':
                $mail->subject('Ticket validé')
                    ->line('Votre ticket a été validé.')
                    ->action('Voir mon ticket', route('ticket.show-ticket',$this->ticket));
                break;

            case 'pause':
                $mail->subject('Ticket mis en pause')
                    ->line('Votre ticket a été mis en pause.')
                    ->action('Voir mon ticket', route('ticket.show-ticket',$this->ticket));
                break;

            case 'blocage':
                $mail->subject('Ticket bloqué')
                    ->line('Votre ticket a été bloqué pour des raisons administratives.')
                    ->action('Voir les détails', route('ticket.show-ticket',$this->ticket));
                break;

            case 'activation':
                $mail->subject('Ticket activé')
                    ->line('Votre ticket a été réactivé.')
                    ->action('Voir mon ticket', route('ticket.show-ticket',$this->ticket));
                break;

            default:
                $mail->subject('Notification')
                    ->line('Vous avez une nouvelle notification.');
                break;
        }

        // Vérifie si un fichier PDF est disponible à attacher
        if (!empty($this->ticket->pdf_uri) && file_exists(storage_path('app/' . $this->ticket->pdf_uri))) {
            $mail->withSymfonyMessage(function ($message) {
                $message->attach(storage_path('app/' . $this->ticket->pdf_uri), [
                    'as' => 'ticket.pdf',
                    'mime' => 'application/pdf',
                ]);
            });
        }

        return $mail->line('Merci de voyager avec nous !');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'user_id'=>$notifiable->id,
            'ticket_id'=> $this->ticket->id,
            'type'=> $this->typeNotification,
        ];
    }

    public function toBroadcast($notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'user_id'=>$notifiable->id,
            'ticket_id'=> $this->ticket->id,
            'type'=> $this->typeNotification,
        ]);
    }

    public function toArray($notifiable): array
    {
        return [
            'user_id'=>$notifiable->id,
            'ticket_id'=> $this->ticket->id,
            'type'=> $this->typeNotification,
        ];
    }
}
