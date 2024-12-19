<?php

namespace App\Http\Controllers;

use App\Models\OtherCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OtherCostController extends Controller
{
    public function index(){
        return view('pages.dashboard.OtherCost');
    }
    public function OtherCostList(){
        $OtherCosts = OtherCost::all();
        return response()->json($OtherCosts);
    }

    public function OtherCostCreate(Request $request){
        $user_id=$request->header('id');

        // Save To Database
        return OtherCost::create([
            'user_id'=>$user_id,
            'recipient'=>$request->input('recipient'),
            'sector'=>$request->input('sector'),
            'amount'=>$request->input('amount'),
            'remarks'=>$request->input('remarks'),
        ]);
    }

    public function OtherCostById(Request $request){
        $id = $request->input('id');
        return OtherCost::where('id',$id)->first();
    }

    public function OtherCostUpdate(Request $request){
        $user_id = $request->header('id');
        $OtherCost_id = $request->input('id');
        $recipient = $request->input('recipient');
        $sector = $request->input('sector');
        $amount = $request->input('amount');
        $remarks = $request->input('remarks');

            return OtherCost::where('id',$OtherCost_id)->where('user_id',$user_id)->update([
                'recipient'=>$recipient,
                'sector'=>$sector,
                'amount'=>$amount,
                'remarks'=>$remarks,
            ]);
    }

    function OtherCostDelete(Request $request)
    {
        $user_id=$request->header('id');
        $OtherCost_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return OtherCost::where('id',$OtherCost_id)->where('user_id',$user_id)->delete();

    }
}
