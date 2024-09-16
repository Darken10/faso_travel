<?php

namespace App\Helper\Payement;

use Illuminate\Support\Str;


class payement {


    public string $transaction_id;
    public string $token;

    protected function generate_transaction_id(string $moyen): string {
        $this->transaction_id  = $moyen.date('Y').date('m').date('d').'.'.date('h').date('m').'.C'.rand(10000,9999999999);
        return $this->transaction_id;
    }

    protected function createFakeToken():string {
        $this->token = Str::random(128);
        return $this->token;
    }
}