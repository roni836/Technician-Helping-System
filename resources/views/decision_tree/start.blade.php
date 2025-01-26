<!DOCTYPE html>
<html>
<head>
    <title>Start Decision Tree</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <h1>Select Brand and Problem</h1>
    <form action="{{ route('decision_tree.show') }}" method="POST">
        @csrf
        <label for="brand">Brand:</label>
        <select name="brand_id" id="brand">
            <option value="">Select a Brand</option>
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
            @endforeach
        </select>

        <label for="problem">Problem:</label>
        <select name="problem_id" id="problem">
            <option value="">Select a Problem</option>
        </select>

        <button type="submit" disabled id="start-btn">Start</button>
    </form>

    <script>
        $('#brand').on('change', function () {
            const brandId = $(this).val();
            if (brandId) {
                $.post("{{ route('decision_tree.get_problems') }}", {
                    _token: '{{ csrf_token() }}',
                    brand_id: brandId
                }, function (data) {
                    $('#problem').html('<option value="">Select a Problem</option>');
                    data.forEach(function (problem) {
                        $('#problem').append(`<option value="${problem.id}">${problem.name}</option>`);
                    });
                    $('#start-btn').prop('disabled', true);
                });
            } else {
                $('#problem').html('<option value="">Select a Problem</option>');
                $('#start-btn').prop('disabled', true);
            }
        });

        $('#problem').on('change', function () {
            $('#start-btn').prop('disabled', !$(this).val());
        });
    </script>
</body>
</html>
