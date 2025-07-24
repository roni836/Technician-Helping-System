<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Device;
use App\Models\ModelNo;
use App\Models\BrandProblem;
use App\Models\Problem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonController extends Controller
{
    public function brandStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        Brand::create([
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Brand added successfully!');
    }

    public function deviceStore(Request $request){
        $validator =Validator::make($request->all(),[
          'name' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
          Device::create([
          'name' =>$request->name,
        
        ]);
       
        return redirect()->back()->with('success','Device added Successfully');
    }

    public function modelnoStore(Request $request){
        $validator =Validator::make($request->all(),[
          'model_number' => 'required|string|max:255',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput();
        }
          ModelNo::create([
          'model_number' =>$request->model_number,
        
        
        ]);
       
        
        return redirect()->back()->with('success','model added Successfully');
    }

    
    public function problemStore(Request $request)
 {
   
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required',
            'device_id' => 'required',
            'modelno_id' => 'required',
        ]);
         
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Create the question
        $data = Problem::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id,
        ]);
        
        if($data){
            BrandProblem::create([
                'brand_id' => $request->brand_id,
                'problem_id' => $data->id,
                'device_id' => $request->device_id,
                'modelno_id' => $request->modelno_id,
            ]);
            
        }
        
        return redirect()->back()->with('success', 'Problem added successfully!');
    }
   
    
    
}
