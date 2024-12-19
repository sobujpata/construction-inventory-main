<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuildingDetail;
use Illuminate\Support\Facades\File;

class BuildingDetailController extends Controller
{
    public function index(){
        return view('pages.dashboard.building-details');
    }
    public function BuildingList(){
        $Buildings = BuildingDetail::all();
        return response()->json($Buildings);
    }

    public function BuildingCreate(Request $request){
        $user_id=$request->header('id');

        // Prepare File Name & Path
        $img=$request->file('img');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="buildings/{$img_name}";


        // Upload File
        $img->move(public_path('buildings'),$img_name);


        // Save To Database
        return BuildingDetail::create([
            'user_id'=>$user_id,
            'name'=>$request->input('name'),
            'title'=>$request->input('title'),
            'discription'=>$request->input('discription'),
            'location'=>$request->input('location'),
            'total_land'=>$request->input('total_land'),
            'no_of_storied'=>$request->input('no_of_storied'),
            'total_owner'=>$request->input('total_owner'),
            'map_location'=>$request->input('map_location'),
            'image'=>$img_url,
        ]);
    }

    public function BuildingById(Request $request){
        $id = $request->input('id');
        return BuildingDetail::where('id',$id)->first();
    }

    public function BuildingUpdate(Request $request){
        $user_id = $request->header('id');
        $building_id = $request->input('id');
        $name = $request->input('name');
        $title = $request->input('title');
        $discription = $request->input('discription');
        $location = $request->input('location');
        $total_land = $request->input('total_land');
        $no_of_storied = $request->input('no_of_storied');
        $total_owner = $request->input('total_owner');
        $map_location = $request->input('map_location');
        // $file_path = $request->input('file_path');
        // $img = $request->input('img');

        if ($request->hasFile('img')) {

            // Upload New File
            $img=$request->file('img');
            $t=time();
            $file_name=$img->getClientOriginalName();
            $img_name="{$user_id}-{$t}-{$file_name}";
            $img_url="buildings/{$img_name}";
            $img->move(public_path('buildings'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            return BuildingDetail::where('id',$building_id)->where('user_id',$user_id)->update([
                'name'=>$name,
                'title'=>$title,
                'discription'=>$discription,
                'image'=>$img_url,
                'location'=>$location,
                'total_land'=>$total_land,
                'no_of_storied'=>$no_of_storied,
                'total_owner'=>$total_owner,
                'map_location'=>$map_location,
            ]);

        }

        else {
            return BuildingDetail::where('id',$building_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'title'=>$title,
                'discription'=>$discription,
                'location'=>$location,
                'total_land'=>$total_land,
                'no_of_storied'=>$no_of_storied,
                'total_owner'=>$total_owner,
                'map_location'=>$map_location,
            ]);
        }
    }

    function BuildingDelete(Request $request)
    {
        $user_id=$request->header('id');
        $building_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return BuildingDetail::where('id',$building_id)->where('user_id',$user_id)->delete();

    }
}
