<?php

namespace App\Http\Controllers\Divers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConditionConfidentialiteController extends Controller
{
    function confidentialite()
    {
        return view('divers.politique-confidentialite');

    }



    function condition()
    {
        return view('divers.conditions-terms');
    }

    function about()
    {
        return view('divers.about-us');
    }
    function contact()
    {
        return view('divers.contact');
    }


}
