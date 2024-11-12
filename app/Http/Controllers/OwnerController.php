<?php

namespace App\Http\Controllers;

use App\Models\Owner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class OwnerController extends Controller
{
    public function index(){
        return view('pages.dashboard.owner');
    }
    public function OwnerList(){
        $Owners = Owner::all();
        return response()->json($Owners);
    }

    public function OwnerCreate(Request $request){
        $user_id=$request->header('id');

        // Prepare File Name & Path
        $img=$request->file('img');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="owners/{$img_name}";


        // Upload File
        $img->move(public_path('owners'),$img_name);


        // Save To Database
        return Owner::create([
            'user_id'=>$user_id,
            'name'=>$request->input('name'),
            'email'=>$request->input('email'),
            'mobile'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'image'=>$img_url,
        ]);
    }

    public function OwnerById(Request $request){
        $id = $request->input('id');
        return Owner::where('id',$id)->first();
    }

    public function OwnerUpdate(Request $request){
        $user_id = $request->header('id');
        $Owner_id = $request->input('id');
        $name = $request->input('name');
        $email = $request->input('email');
        $mobile_no = $request->input('mobile_no');
        $address = $request->input('address');

        if ($request->hasFile('img')) {

            // Upload New File
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="Owners/{$img_name}";
            $img->move(public_path('Owners'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            return Owner::where('id',$Owner_id)->where('user_id',$user_id)->update([
                'name'=>$name,
                'email'=>$email,
                'image'=>$img_url,
                'mobile'=>$mobile_no,
                'address'=>$address,
            ]);

        }

        else {
            return Owner::where('id',$Owner_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'email'=>$email,
                'mobile'=>$mobile_no,
                'address'=>$address,
            ]);
        }
    }

    function OwnerDelete(Request $request)
    {
        $user_id=$request->header('id');
        $Owner_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Owner::where('id',$Owner_id)->where('user_id',$user_id)->delete();

    }
}
