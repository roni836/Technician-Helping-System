@extends('decision_tree.base')

@section('content')
<div class="container mx-auto px-6 py-8">
    <div class="flex flex-wrap justify-between items-center p-4">
        <h2 class="md:text-xl text-lg font-semibold  text-slate-500 border-s-4 border-s-teal-500 pl-3 mb-5">Mennage Users</h2>
        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 bg-teal-500 text-white  rounded hover:bg-blue-600">
            Back To Dashboard
        </a>
    </div>
    <div class="overflow-x-auto bg-white  rounded-lg">
        <table class="min-w-full border-collapse border border-gray-300">
            <thead class="bg-gray-100">
                <tr>
                    <th class="border px-6 py-3 text-left text-gray-700">ID</th>
                    <th class="border px-6 py-3 text-left text-gray-700">Name</th>
                    <th class="border px-6 py-3 text-left text-gray-700">Email</th>
                    <th class="border px-6 py-3 text-left text-gray-700">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="border px-6 py-3">{{ $user->id }}</td>
                    <td class="border px-6 py-3">{{ $user->name }}</td>
                    <td class="border px-6 py-3">{{ $user->email }}</td>
                    <td class="border px-6 py-3">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.edit', $user->id) }}" class="bg-indigo-500 hover:bg-indigo-600 text-white py-2 px-2 rounded">Edit</a>
                    
                            <form action="{{ route('admin.delete', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white py-2 px-2 rounded">Delete</button>
                            </form>
                        </div>
                    </td>
                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
