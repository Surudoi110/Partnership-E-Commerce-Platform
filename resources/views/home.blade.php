<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Partnership E-Commerce</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-2xl font-bold text-indigo-600">Partnership E-Commerce</h1>
            <ul class="flex space-x-6">
                <li><a href="/" class="hover:text-indigo-500">Home</a></li>
                <li><a href="/products" class="hover:text-indigo-500">Products</a></li>
                <li><a href="/partners" class="hover:text-indigo-500">Partners</a></li>
                <li><a href="/about" class="hover:text-indigo-500">About</a></li>
                <li><a href="/contact" class="hover:text-indigo-500">Contact</a></li>
            </ul>
            <div>
                <a href="/login" class="px-4 py-2 text-white bg-indigo-600 rounded-lg hover:bg-indigo-500">Login</a>
                <a href="/register" class="ml-2 px-4 py-2 border border-indigo-600 rounded-lg text-indigo-600 hover:bg-indigo-50">Sign Up</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="bg-indigo-600 text-white py-20 text-center">
        <h2 class="text-4xl font-bold mb-4">Grow Together, Sell Together</h2>
        <p class="text-lg mb-6">A platform where businesses collaborate and reach more customers.</p>
        <a href="/products" class="px-6 py-3 bg-white text-indigo-600 font-semibold rounded-lg hover:bg-gray-100">Explore Products</a>
        <a href="/partners" class="ml-3 px-6 py-3 border border-white rounded-lg hover:bg-indigo-500">Become a Partner</a>
    </section>

    <!-- Featured Products -->
    <section class="py-16 container mx-auto px-6">
        <h3 class="text-2xl font-bold mb-6 text-center">Featured Products</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-4 shadow rounded-lg">
                <img src="https://via.placeholder.com/300" alt="Product 1" class="rounded mb-3">
                <h4 class="font-semibold">Product 1</h4>
                <p class="text-sm text-gray-600">by Local Store A</p>
                <p class="text-indigo-600 font-bold mt-2">$25</p>
            </div>
            <div class="bg-white p-4 shadow rounded-lg">
                <img src="https://via.placeholder.com/300" alt="Product 2" class="rounded mb-3">
                <h4 class="font-semibold">Product 2</h4>
                <p class="text-sm text-gray-600">by NGO Partner B</p>
                <p class="text-indigo-600 font-bold mt-2">$40</p>
            </div>
            <div class="bg-white p-4 shadow rounded-lg">
                <img src="https://via.placeholder.com/300" alt="Product 3" class="rounded mb-3">
                <h4 class="font-semibold">Product 3</h4>
                <p class="text-sm text-gray-600">by Small Business C</p>
                <p class="text-indigo-600 font-bold mt-2">$15</p>
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="bg-gray-100 py-12 text-center">
        <h3 class="text-2xl font-bold mb-4">Ready to grow your business with us?</h3>
        <a href="/register" class="px-6 py-3 bg-indigo-600 text-white font-semibold rounded-lg hover:bg-indigo-500">Join Today</a>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-gray-300 py-6 text-center">
        <p>&copy; {{ date('Y') }} Partnership E-Commerce. All rights reserved.</p>
    </footer>

</body>
</html>
