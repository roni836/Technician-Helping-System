<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Problem;
use App\Models\Question;
use App\Models\QuestionTree;
use Illuminate\Http\Request;

class DecisionTreeController extends Controller
{
    public function start()
    {
        $brands = Brand::all();
        $problems = Problem::all();

        return view('decision_tree.start', compact('brands', 'problems'));
    }

    public function show(Request $request)
    {
        $brand = Brand::findOrFail($request->input('brand_id'));
        $problem = Problem::findOrFail($request->input('problem_id'));

        $tree = QuestionTree::where('brand_id', $brand->id)
            ->where('problem_id', $problem->id)
            ->first();

        if (!$tree) {
            return redirect()->back()->with('error', 'No decision tree found for this combination.');
        }

        $question = $tree->rootQuestion;
        return view('decision_tree.show', compact('question', 'brand', 'problem'));
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
}
