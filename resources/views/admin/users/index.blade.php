@extends('layouts.admin')

@section('title', 'Manage Users')

@section('content')
<div class="p-6">

    <!-- Page Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">User Management</h1>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div class="mb-4 px-4 py-3 rounded bg-green-100 text-green-800">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 px-4 py-3 rounded bg-red-100 text-red-800">
            {{ session('error') }}
        </div>
    @endif

    <!-- Users Table -->
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">#</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Name</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Email</th>
                    <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600">Role</th>
                    <th class="px-6 py-3 text-right text-sm font-semibold text-gray-600">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y">
                @forelse($users as $index => $user)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 text-sm">
                            {{ $users->firstItem() + $index }}
                        </td>

                        <td class="px-6 py-4 text-sm font-medium text-gray-800">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">
                            @if($user->role === 'admin')
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-700">
                                    Admin
                                </span>
                            @else
                                <span class="px-3 py-1 text-xs font-semibold rounded-full bg-gray-200 text-gray-700">
                                    User
                                </span>
                            @endif
                        </td>

                        <td class="px-6 py-4 text-right space-x-2">
                            <!-- Edit -->
                            <a href="{{ route('admin.users.edit', $user) }}"
                               class="inline-block px-4 py-2 text-sm bg-indigo-600 text-white rounded hover:bg-indigo-500">
                                Edit
                            </a>

                            <!-- Delete -->
                            <form action="{{ route('admin.users.destroy', $user) }}"
                                  method="POST"
                                  class="inline-block"
                                  onsubmit="return confirm('Are you sure you want to delete this user?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-500">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-gray-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $users->links() }}
    </div>

</div>
@endsection
