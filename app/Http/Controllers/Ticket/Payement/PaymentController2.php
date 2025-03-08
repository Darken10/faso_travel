<?php

namespace App\Http\Controllers\Ticket\Payement;
use App\Enums\MoyenPayment;
use App\Enums\PaymentProvider;
use App\Enums\StatutPayement;
use App\Enums\StatutTicket;
use App\Events\PayementEffectuerEvent;
use App\Events\SendClientTicketByMailEvent;
use App\features\payement\PaymentGatewayFactory;
use App\Helper\Payement\OrangePayementHelper;
use App\Helper\TicketHelpers;
use App\Http\Controllers\Controller;
use App\Models\Ticket\Payement;
use App\Models\Ticket\Ticket;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController2 extends Controller
{
    protected PaymentGatewayFactory $paymentGatewayFactory;


    public function __construct(PaymentGatewayFactory $paymentGatewayFactory)
    {
        $this->paymentGatewayFactory = $paymentGatewayFactory;
    }

    public function processPayment(Ticket $ticket,string $provider)
    {
        $amount = 100;
        $paymentDetails = [];

        // Valider que le provider est une valeur valide de l'énumération
        if (!PaymentProvider::tryFrom($provider)) {
            // Gérer l'erreur si le provider est invalide
            abort(400, 'Provider de paiement invalide.');
        }

        $paymentProvider = PaymentProvider::from($provider);
        $paymentGateway = $this->paymentGatewayFactory->getPaymentGateway($paymentProvider);
        $isPaymentSuccessful = $paymentGateway->processPayment($amount, $ticket,auth()->user(), $paymentDetails);
        if (str_contains($isPaymentSuccessful,"https://" )){
            return redirect($isPaymentSuccessful);

        }

        if ($isPaymentSuccessful) {
            // Logique en cas de succès du paiement
            return response()->json(['message' => 'Paiement réussi.'], 200);
        } else {
            // Logique en cas d'échec du paiement
            return response()->json(['message' => 'Échec du paiement.'], 400);
        }
    }

    /**
     * @throws \Throwable
     */
    public function successFunction(Request $request, Ticket $ticket, string $moyenPayment)
    {

        $paymentProvider = PaymentProvider::from($moyenPayment);
        $paymentGateway = $this->paymentGatewayFactory->getPaymentGateway($paymentProvider);
        $payement = $ticket->payements->first();
        $payementStatut= $paymentGateway->getStatus(['token'=>$payement->token]);
        try {
            DB::beginTransaction();
            $payement->update(['statut' => $payementStatut]);
            $ticket->payements()->save($payement);
            if ($payementStatut === StatutPayement::Complete){
                $ticket->statut = StatutTicket::Payer;
                PayementEffectuerEvent::dispatch($ticket);
                SendClientTicketByMailEvent::dispatch($ticket);
            }
            DB::commit();
            return to_route('ticket.show-ticket',['ticket'=>$ticket])->with("success","Votre ticket a ete envoyer par mail et est en telehargement si dessou");
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception($e->getMessage());
        }

    }

    public function cancelFunction(Request $request,Ticket $ticket)
    {
        return to_route('voyage.index')->with("error","Votre payement a ete annuler");
    }

    public function callbackFunction(Request $request,Ticket $ticket)
    {

    }

}
