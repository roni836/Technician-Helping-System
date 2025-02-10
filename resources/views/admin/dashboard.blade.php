@extends('decision_tree.base')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6"><span class="inline-block text-teal-500">Admin</span> Dashboard</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
      
        <div class="bg-white p-6 rounded-lg">
            <h2 class="text-lg font-semibold mb-2">Manage Users</h2>
            <p class="text-gray-600">Total Users: {{ $users }}</p>
            <a href="{{ route('admin.users') }}" class="mt-4 inline-block bg-teal-500 text-white px-4 py-2 rounded">View Users</a>
        </div>

    </div>
</div>
@endsection
