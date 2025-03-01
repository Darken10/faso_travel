<?php

namespace App\features\payement;

use App\Enums\StatutPayement;
use App\features\payement\PaymentGatewayInterface;
use App\Models\Ticket\Ticket;
use App\Models\User;

class MoovMoneyPaymentGateway implements PaymentGatewayInterface
{


    public function processPayment(float $amount, Ticket $ticket, User $user, array $paymentDetails = []): bool|string
    {
        // TODO: Implement processPayment() method.
    }

    public function getStatus(array $statusPayload): StatutPayement
    {
        // TODO: Implement getStatus() method.
    }
}
