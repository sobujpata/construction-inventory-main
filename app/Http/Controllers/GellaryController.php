<?php

namespace App\Http\Controllers;

use App\Models\Gellary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class GellaryController extends Controller
{
    public function index(){
        return view('pages.dashboard.gellarys');
    }

    public function GellaryList(){
        $gellaries = Gellary::all();
        return response()->json($gellaries);
    }

    public function GellaryCreate(Request $request){
        $user_id=$request->header('id');

        // Prepare File Name & Path
        $img=$request->file('img');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="Gellarys/{$img_name}";


        // Upload File
        $img->move(public_path('Gellarys'),$img_name);


        // Save To Database
        return Gellary::create([
            'user_id'=>$user_id,
            'title'=>$request->input('title'),
            'short_discription'=>$request->input('short_discription'),
            'image'=>$img_url,
        ]);
    }

    public function GellaryById(Request $request){
        $id = $request->input('id');
        return Gellary::where('id',$id)->first();
    }

    public function GellaryUpdate(Request $request){
        $user_id = $request->header('id');
        $Gellary_id = $request->input('id');
        $title = $request->input('title');
        $short_discription = $request->input('short_discription');


        if ($request->hasFile('img')) {

            // Upload New File
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="Gellarys/{$img_name}";
            $img->move(public_path('Gellarys'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            return Gellary::where('id',$Gellary_id)->where('user_id',$user_id)->update([
                'title'=>$title,
                'short_discription'=>$short_discription,
                'image'=>$img_url,

            ]);

        }

        else {
            return Gellary::where('id',$Gellary_id)->where('user_id',$user_id)->update([
                'title'=>$request->input('title'),
                'short_discription'=>$short_discription,

            ]);
        }
    }

    function GellaryDelete(Request $request)
    {
        $user_id=$request->header('id');
        $Gellary_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Gellary::where('id',$Gellary_id)->where('user_id',$user_id)->delete();

    }
}
