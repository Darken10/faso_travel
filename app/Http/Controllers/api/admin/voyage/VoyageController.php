<?php

namespace App\Http\Controllers\api\admin\voyage;

use App\Filament\Compagnie\Resources\Ticket\TicketResource;
use App\Http\Controllers\Controller;
use App\Models\Voyage\Voyage;
use App\resources\PassagerResource;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoyageController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $voyages = Voyage::whereCompagnieId($user->compagnie_id)->get();
        return response()->json($voyages);
    }

    public function showWithPassagers(Request $request,Voyage $voyage){
        $date = $request->all()['date'] ?? null;
        $tickets= $voyage->tickets()->getQuery();

        if ($date){
            $list = explode("-",$date);
            $dat = Carbon::create($list[2],$list[1],$list[0]);
          $tickets = $tickets->whereDate('date',$dat)->get();
        }

        return response()->json($tickets->map(function($ticket){return new PassagerResource($ticket);})->toArray());
    }
}
