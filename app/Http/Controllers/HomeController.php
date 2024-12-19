<?php

namespace App\Http\Controllers;

use App\Models\BuildingDetail;
use App\Models\Gellary;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    function HomePage(){
        return view('pages.home');
    }

    function BuildingDetails(){
        $details = BuildingDetail::first();

        return response()->json($details);
    }

    function gellaryShow(){
        $gellary = Gellary::all();

        return response()->json($gellary);
    }
}
