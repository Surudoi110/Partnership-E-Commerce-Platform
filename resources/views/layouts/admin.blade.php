<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'Admin Panel')</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-gray-900 text-white px-6 py-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Admin Panel</h1>
        <ul class="flex space-x-6">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-400">Dashboard</a></li>
            <li><a href="/admin/users" class="hover:text-indigo-400">Users</a></li>
            <li><a href="/admin/products" class="hover:text-indigo-400">Products</a></li>
            <li>
                <form action="{{ route('logout') }}" method="POST">@csrf
                    <button class="hover:text-red-400">Logout</button>
                </form>
            </li>
        </ul>
    </div>
</nav>

<main class="container mx-auto py-10 px-6">
    @yield('content')
</main>

</body>
</html>
