<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class supplierController extends Controller
{
    public function index(){
        return view('pages.dashboard.suppliers');
    }

    public function SupplierList(){
        $suppliers = Supplier::all();

        return response()->json($suppliers);
    }

    public function SupplierCreate(Request $request){
        $user_id=$request->header('id');

        // Prepare File Name & Path
        $img=$request->file('img');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="suppliers/{$img_name}";


        // Upload File
        $img->move(public_path('suppliers'),$img_name);


        // Save To Database
        return Supplier::create([
            'user_id'=>$user_id,
            'name'=>$request->input('name'),
            'company_name'=>$request->input('company_name'),
            'nid_no'=>$request->input('nid_no'),
            'mobile'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'image'=>$img_url,
        ]);
    }

    public function SupplierById(Request $request){
        $id = $request->input('id');
        return Supplier::where('id',$id)->first();
    }

    public function SupplierUpdate(Request $request){
        $user_id = $request->header('id');
        $Supplier_id = $request->input('id');
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
            $img_url="Suppliers/{$img_name}";
            $img->move(public_path('Suppliers'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            return Supplier::where('id',$Supplier_id)->where('user_id',$user_id)->update([
                'name'=>$name,
                'company_name'=>$company_name,
                'nid_no'=>$nid_no,
                'image'=>$img_url,
                'mobile'=>$mobile_no,
                'address'=>$address,
            ]);

        }

        else {
            return Supplier::where('id',$Supplier_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'company_name'=>$company_name,
                'nid_no'=>$nid_no,
                'mobile'=>$mobile_no,
                'address'=>$address,
            ]);
        }
    }

    function SupplierDelete(Request $request)
    {
        $user_id=$request->header('id');
        $Supplier_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Supplier::where('id',$Supplier_id)->where('user_id',$user_id)->delete();

    }
}
