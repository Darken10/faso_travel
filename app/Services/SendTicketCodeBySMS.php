<?php

namespace App\Services;

use App\Models\Ticket\Ticket;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;


class SendTicketCodeBySMS
{
    public function __construct()
    {
    }

    /**
     * @throws TwilioException
     * @throws ConfigurationException
     */
    public static function sendTicketCodeBySMS(Ticket $ticket, string $number){

        $sid    = config('sms.twillo.twilio_sid');
        $token  = config('sms.twillo.twilio_token');
        $twilio = new Client($sid, $token);

        $messageBody = 'Votre ticket pour le voyage de  $villeA à  $villeB est réservé pour le  $date à  $heure. Code de validation :  $code. Veuillez vous rendre à la gare de  $gare avant  $heureLimite. Bon voyage !';

        $message = $twilio->messages->create(
            '+22660205600',
            [
                "from" => config('sms.twillo.twilio_phone_number'),
                'body' => $messageBody
            ]
        );


        print($message->sid);

        return $message;
    }
}
