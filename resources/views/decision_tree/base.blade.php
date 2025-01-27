<!DOCTYPE html>
<html>
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>@yield('title') Servix</title>

</head>

<body>

    <div class="min-h-screen flex flex-1 bg-gray-100">
        <div class="flex-1 flex flex-col">
    
            <!-- Header -->
            <header class="fixed top-0 w-full bg-white  border-teal-500 border-b z-50">
                <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex items-center justify-between h-16">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                            <a href="/" class="text-2xl font-bold text-gray-800">Servix Technicians</a>
                        </div>
    
                        <!-- Navigation Links (Hidden on small screens) -->
                        <nav class="hidden md:flex space-x-8">
                            <a href="#home" class="text-gray-600 hover:text-gray-800">Home</a>
                            <a href="#about" class="text-gray-600 hover:text-gray-800">About</a>
                            <a href="#services" class="text-gray-600 hover:text-gray-800">Services</a>
                            <a href="#contact" class="text-gray-600 hover:text-gray-800">Contact</a>
                        </nav>
    
                        <!-- Hamburger Menu (Visible on small screens) -->
                        <div class="md:hidden">
                            <button id="menu-toggle" class="text-gray-800 focus:outline-none">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
    
                <!-- Mobile Menu -->
                <div id="mobile-menu" class="hidden md:hidden bg-white border-t border-gray-200">
                    <nav class="flex flex-col space-y-1 p-4">
                        <a href="#home" class="text-gray-600 hover:text-gray-800">Home</a>
                        <a href="#about" class="text-gray-600 hover:text-gray-800">About</a>
                        <a href="#services" class="text-gray-600 hover:text-gray-800">Services</a>
                        <a href="#contact" class="text-gray-600 hover:text-gray-800">Contact</a>
                    </nav>
                </div>
            </header>
    
            <!-- Content -->
            <div class="pt-16">
                @yield('content')
                @show
            </div>
    
        </div>
    </div>
    
    <script>
        // Toggle the mobile menu visibility
        document.getElementById('menu-toggle').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
    </script>
    

</body>

</html>
