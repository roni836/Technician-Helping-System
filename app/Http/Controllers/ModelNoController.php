<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelNo;

class ModelNoController extends Controller
{
    /**
     * Display a listing of the models.
     */
    public function index()
    {
        $modelnos = ModelNo::all();
        return view('admin.manage_modelnos', compact('modelnos'));
    }

    /**
     * Store a newly created model in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'model_number' => 'required|string|max:255',
        ]);

        ModelNo::create([
            'model_number' => $request->model_number,
        ]);

        return redirect()->route('modelnos.index')->with('success', 'Model added successfully.');
    }

    /**
     * Show the form for editing the specified model.
     * (Optional if you use modals for editing)
     */
    public function edit($id)
    {
        $modelno = ModelNo::findOrFail($id);
        return view('admin.edit_modelno', compact('modelno'));
    }

    /**
     * Update the specified model in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'model_number' => 'required|string|max:255',
        ]);

        $modelno = ModelNo::findOrFail($id);
        $modelno->update([
            'model_number' => $request->model_number,
        ]);

        return redirect()->route('modelnos.index')->with('success', 'Model updated successfully.');
    }

    /**
     * Remove the specified model from storage.
     */
    public function destroy($id)
    {
        $modelno = ModelNo::findOrFail($id);
        $modelno->delete();

        return redirect()->route('modelnos.index')->with('success', 'Model deleted successfully.');
    }
}
