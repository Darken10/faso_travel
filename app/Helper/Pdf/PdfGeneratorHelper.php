<?php

namespace App\Helper\Pdf;

use App\Models\Ticket\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class PdfGeneratorHelper{

    public static function generate($qrCodePath,Ticket $ticket){
       
        $name = Str::random(10).'-'.uniqid().date('Y').date('m').date('d').date('h').date('m');
        $path = storage_path("app/public/tickets/pdf/$name.pdf");
        $pdf = Pdf::loadView('ticket.ticket.pdf.ticket',[
            'qrCodePath' => $qrCodePath,
            'ticket' => $ticket,
        ]);
        $pdf->save($path);
        if(file_exists($path)){
            return $path;
        }
        return null;
    }

}