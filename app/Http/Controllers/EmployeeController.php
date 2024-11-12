<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
class EmployeeController extends Controller
{
    public function index(){
        return view('pages.dashboard.employees');
    }
    public function EmployeeList(){
        $employees = Employee::all();
        return response()->json($employees);
    }

    public function EmployeeCreate(Request $request){
        $user_id=$request->header('id');

        // Prepare File Name & Path
        $img=$request->file('img');

        $t=time();
        $file_name=$img->getClientOriginalName();
        $img_name="{$user_id}-{$t}-{$file_name}";
        $img_url="employees/{$img_name}";


        // Upload File
        $img->move(public_path('employees'),$img_name);


        // Save To Database
        return Employee::create([
            'user_id'=>$user_id,
            'name'=>$request->input('name'),
            'detailed_for'=>$request->input('detailed_for'),
            'nid_no'=>$request->input('nid_no'),
            'mobile_no'=>$request->input('mobile_no'),
            'address'=>$request->input('address'),
            'image'=>$img_url,
        ]);
    }

    public function EmployeeById(Request $request){
        $id = $request->input('id');
        return Employee::where('id',$id)->first();
    }

    public function EmployeeUpdate(Request $request){
        $user_id = $request->header('id');
        $employee_id = $request->input('id');
        $name = $request->input('name');
        $detailed_for = $request->input('detailed_for');
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
            $img_url="employees/{$img_name}";
            $img->move(public_path('employees'),$img_name);

            // Delete Old File
            $filePath=$request->input('file_path');
            File::delete($filePath);

            // Update Product

            return Employee::where('id',$employee_id)->where('user_id',$user_id)->update([
                'name'=>$name,
                'detailed_for'=>$detailed_for,
                'nid_no'=>$nid_no,
                'image'=>$img_url,
                'mobile_no'=>$mobile_no,
                'address'=>$address,
            ]);

        }

        else {
            return Employee::where('id',$employee_id)->where('user_id',$user_id)->update([
                'name'=>$request->input('name'),
                'detailed_for'=>$detailed_for,
                'nid_no'=>$nid_no,
                'mobile_no'=>$mobile_no,
                'address'=>$address,
            ]);
        }
    }

    function EmployeeDelete(Request $request)
    {
        $user_id=$request->header('id');
        $employee_id=$request->input('id');
        $filePath=$request->input('file_path');
        File::delete($filePath);
        return Employee::where('id',$employee_id)->where('user_id',$user_id)->delete();

    }
}
