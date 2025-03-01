<?php

namespace App\Helper\Payement;

use App\features\payement\PaymentGatewayFactory2;

class PaymentHelper
{
    public function __construct(protected PaymentGatewayFactory2 $paymentGatewayFactory){}

    public function processPayment(string $provider, float $amount, array $paymentDetails)
    {
        $paymentGateway = $this->paymentGatewayFactory->getPaymentGateway($provider);
        $paymentGateway->processPayment($amount, $paymentDetails);

        // Logique supplémentaire après le traitement du paiement
    }
}
