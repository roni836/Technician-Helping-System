<!DOCTYPE html>
<html>

<head>
    <title>Start Decision Tree</title>
</head>

<body>
    <h1>Select Brand and Problem</h1>
    <form action="{{ route('decision_tree.show') }}" method="POST">
        @csrf
        <label for="brand">Brand:</label>
        <select name="brand_id" id="brand">
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>

        <label for="problem">Problem:</label>
        <select name="problem_id" id="problem">
            @foreach ($problems as $problem)
                <option value="{{ $problem->id }}">{{ $problem->name }}</option>
            @endforeach
        </select>

        <button type="submit">Start</button>
    </form>
</body>

</html>
