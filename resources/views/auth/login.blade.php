@extends('decision_tree.base')
@section('content')
<div class="flex items-center justify-center min-h-screen  px-4">
    <div class="bg-white border border-teal-700 rounded-lg p-8 max-w-md w-full">
        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Login to your account</h2>

        <form action="/login" method="POST" class="space-y-5">
            @csrf 
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email" 
                       class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none" 
                       required>
            </div>
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input type="password" id="password" name="password" 
                       class="w-full px-4 py-2 mt-1 border rounded-md focus:ring-2 focus:ring-yellow-500 focus:outline-none" 
                       required>
            </div>

            @if ($errors->any())
                <div class="text-red-500 text-sm">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="flex items-center justify-between">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" class="h-4 w-4 text-yellow-500 border-gray-300 rounded focus:ring-yellow-500">
                    <span class="text-sm text-gray-600">Remember me</span>
                </label>
                <a href="#" class="text-sm text-teal-500 hover:underline">Forgot password?</a>
            </div>

            <button type="submit" 
                    class="w-full bg-teal-500 hover:bg-teal-600 text-white py-2 rounded-md transition">
                Login
            </button>

            <p class="text-center text-sm text-gray-600">
                Don't have an account? 
                <a href="/register" class="text-teal-500 hover:underline">Sign up</a>
            </p>
        </form>
    </div>
</div>
@endsection