@extends('layouts.admin')

@section('title', 'Admin Dashboard')

@section('content')
<div class="p-6">
    <h1 class="text-3xl font-bold mb-6">Welcome, Admin 👋</h1>

    {{-- Stats --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded p-6">
            <p class="text-gray-500">Total Users</p>
            <p class="text-3xl font-bold">{{ $totalUsers }}</p>
        </div>
    </div>

    {{-- Actions --}}
    <div class="mt-8">
        <a href="{{ route('admin.users.index') }}"
           class="inline-block px-6 py-3 bg-indigo-600 text-white rounded hover:bg-indigo-500">
            Manage Users
        </a>
    </div>
</div>
@endsection
