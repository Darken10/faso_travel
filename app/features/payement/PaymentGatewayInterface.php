<?php

namespace App\Features\Payement;

use App\Enums\StatutPayement;
use App\Models\Ticket\Ticket;
use App\Models\User;

interface PaymentGatewayInterface
{
    public function processPayment(float $amount, Ticket $ticket,User $user,array $paymentDetails = []): bool |string;

    public function getStatus(array $statusPayload): StatutPayement;
}
