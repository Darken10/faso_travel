<?php

namespace App\Listeners;

use App\Events\CreatedQrCodeEvent;
use App\Events\PayementEffectuerEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PayementCreatImageListener
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

        if($event->ticket->image_uri === null or !file_exists(storage_path($this->storage_public_dir.$event->ticket->image_uri))){
            $event->ticket->image_uri = null;
            $event->ticket->save();
        }
    }
}
