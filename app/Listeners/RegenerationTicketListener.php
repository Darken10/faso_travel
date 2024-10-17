<?php

namespace App\Listeners;

use App\Events\PayementEffectuerEvent;
use App\Events\SendClientTicketByMailEvent;
use App\Helper\QrCode\QrCodeGeneratorHelper;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RegenerationTicketListener
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
    public function handle(object $event): void
    {
        try {
            if(file_exists(storage_path($this->storage_public_dir.$event->ticket->code_qr_uri))){
                dd('exist');
            }
        }catch (Exception $e){
            // Log error or handle exception here

        }
    }
}
