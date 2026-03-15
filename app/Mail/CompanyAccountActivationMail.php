<?php

namespace App\Mail;

use App\Models\AccountActivation;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CompanyAccountActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public AccountActivation $activation,
        public string $companyName,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Votre compte a été créé chez {$this->companyName}",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.company-account-activation',
            with: [
                'activationUrl' => route('account.activate', ['token' => $this->activation->token]),
                'userName' => $this->user->first_name . ' ' . $this->user->last_name,
                'companyName' => $this->companyName,
                'roles' => $this->user->roles->pluck('label')->join(', '),
                'expiresAt' => $this->activation->expires_at->format('d/m/Y à H:i'),
            ],
        );
    }
}
