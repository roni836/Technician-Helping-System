<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Problem;

class ProblemController extends Controller
{
    /**
     * Display a listing of the problems.
     */
    public function index()
    {
        $problems = Problem::all();
        return view('admin.manage_problems', compact('problems'));
    }

    /**
     * Store a newly created problem in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'problem_name' => 'required|string|max:255',
        ]);

        Problem::create([
            'name' => $request->problem_name,
        ]);

        return redirect()->route('problems.index')->with('success', 'Problem added successfully.');
    }

    /**
     * Show the form for editing the specified problem.
     * (Optional if you are using modals for editing)
     */
    public function edit($id)
    {
        $problem = Problem::findOrFail($id);
        return view('admin.edit_problem', compact('problem'));
    }

    /**
     * Update the specified problem in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'problem_name' => 'required|string|max:255',
        ]);

        $problem = Problem::findOrFail($id);
        $problem->update([
            'name' => $request->problem_name,
        ]);

        return redirect()->route('problems.index')->with('success', 'Problem updated successfully.');
    }

    /**
     * Remove the specified problem from storage.
     */
    public function destroy($id)
    {
        $problem = Problem::findOrFail($id);
        $problem->delete();

        return redirect()->route('problems.index')->with('success', 'Problem deleted successfully.');
    }
}
