<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class AgentController extends Controller
{
    public function index(){
        return view('pages.dashboard.agent');
    }
    public function AgentList(){
        $Agents = Agent::all();
        return response()->json($Agents);
    }

    public function AgentCreate(Request $request){
        $user_id=$request->header('id');

        // Prepare File Name & Path
        $img=$request->file('img');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="agents/{$img_name}";


        // Upload File
        $img->move(public_path('agents'),$img_name);


        // Save To Database
        return Agent::create([
            'user_id'=>$user_id,
            'name'=>$request->input('name'),
            'company_name'=>$request->input('company_name'),
            'nid_no'=>$request->input('nid_no'),
            'mobile'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'image'=>$img_url,
        ]);
    }

    public function AgentById(Request $request){
        $id = $request->input('id');
        return Agent::where('id',$id)->first();
    }

    public function AgentUpdate(Request $request){
        $user_id = $request->header('id');
        $Agent_id = $request->input('id');
        $name = $request->input('name');
        $company_name = $request->input('company_name');
        $nid_no = $request->input('nid_no');
        $mobile_no = $request->input('mobile_no');
        $address = $request->input('address');
        // $file_path = $request->input('file_path');
        // $img = $request->input('img');

        if ($request->hasFile('img')) {

            // Upload New File
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="Agents/{$img_name}";
            $img->move(public_path('Agents'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            return Agent::where('id',$Agent_id)->where('user_id',$user_id)->update([
                'name'=>$name,
                'company_name'=>$company_name,
                'nid_no'=>$nid_no,
                'image'=>$img_url,
                'mobile'=>$mobile_no,
                'address'=>$address,
            ]);

        }

        else {
            return Agent::where('id',$Agent_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'company_name'=>$company_name,
                'nid_no'=>$nid_no,
                'mobile'=>$mobile_no,
                'address'=>$address,
            ]);
        }
    }

    function AgentDelete(Request $request)
    {
        $user_id=$request->header('id');
        $Agent_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Agent::where('id',$Agent_id)->where('user_id',$user_id)->delete();

    }
}
