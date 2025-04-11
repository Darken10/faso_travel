<?php

namespace App\Livewire\Divers;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;

class ContactForm extends Component
{

    public string $nom = '';
    public string $email = '';
    public string $sujet = '';
    public string $message = '';
    public string $recaptcha = '';

    public bool $success = false;

    /**
     * @throws ConnectionException
     */
    public function submit()
    {
        $this->validate([
            'nom' => 'required|string|min:2',
            'email' => 'required|email',
            'sujet' => 'required|string|min:3',
            'message' => 'required|string|min:10',
        ]);

/*
        // ✅ Vérification reCAPTCHA
        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => getenv('RECAPTCHA_SECRET_KEY'),
            'response' => $this->recaptcha,
        ]);

        if (!data_get($response->json(), 'success')) {
            $this->addError('recaptcha', 'Échec de la vérification reCAPTCHA.');
            return;
        }*/

        // ✅ Envoi email
        Mail::raw("Nom: {$this->nom}\nEmail: {$this->email}\nSujet: {$this->sujet}\nMessage:\n{$this->message}", function ($message) {
            $message->to('support@liptra.net')
                ->subject('Nouveau message de contact');
        });

        // ✅ Notification Telegram (optionnel)
        // Http::post('https://api.telegram.org/bot<TOKEN>/sendMessage', [
        //     'chat_id' => '<chat_id>',
        //     'text' => "📩 Nouveau message :\nDe: {$this->nom} ({$this->email})\nSujet: {$this->sujet}\n{$this->message}"
        // ]);

        $this->reset(['nom', 'email', 'sujet', 'message', 'recaptcha']);
        $this->success = true;
    }


    public function render()
    {
        return view('livewire.divers.contact-form');
    }
}
