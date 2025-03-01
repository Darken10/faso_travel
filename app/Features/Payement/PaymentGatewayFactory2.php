<?php

namespace App\Features\Payement;

use App\Enums\PaymentProvider;

class PaymentGatewayFactory2
{
    public function getPaymentGateway(PaymentProvider $provider): PaymentGatewayInterface
    {
        return match ($provider) {
            PaymentProvider::ORANGE => new OrangePaymentGateway(),
            PaymentProvider::MOOV => new MoovPaymentGateway(),
            PaymentProvider::CORIS => new CorisPaymentGateway(),
            PaymentProvider::WAVE => new WavePaymentGateway(),
            PaymentProvider::LIGDICASH => new LigdiCashPaymentGateway(),
        };
    }
}
