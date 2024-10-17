<?php

namespace App\Helper;

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

}
