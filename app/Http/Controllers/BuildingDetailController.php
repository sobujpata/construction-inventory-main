<?php

namespace App\Http\Controllers;

use App\Models\BuildingDetail;
use Illuminate\Http\Request;

class BuildingDetailController extends Controller
{
    public function index(){
        return view('pages.dashboard.building-details');
    }
    public function BuildingList(){
        $Buildings = BuildingDetail::all();
        return response()->json($Buildings);
    }
}
