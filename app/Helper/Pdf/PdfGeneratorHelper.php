<?php

namespace App\Helper\Pdf;

use App\Models\Ticket\Ticket;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PdfGeneratorHelper{

    /**
     * @param $qrCodePath
     * @param Ticket $ticket
     * @return string|null exemple d'uri  : tickets/qrcode/le_name.pdf
     *
     */
    public static function generate($qrCodePath,Ticket $ticket){

        $name = Str::random(10).'-'.uniqid().date('Y').date('m').date('d').date('h').date('i').date('s');
        $uri = "tickets/pdf/$name.pdf";
        $path = storage_path("app/public/tickets/pdf/$name.pdf");
        $pdf = Pdf::loadView('ticket.ticket.pdf.ticket',[
            'qrCodePath' => $qrCodePath,
            'ticket' => $ticket,
        ])->setPaper('a4', 'landscape');
        $pdf->save($path);
        if(file_exists($path)){
            return $uri;
        }
        return null;
    }

}
