@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="space-y-10">

    <h1 class="text-4xl font-extrabold text-gray-800 tracking-tight">
        Welcome, Admin 👋
    </h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-6 shadow-md rounded-xl border">
            <h2 class="text-sm text-gray-500 font-semibold">Total Users</h2>
            <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white p-6 shadow-md rounded-xl border">
            <h2 class="text-sm text-gray-500 font-semibold">Total Products</h2>
            <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $totalProducts }}</p>
        </div>

        <div class="bg-white p-6 shadow-md rounded-xl border">
            <h2 class="text-sm text-gray-500 font-semibold">Total Orders</h2>
            <p class="text-4xl font-bold text-indigo-600 mt-2">{{ $totalOrders ?? 0 }}</p>
        </div>
    </div>

    {{-- Quick Actions --}}
    <h2 class="text-2xl font-semibold text-gray-700">Quick Actions</h2>

    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
        <a href="/admin/users" class="bg-white p-6 shadow-md rounded-xl border hover:bg-gray-50 transition">
            <span class="text-lg font-bold text-gray-700">Manage Users</span>
            <p class="text-sm text-gray-500 mt-1">View, edit, and delete user accounts</p>
        </a>

        <a href="/admin/products" class="bg-white p-6 shadow-md rounded-xl border hover:bg-gray-50 transition">
            <span class="text-lg font-bold text-gray-700">Manage Products</span>
            <p class="text-sm text-gray-500 mt-1">Review and control marketplace products</p>
        </a>

        <a href="/admin/orders" class="bg-white p-6 shadow-md rounded-xl border hover:bg-gray-50 transition">
            <span class="text-lg font-bold text-gray-700">Manage Orders</span>
            <p class="text-sm text-gray-500 mt-1">Track customer purchases</p>
        </a>
    </div>

</div>
@endsection
