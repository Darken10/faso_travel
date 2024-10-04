<?php

namespace App\Helper\Payement;

use App\Enums\MoyenPayment;
use App\Enums\StatutPayement;
use App\Models\Ticket\Ticket;

class OrangePayementHelper extends Payement{


    public function __construct(public string $numero, public string $otp,public int $montant=0)
    {}

    public function payement(){
        $trans_id = $this->generate_transaction_id('OM');
        $token = $this->createFakeToken();
            $transData = [
                'transaction_id' => $trans_id,
                'numero'=>$this->numero ,
                'otp'=>$this->otp,
                'token'=>$token,
                'montant'=>$this->montant,
            ];

        if ($this->numero == "70707070" and $this->otp =="123456") {
            return [...$transData];
        }
        else {
            return false;
        }
    }

    public function payementStatut():StatutPayement{
        return StatutPayement::complete;
    }


}
