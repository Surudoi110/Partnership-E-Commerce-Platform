@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
<div class="max-w-3xl mx-auto p-6">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Edit User</h1>
        <p class="text-gray-500 text-sm">
            Update user role and account information
        </p>
    </div>

    <!-- Error Messages -->
    @if($errors->any())
        <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800">
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Card -->
    <div class="bg-white shadow rounded-lg p-6">

        <form method="POST" action="{{ route('admin.users.update', $user) }}">
            @csrf
            @method('PUT')

            <!-- Name -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Name
                </label>
                <input type="text"
                       value="{{ $user->name }}"
                       disabled
                       class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700">
            </div>

            <!-- Email -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Email
                </label>
                <input type="email"
                       value="{{ $user->email }}"
                       disabled
                       class="w-full border rounded px-3 py-2 bg-gray-100 text-gray-700">
            </div>

            <!-- Role -->
            <div class="mb-6">
                <label class="block text-sm font-medium text-gray-600 mb-1">
                    Role
                </label>

                <select name="role"
                        class="w-full border rounded px-3 py-2 focus:outline-none focus:ring focus:ring-indigo-200">

                    <option value="user" {{ $user->role === 'user' ? 'selected' : '' }}>
                        User
                    </option>

                    <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                        Admin
                    </option>
                </select>

                @if(auth()->id() === $user->id)
                    <p class="text-xs text-red-600 mt-2">
                        ⚠ You are editing your own account. Be careful changing your role.
                    </p>
                @endif
            </div>

            <!-- Actions -->
            <div class="flex justify-between">
                <a href="{{ route('admin.users.index') }}"
                   class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                    ← Back
                </a>

                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-500">
                    Save Changes
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
