<?php

namespace App\jobs;

use App\Enums\JoursSemain;
use App\Helper\VoyagesInstanceHelpers;
use App\Models\Voyage\Voyage;
use App\Models\Voyage\VoyageInstance;
use App\Services\Voyage\VoyageInstanceService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateVoyageInstanceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected VoyageInstanceService $voyageInstanceService;
    public function __construct(

    )
    {
        $this->voyageInstanceService = new VoyageInstanceService();
    }

    public function handle(): void
    {
        $this->voyageInstanceService->createAll();
    }


}
