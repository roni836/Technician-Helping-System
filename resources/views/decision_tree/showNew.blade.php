@extends('decision_tree.base')

@section('content')
    <div class="bg-teal-100 font-sans antialiased flex flex-col  items-center h-screen p-4 pt-10">

        {{-- {{dd($question)}} --}}
        <span class="text-xl text-start text-teal-700 font-medium mb-4">
            Brand Name: {{ $brandProblem->brand->name ?? 'Not Available' }}
        </span>
        <span class="text-xl text-start text-teal-700 font-medium mb-4">
            Problem: {{ $brandProblem->problem->name ?? 'Not Available' }}
        </span>
        <div class="bg-white p-8 rounded-lg shadow-lg border border-teal-300 max-w-lg w-full">
            <h1 class="text-3xl font-bold text-center text-teal-800 mb-6">{{ $question->question_text ?? 'Not available'}}</h1>

            @if ($question)

                @if (!$question->yes_child_id || !$question->no_child_id)
                    <h2 class="text-2xl font-bold text-gray-800 mb-6">Add New Question</h2>
                    <form action="{{ route('decision_tree.add_question') }}" method="POST">
                        @csrf
                        <input type="hidden" name="current_question_id" value="{{ $question->id }}">
                        <label for="answer">Answer for New Question:</label>
                        <select name="answer" id="answer"
                            class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 mb-5"
                            required>
                            <option value="yes" {{ !$question->yes_child_id ? '' : 'disabled' }}>Yes</option>
                            <option value="no" {{ !$question->no_child_id ? '' : 'disabled' }}>No</option>
                        </select>

                        <label for="new_question">New Question:</label>
                        <input type="text" name="new_question" id="new_question"
                            class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-3"
                            placeholder="Type your question here..." required>

                        <button type="submit"
                            class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 mt-5 w-1/3">Add
                            Question</button>
                    </form>
                @else
                    <div class="flex justify-center space-x-4 mb-6">
                        <a href="{{ route('decision_tree.show_question', ['id' => $question->yes_child_id]) }}"
                            class="px-6 py-3 bg-teal-500 text-white rounded-lg font-bold hover:bg-teal-600 focus:outline-none focus:ring-4 focus:ring-teal-300 transition duration-300">Yes</a>
                        <a href="{{ route('decision_tree.show_question', ['id' => $question->no_child_id]) }}"
                            class="px-6 py-3 bg-teal-500 text-white rounded-lg font-bold hover:bg-teal-600 focus:outline-none focus:ring-4 focus:ring-teal-300 transition duration-300">No</a>
                    </div>
                @endif
            @else
                <form action="{{ route('decision_tree.add__starting_question') }}" method="POST">
                    @csrf
                    <label for="new_question">New Question:</label>
                    <input type="hidden" name="problem_id" value="{{ $problem_id }}">
                    <input type="text" name="new_question" id="new_question"
                        class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 mb-3"
                        placeholder="Type your question here..." required>

                    <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 mt-5 w-1/3">Add
                        Question</button>
                </form>
            @endif

        </div>

    </div>
@endsection
