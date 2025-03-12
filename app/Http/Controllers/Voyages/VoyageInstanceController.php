<?php

namespace App\Http\Controllers\Voyages;

use App\DTOs\VoyageInstanceRequestDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Voyage\StoreVoyageInstanceRequest;
use App\Models\Voyage\VoyageInstance;
use App\Services\Voyage\VoyageInstanceService;

class VoyageInstanceController extends Controller
{
    public function __construct(
        protected VoyageInstanceService $voyageInstanceService,
    ){}

    public function createAllInstance()
    {

       $this->voyageInstanceService->createAll();

    }
}
