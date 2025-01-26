
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

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
    @else
    <h1>{{ $question->question_text }}</h1>

    <a href="{{ route('decision_tree.show_question', ['id' => $question->yes_child_id]) }}">Yes</a>
    <a href="{{ route('decision_tree.show_question', ['id' => $question->no_child_id]) }}">No</a>

@endif


</body>
</html>
