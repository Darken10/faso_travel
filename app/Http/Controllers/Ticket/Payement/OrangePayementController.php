<?php

namespace App\Http\Controllers\Ticket\Payement;

use Exception;
use App\Enums\MoyenPayment;
use App\Enums\StatutTicket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Enums\StatutPayement;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\Payement;
use App\Http\Controllers\Controller;
use App\Helper\QrCode\QrCodeGeneratorHelper;
use App\Helper\Payement\OrangePayementHelper;
use App\Helper\Pdf\PdfGeneratorHelper;
use App\Http\Requests\Ticket\Payement\OrangePayementRequest;

class OrangePayementController extends Controller
{

    function paymentPage (Ticket $ticket){
        return view('ticket.ticket.payement.orange',[
            'ticket' => $ticket,
        ]);
    }


    function payer(OrangePayementRequest $request,Ticket $ticket){
        $data = $request->validated();
        $orangePayement = new OrangePayementHelper($data['numero'], $data['otp'], $ticket->voyage->prix);
        
        if($orangePayement->payement()){
            $data = [
                'ticket_id' => $ticket->id,
                'numero_payment' => $data['numero'],
                'montant' => $orangePayement->montant,
                "trans_id" =>$orangePayement->transaction_id,
                "token" => $orangePayement->token,
                'code_otp' => $data['otp'],
                'statut' => $orangePayement->payementStatut(),
                'moyen_payment' => MoyenPayment::OrangeMoney,
                'code_ticket' => Str::random(12),
            ];
            try{
                $ticket->statut = StatutTicket::Payer;
                $oldpayements = Payement::query()->whereBelongsTo($ticket)->where('statut',StatutPayement::complete)->get();
                
                if($oldpayements->count() > 0){
                    $payement = $oldpayements->last();
                }
                else{
                    $payement = Payement::create($data);
                }
                
                if(!file_exists($ticket->code_qr)){
                    $ticket->code_qr = QrCodeGeneratorHelper::generate('123456789');
                }

                if(!file_exists($ticket->ticket_pdf)){
                    $ticket->ticket_pdf = PdfGeneratorHelper::generate($ticket->code_qr,$ticket);
                }

                if(!file_exists($ticket->ticket_image)){
                    $ticket->ticket_image = '';
                }
                $ticket->save();

            }
            catch(Exception $e){
                throw new Exception($e->getMessage());
            }



        }
        else{
            return back()->with('error',"L'OTP est incorect");
        }
       
    }


}
