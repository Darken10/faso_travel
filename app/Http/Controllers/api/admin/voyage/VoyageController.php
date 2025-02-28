<?php

namespace App\Http\Controllers\api\admin\voyage;

use App\Http\Controllers\Controller;
use App\Models\Voyage\Voyage;
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
        $date = $request->route()->parameter('date');
        $tickets = $voyage->tickets()->where("date",$date)->get();

        return response()->json($tickets);
    }
}
