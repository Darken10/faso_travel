<?php

namespace App\Listeners;

use App\Events\CreatedQrCodeEvent;
use App\Events\PayementEffectuerEvent;
use App\Helper\Pdf\PdfGeneratorHelper;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PayementCreatPdfListener
{
    private string $storage_public_dir = 'app/public/';

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CreatedQrCodeEvent $event): void
    {

        if($event->ticket->pdf_uri === null or !file_exists(storage_path($this->storage_public_dir.$event->ticket->pdf_uri))){
            $event->ticket->pdf_uri = PdfGeneratorHelper::generate(storage_path($this->storage_public_dir.$event->ticket->code_qr_uri),$event->ticket);
            $event->ticket->save();
        }
    }
}
