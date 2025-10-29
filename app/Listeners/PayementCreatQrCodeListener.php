<?php

namespace App\Listeners;

use App\Events\CreatedQrCodeEvent;
use App\Events\PayementEffectuerEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Helper\QrCode\QrCodeGeneratorHelper;

class PayementCreatQrCodeListener
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
    public function handle(PayementEffectuerEvent $event): void
    {
        if( $event->ticket->code_qr_uri === null or !file_exists(storage_path($this->storage_public_dir.$event->ticket->code_qr_uri))){

            $event->ticket->code_qr_uri = QrCodeGeneratorHelper::generate($event->ticket->code_qr);

            $event->ticket->save();
        }
        CreatedQrCodeEvent::dispatch($event->ticket);
    }
}
