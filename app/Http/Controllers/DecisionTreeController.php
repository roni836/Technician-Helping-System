<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandProblem;
use App\Models\Problem;
use App\Models\Question;
use App\Models\Device;
use App\Models\ModelNo;
use App\Models\QuestionTree;
use Illuminate\Http\Request;

class DecisionTreeController extends Controller
{
    public function start()
    {
        $brands = Brand::all();
        $problems = Problem::all();
        $devices = Device::all();
        $modelnos = ModelNo::all();
      
      

        return view('decision_tree.start', compact('brands', 'problems','devices','modelnos'));
    }

    public function show(Request $request)
    {
        $brandProblem = BrandProblem::where('brand_id', $request->input('brand_id'))
            ->where('problem_id', $request->input('problem_id'))
          ->where('device_id', $request->input('device_id')) 
          ->where('modelno_id', $request->input('modelno_id')) 
            ->first();

        if (!$brandProblem) {
            return redirect()->route('decision_tree.start')->with('error', 'No decision tree found for this combination.');
        }
       
        $tree = $brandProblem->questionTree;
        $question = $tree->rootQuestion ?? null;

        if (!$question) {
         $problem_id = $request->input('problem_id');

            return view('decision_tree.showNew', compact('question', 'problem_id','brandProblem'));
        }

        return view('decision_tree.showNew', compact('question','brandProblem'));
    }
  

  
    
    public function answer(Request $request, $id)
    {
        $question = Question::findOrFail($id);
        $nextQuestionId = $request->input('answer') === 'yes' ? $question->yes_child_id : $question->no_child_id;

        if ($nextQuestionId) {
            return redirect()->route('decision_tree.show_question', ['id' => $nextQuestionId]);
        } else {
            return view('decision_tree.end');
        }
    }

    public function showQuestion($id)
    {
        $question = Question::find($id);

        if (!$question) {
            abort(404, 'Question not found.');
        }

        return view('decision_tree.showNew', compact('question'));
    }

    public function addQuestion(Request $request)
    {
        $validated = $request->validate([
            'current_question_id' => 'required|exists:questions,id',
            'answer' => 'required|in:yes,no',
            'new_question' => 'required|string|max:255',
        ]);

        $newQuestion = Question::create(['question_text' => $validated['new_question']]);

        // Update the parent question to link the new question
        $currentQuestion = Question::find($validated['current_question_id']);
        if ($validated['answer'] === 'yes') {
            $currentQuestion->yes_child_id = $newQuestion->id;
        } else {
            $currentQuestion->no_child_id = $newQuestion->id;
        }
        $currentQuestion->save();

        return redirect()->back()->with('success', 'New question added successfully.');
    }


public function addStartingQuestion(Request $request)
{
    $validated = $request->validate([
        'new_question' => 'required|string|max:255',
        'brand_id' => 'required|exists:brands,id',
        'problem_id' => 'required|exists:problems,id',
        'device_id' => 'required|exists:devices,id',
        'modelno_id' => 'required|exists:model_nos,id',
    ]);

    $newQuestion = Question::create([
        'question_text' => $validated['new_question']
    ]);

    $brandProblem = BrandProblem::where('brand_id', $validated['brand_id'])
        ->where('problem_id', $validated['problem_id'])
        ->where('device_id', $validated['device_id'])
        ->where('modelno_id', $validated['modelno_id'])
        ->first();

    if ($newQuestion && $brandProblem) {
        QuestionTree::create([
            'brand_problem_id' => $brandProblem->id,
            'question_id' => $newQuestion->id
        ]);
    }

    return redirect()->back()->with('success', 'New question added successfully.');
}

    public function getProblems(Request $request)
    {
        $brand = Brand::findOrFail($request->input('brand_id'));
        $problems = Problem::whereIn('id', function ($query) use ($brand) {
            $query->select('problem_id')
                ->from('brand_problems')
                ->where('brand_id', $brand->id);
        })->get();

        return response()->json($problems);
    }
    public function editQuestion($id)
{
    $question = Question::findOrFail($id);
    return view('decision_tree.edit', compact('question'));
}

public function updateQuestion(Request $request, $id)
{
    $validated = $request->validate([
        'question_text' => 'required|string|max:255',
    ]);

    $question = Question::findOrFail($id);
    $question->question_text = $validated['question_text'];
    $question->save();

    return redirect()->route('decision_tree.show_question', ['id' => $id])->with('success', 'Question updated successfully.');
}

}
