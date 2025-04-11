<?php

namespace App\Http\Controllers\Compagnie;

use App\Http\Controllers\Controller;
use App\Models\Compagnie\Compagnie;
use Illuminate\Http\Request;

class CompagnieController extends Controller
{
    public function index(){
        return view('client.compagnie.index',[
            'compagnies' => Compagnie::all(),
        ]);
    }

    public function show(Compagnie $compagnie){
        return view('client.compagnie.show',[
            'compagnie' => $compagnie,
        ]);
    }
}
