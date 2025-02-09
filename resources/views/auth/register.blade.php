@extends('decision_tree.base')
@section('content')
<div class="flex justify-center items-center min-h-screen bg-gray-100 ">
    <div class="w-full max-w-md bg-white p-6 rounded-lg border border-green-700">
        <h2 class="text-2xl font-bold text-center text-gray-700 mb-4">Register</h2>
        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf
            <input type="text" name="name" placeholder="Name" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            <input type="email" name="email" placeholder="Email" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            <input type="password" name="password" placeholder="Password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-green-500">
           
            <button type="submit" class="w-full bg-teal-600 text-white py-2 rounded-md hover:bg-teal-800 transition">Register</button>
        </form>
        @if ($errors->any())
            <div class="mt-4 p-3 bg-red-100 border border-red-400 text-red-700 rounded">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection
