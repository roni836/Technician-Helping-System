@extends('decision_tree.base')

@section('content')
<div class="container mx-auto px-6 py-8">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit User</h1>

    <div class="max-w-lg mx-auto bg-white shadow-lg rounded-lg p-6">
        <form action="{{ route('admin.update', $user->id) }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Name:</label>
                <input type="text" name="name" value="{{ $user->name }}" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-400 focus:outline-none">
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">Email:</label>
                <input type="email" name="email" value="{{ $user->email }}" readonly 
                    class="w-full border border-gray-300 bg-gray-100 rounded-lg px-4 py-2 cursor-not-allowed">
            </div>

            <button type="submit" 
                class="w-full bg-blue-500 text-white font-semibold px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                Update
            </button>
        </form>
    </div>
</div>
@endsection
