<?php

namespace App\Http\Controllers\Ticket\Payement;

use Exception;
use App\Enums\TypeTicket;
use App\Enums\MoyenPayment;
use App\Enums\StatutTicket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\StatutPayement;
use App\Helper\TicketHelpers;
use App\Models\Ticket\Ticket;
use App\Enums\TypeNotification;
use App\Mail\Ticket\TicketMail;
use App\Models\Ticket\Payement;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Events\PayementEffectuerEvent;
use App\Helper\Pdf\PdfGeneratorHelper;
use Illuminate\Support\Facades\Storage;
use App\Events\SendClientTicketByMailEvent;
use App\Helper\QrCode\QrCodeGeneratorHelper;
use App\Helper\Payement\OrangePayementHelper;
use App\Notifications\Ticket\TicketNotification;
use App\Http\Requests\Ticket\Payement\OrangePayementRequest;

class OrangePayementController extends Controller
{

    public string $storage_public_dir = 'app/public/';

    function paymentPage (Ticket $ticket){
        return view('ticket.ticket.payement.orange',[
            'ticket' => $ticket,
        ]);
    }


    /**
     * @throws \Throwable
     */
    function payer(OrangePayementRequest $request, Ticket $ticket){

        $data = $request->validated();
        $prix = $ticket->voyageInstance->getPrix($ticket->type);
        $orangePayement = new OrangePayementHelper($data['numero'], $data['otp'], $prix);

        if($orangePayement->payement()){
            $data = [
                'ticket_id' => $ticket->id,
                'numero_payment' => $data['numero'],
                'montant' => $orangePayement->montant,
                "trans_id" =>$orangePayement->transaction_id,
                "token" => $orangePayement->token,
                'code_otp' => $data['otp'],
                'statut' => $orangePayement->payementStatut(),
                'moyen_payment' => MoyenPayment::ORRANGE_MONEY,
                'code_ticket' => Str::random(12),
            ];

            try{
                DB::beginTransaction();
                $ticket->statut = StatutTicket::Payer;

                $oldpayements = Payement::query()->whereBelongsTo($ticket)->where('statut',StatutPayement::Complete)->get();
                if($oldpayements->count() > 0){
                    $payement = $oldpayements->last();
                }
                else{
                    $payement = Payement::create($data);
                }

                $TkAvecLeMemeNumeroChaise = Ticket::query()
                    ->whereBelongsTo($ticket->voyageInstance)
                    ->where('numero_chaise',$ticket->numero_chaise)
                    ->where('statut',StatutTicket::Payer)
                    ->get();
                if ($TkAvecLeMemeNumeroChaise->count()>=1){
                    $ticket->numero_chaise = TicketHelpers::getNumeroChaise($ticket->voyageInstance);
                }
                $ticket->save();

                PayementEffectuerEvent::dispatch($ticket);
                dd($ticket->numero_chaise);
                SendClientTicketByMailEvent::dispatch($ticket,TypeNotification::TICKET_PAYER);
                
                DB::commit();
                return redirect()->route('ticket.show-ticket',['ticket'=>$ticket])->with('success',"Le paiement de votre ticket a été effectué avec succès");
            }
            catch(Exception $e){
                DB::rollBack();

                throw new Exception($e->getMessage());
                return back()->with('error',"Une erreur est survenue lors de l'enregistrement du paiement");
            }


        }
        else{
            return back()->with('error',"Le code OTP est incorrect");
        }

    }


}
