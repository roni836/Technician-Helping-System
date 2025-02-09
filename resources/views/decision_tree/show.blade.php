@extends('decision_tree.base')

@section('content')
    <div class="bg-teal-100 font-sans antialiased flex flex-col  items-center h-screen p-4">
        {{-- {{dd($question)}} --}}
        @if(Auth::user()->is_admin)
        <h1 class="text-3xl font-bold text-center text-teal-800 mb-6">{{ $question->question_text }}</h1>

        <form action="{{ route('decision_tree.answer', $question->id) }}" method="POST">
            @csrf
            <button type="submit" name="answer" value="yes">Yes</button>
            <button type="submit" name="answer" value="no">No</button>
        </form>

        @if (session('error'))
            <p style="color: red;">{{ session('error') }}</p>
        @endif

        @if (session('success'))
            <p style="color: green;">{{ session('success') }}</p>
        @endif

        @if (!$question->yes_child_id || !$question->no_child_id)
            <h2>Add a New Question</h2>
            <form action="{{ route('decision_tree.add_question') }}" method="POST">
                @csrf
                <input type="hidden" name="current_question_id" value="{{ $question->id }}">
                <label for="answer">Answer for New Question:</label>
                <select name="answer" id="answer" required>
                    <option value="yes" {{ !$question->yes_child_id ? '' : 'disabled' }}>Yes</option>
                    <option value="no" {{ !$question->no_child_id ? '' : 'disabled' }}>No</option>
                </select>

                <label for="new_question">New Question:</label>
                <input type="text" name="new_question" id="new_question" required>

                <button type="submit">Add Question</button>
            </form>
        @endif
    </div>
    @else
    <script>window.location = "/";</script>
    @endif
    @endauth
@endsection
