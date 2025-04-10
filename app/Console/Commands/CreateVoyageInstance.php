<?php

namespace App\Console\Commands;

use App\Services\Voyage\VoyageInstanceService;
use Illuminate\Console\Command;

class CreateVoyageInstance extends Command
{
    public function __construct(
        protected VoyageInstanceService $voyageInstanceService
    )
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:voyage-instance';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->voyageInstanceService->createAll();
    }
}
