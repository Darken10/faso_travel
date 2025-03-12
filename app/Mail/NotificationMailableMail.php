<?php

namespace App\Mail;

use App\Models\Ticket\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificationMailableMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subject;
    public  $view;
    public Ticket $ticket;
    public  $attachments;

    /**
     * Créer une nouvelle instance.
     *
     * @param string $subject  Sujet de l'email
     * @param string $view  Template Blade à utiliser
     * @param Ticket $ticket  Données à transmettre à la vue
     * @param array $attachments  Liste des fichiers joints
     */
    public function __construct(string $subject, string $view, Ticket $ticket, array $attachments = [])
    {
        $this->subject = $subject;
        $this->view = $view;
        $this->ticket = $ticket;
        $this->attachments = $attachments;
    }

    /**
     * Construire le message.
     *
     * @return $this
     */
    public function content(): self
    {
        $email = $this->subject($this->subject)
            ->view($this->view, ['ticket' => $this->ticket]);

        // Ajouter les pièces jointes si elles existent
        foreach ($this->attachments as $file) {
            $email->attach($file['path'], [
                'as'   => $file['name'],
                'mime' => $file['mime'],
            ]);
        }

        return $email;
    }

}
