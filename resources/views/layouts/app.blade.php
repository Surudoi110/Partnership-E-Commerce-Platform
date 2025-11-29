<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Partnership E-Commerce')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- OG Navbar -->
    <!-- <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            
            <h1 class="text-2xl font-bold text-indigo-600">Keandre's Marketplace</h1>
            <ul class="flex space-x-6">
                <li><a href="/" class="hover:text-indigo-500">Home</a></li>
                <li><a href="/products" class="hover:text-indigo-500">Products</a></li>
                <li><a href="/about" class="hover:text-indigo-500">About</a></li>
                <li><a href="/contact" class="hover:text-indigo-500">Contact</a></li>
            </ul>
            <form method="GET" action="{{ route('products.index') }}">
                <input type="text" name="search" placeholder="Search products..." 
                       value="{{ request('search') }}">
                <button type="submit">Search</button>
            </form>
            <div>
                
                <a href="/register/login" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-500">Login</a>
                <a href="/register/signup" class="ml-2 px-4 py-2 border border-indigo-600 rounded-lg text-indigo-600 hover:bg-indigo-50">Sign Up</a>
            </div>
            
        </div>
    </nav> -->
    <!-- Navbar --> 
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">

            <!-- LEFT GROUP: Logo + Navigation -->
            <div class="flex items-center space-x-10">

                <!-- Logo -->
                <h1 class="text-2xl font-bold text-indigo-600">
                    Keandre's Marketplace
                </h1>

                <!-- Desktop Navigation -->
                <ul class="hidden lg:flex space-x-6">
                    <li><a href="/" class="hover:text-indigo-500">Home</a></li>
                    <li><a href="/products.index" class="hover:text-indigo-500">Products</a></li>
                    <li><a href="/about" class="hover:text-indigo-500">About</a></li>
                    <li><a href="/contact" class="hover:text-indigo-500">Contact</a></li>
                </ul>

            </div>

            <!-- RIGHT GROUP: Search + Login + Sign Up -->
            <div class="hidden lg:flex items-center space-x-4">

                <!-- Search form -->
                <form method="GET" action="{{ route('products.index') }}" class="flex items-center">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search products..."
                        value="{{ request('search') }}"
                        class="border rounded-lg px-3 py-1"
                    >
                    <button
                        type="submit"
                        class="ml-2 px-4 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500"
                    >
                        Search
                    </button>
                </form>

                <!-- Login / Signup -->
                <a href="/register/login"
                    class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-500">
                    Login
                </a>

                <a href="/register/signup"
                    class="px-4 py-2 border border-indigo-600 rounded-lg text-indigo-600 hover:bg-indigo-50">
                    Sign Up
                </a>

            </div>

            <!-- Hamburger Menu (Mobile Only) -->
            <button
                class="lg:hidden text-3xl focus:outline-none"
                onclick="document.getElementById('mobile-menu').classList.toggle('hidden')"
            >
                ☰
            </button>

        </div>

        <!-- MOBILE MENU -->
        <div id="mobile-menu" class="lg:hidden hidden px-6 pb-4 space-y-4">

            <!-- Navigation -->
            <ul class="space-y-2">
                <li><a href="/" class="block hover:text-indigo-500">Home</a></li>
                <li><a href="/products.index" class="block hover:text-indigo-500">Products</a></li>
                <li><a href="/about" class="block hover:text-indigo-500">About</a></li>
                <li><a href="/contact" class="block hover:text-indigo-500">Contact</a></li>
            </ul>

            <!-- Search -->
            <form method="GET" action="{{ route('products.index') }}" class="flex">
                <input
                    type="text"
                    name="search"
                    placeholder="Search products..."
                    value="{{ request('search') }}"
                    class="border rounded-lg px-3 py-1 w-full"
                >
                <button type="submit" class="ml-2 px-4 py-1 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500">
                    Search
                </button>
            </form>

            <!-- Login / Sign Up -->
            <div class="space-y-2 pt-2">
                <a href="/register/login"
                    class="block w-full text-center py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500">
                    Login
                </a>

                <a href="/register/signup"
                    class="block w-full text-center py-2 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50">
                    Sign Up
                </a>
            </div>

        </div>
    </nav>


    <!-- Main Content -->
    <main class="min-h-screen">
        
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-10">
        <div class="container mx-auto grid md:grid-cols-3 gap-8 px-6">
            <!-- About -->
            <div>
                <h4 class="font-bold mb-3">About Us</h4>
                <p>We connect small businesses with NGOs to create impactful partnerships and reach more customers through e-commerce.</p>
            </div>
    
            <!-- Quick Links -->
            <div>
                <h4 class="font-bold mb-3">Quick Links</h4>
                <ul class="space-y-2">
                    <li><a href="/" class="hover:text-white">Home</a></li>
                    <li><a href="/products" class="hover:text-white">Products</a></li>
                    <li><a href="/partners" class="hover:text-white">Partners</a></li>
                    <li><a href="/about" class="hover:text-white">About</a></li>
                    <li><a href="/contact" class="hover:text-white">Contact</a></li>
                </ul>
            </div>
    
            <!-- Social Media -->
            <div>
                <h4 class="font-bold mb-3">Follow Us</h4>
                <div class="flex space-x-4">
                    <a href="#" class="hover:text-white">Facebook</a>
                    <a href="#" class="hover:text-white">Instagram</a>
                    <a href="#" class="hover:text-white">Twitter</a>
                </div>
            </div>
        </div>
    
        <div class="text-center mt-6 text-sm text-gray-500">
            &copy; {{ date('Y') }} Partnership E-Commerce. All rights reserved.
        </div>
    </footer>


</body>
</html>
