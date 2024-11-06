<?php

namespace App\Helper;

use App\Enums\StatutTicket;
use App\Events\PayementEffectuerEvent;
use App\Events\SendClientTicketByMailEvent;
use App\Models\Ticket\Ticket;
use App\Models\User;
use Exception;
use Faker\Core\Uuid;
use Symfony\Component\Uid\Ulid;

class TicketHelpers{

    public static function generateTicketNumber():string{
        $number = rand(0,999999);
        return "TK $number";
    }

    public static function generateTicketCodeSms():string{
        return rand(0,999999);
    }

    public static function generateTicketCodeQr():string{
        return date('y').date('m').date('d').date('h').date('m').Ulid::generate(now()).Ulid::generate(now());
    }

    public static function regenerateTicket(Ticket $ticket): ?bool
    {
        try {
            \DB::beginTransaction();
            $ticket->image_uri = null;
            $ticket->code_qr = TicketHelpers::generateTicketCodeQr();
            $ticket->code_sms = TicketHelpers::generateTicketCodeSms();
            $ticket->code_qr_uri = null;
            $ticket->pdf_uri = null;
            $ticket->save();
            \Db::commit();

        }catch (Exception|\Throwable $e){
            \DB::rollBack();
            return false;
        }
        return true;

    }

    public static function getEmailToSendMail(Ticket $ticket)
    {
        if ($ticket?->is_my_ticket){
            $email = $ticket?->user->email;
        } elseif ($ticket?->autre_personne_id!==null){
            $email = $ticket?->autre_personne->email;
        }elseif ($ticket?->transferer_a_user_id!==null){
            $email = User::find($ticket?->transferer_a_user_id)?->email;
        }else{
            $email = $ticket?->user?->email;
        }
        return $email;
    }

}
