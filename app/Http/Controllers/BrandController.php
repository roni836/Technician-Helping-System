<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the brands.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.manage_brands', compact('brands'));
    }

    /**
     * Store a newly created brand in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        Brand::create([
            'name' => $request->brand_name,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand added successfully.');
    }

    /**
     * Show the form for editing the specified brand.
     * (Optional if you’re using modals for editing)
     */
    public function edit($id)
    {
        $brand = Brand::findOrFail($id);
        return view('admin.edit_brand', compact('brand'));
    }

    /**
     * Update the specified brand in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'brand_name' => 'required|string|max:255',
        ]);

        $brand = Brand::findOrFail($id);
        $brand->update([
            'name' => $request->brand_name,
        ]);

        return redirect()->route('brands.index')->with('success', 'Brand updated successfully.');
    }

    /**
     * Remove the specified brand from storage.
     */
    public function destroy($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->delete();

        return redirect()->route('brands.index')->with('success', 'Brand deleted successfully.');
    }
}
