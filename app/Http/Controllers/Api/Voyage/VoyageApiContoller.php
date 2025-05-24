<?php

namespace App\Http\Controllers\Api\Voyage;

use App\Http\Controllers\Controller;
use App\Models\Voyage;
use App\Models\Voyage\VoyageInstance;
use Illuminate\Http\Request;

class VoyageApiContoller extends Controller
{

    public function index()
    {
        $voyages = VoyageInstance::disponibles()->get();

        return response()->json([
            'status' => 'success',
            'voyages' => $voyages
        ]);
    }


}
