<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title') - Servix</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- Tailwind & Flowbite --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            @apply bg-gray-900 text-white;
        }
    </style>
</head>

<body class="bg-gray-900 text-white">

    {{-- Top Navbar --}}
    <nav class="fixed top-0 z-50 w-full bg-gray-800 border-b border-gray-700 shadow">
        <div class="px-4 py-3 flex justify-between items-center">
            <div class="flex items-center">
                <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                        class="sm:hidden text-gray-300 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                              d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"
                              clip-rule="evenodd"/>
                    </svg>
                </button>
                <a href="/" class="ml-4 text-2xl font-bold text-white">NovaFix Support</a>
            </div>

            <div>
                @auth
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm transition">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-teal-400 hover:underline text-sm">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    {{-- Admin Sidebar --}}
    @auth
        @if(Auth::user()->is_admin)
            <aside id="logo-sidebar"
                   class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full sm:translate-x-0 bg-gray-800 border-r border-gray-700"
                   aria-label="Sidebar">
                <div class="h-full px-3 py-4 overflow-y-auto">
                    <ul class="space-y-2 text-white">
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                                <span>📊 Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.manageDevices') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                                <span>🔧 Manage Devices</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.manageBrands') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                                <span>🏷️ Manage Brands</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.manageModelNos') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                                <span>📱 Manage Models</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.manageProblems') }}" class="flex items-center p-2 rounded hover:bg-gray-700">
                                <span>❗ Manage Problems</span>
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="p-2">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded">
                                    🔒 Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </aside>
        @endif
    @endauth

    {{-- Main Content --}}
    <div class="@auth sm:ml-64 @endauth mt-16 p-6">
        @yield('content')
    </div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
</body>
</html>
