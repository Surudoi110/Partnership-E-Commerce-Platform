<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 text-gray-900">

<nav class="bg-gray-900 text-white px-6 py-4 shadow">
    <div class="container mx-auto flex justify-between items-center">
        <h1 class="text-xl font-bold">Admin Panel</h1>
        <ul class="flex space-x-6">
            <li><a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-400">Dashboard</a></li>
            <li><a href="/admin/users" class="hover:text-indigo-400">Users</a></li>
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="text-white hover:text-indigo-300">
                        Logout
                    </button>
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
