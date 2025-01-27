@extends('decision_tree.base')
@section('content')
    <div class="w-1/2 mx-auto bg-white p-6 rounded-lg shadow  border mt-10">

        <h1 class="text-2xl font-bold text-gray-800 mb-6">Select Brand and Problem</h1>
        <form action="{{ route('decision_tree.show') }}" method="POST">
            @csrf
            <label for="brand">Brand:</label>
            <select name="brand_id" id="brand"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a Brand</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
            </select>

            <label for="problem">Problem:</label>
            <select name="problem_id" id="problem"
                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                <option value="">Select a Problem</option>
            </select>

            <button type="submit" disabled id="start-btn"  class="w-full bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-200 mt-5 w-1/3">Start</button>
        </form>
    </div>

    <script>
        $('#brand').on('change', function() {
            const brandId = $(this).val();
            if (brandId) {
                $.post("{{ route('decision_tree.get_problems') }}", {
                    _token: '{{ csrf_token() }}',
                    brand_id: brandId
                }, function(data) {
                    $('#problem').html('<option value="">Select a Problem</option>');
                    data.forEach(function(problem) {
                        $('#problem').append(
                            `<option value="${problem.id}">${problem.name}</option>`);
                    });
                    $('#start-btn').prop('disabled', true);
                });
            } else {
                $('#problem').html('<option value="">Select a Problem</option>');
                $('#start-btn').prop('disabled', true);
            }
        });

        $('#problem').on('change', function() {
            $('#start-btn').prop('disabled', !$(this).val());
        });
    </script>
@endsection
