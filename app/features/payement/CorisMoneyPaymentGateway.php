<?php

namespace App\features\payement;

use App\Enums\StatutPayement;
use App\features\payement\PaymentGatewayInterface;
use App\Models\Ticket\Ticket;
use App\Models\User;

class CorisMoneyPaymentGateway implements PaymentGatewayInterface
{



    public function getStatus(array $statusPayload): StatutPayement
    {
        // TODO: Implement getStatus() method.
    }

    public function processPayment(float $amount, Ticket $ticket, User $user, array $paymentDetails = []): bool|string
    {
        // TODO: Implement processPayment() method.
    }
}
