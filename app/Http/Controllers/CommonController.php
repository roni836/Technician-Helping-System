<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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

    public function problemStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'brand_id' => 'required',
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
                'problem_id' => $data->id
            ]);
        }

        return redirect()->back()->with('success', 'Problem added successfully!');
    }
    
}
