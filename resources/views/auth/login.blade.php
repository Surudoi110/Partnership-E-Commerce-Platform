@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold text-center mb-6">Welcome Back</h2>

        <form method="POST" action="/register/login" novalidate>
            @csrf

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required autofocus placeholder="Enter your email"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                @error('email') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input id="password" name="password" type="password" required placeholder="Enter your password"
                    class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('password') border-red-500 @enderror">
                @error('password') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            <div class="flex items-center justify-between mb-4">
                <label class="flex items-center gap-2 text-sm">
                    <input type="checkbox" name="remember" id="remember" class="h-4 w-4 text-indigo-600 rounded border-gray-300">
                    <span class="text-gray-700">Remember me</span>
                </label>
                <a href="/password/reset" class="text-sm text-indigo-600 hover:underline">Forgot password?</a>
            </div>

            <div class="mb-4">
                <button type="submit" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-500">Sign In</button>
            </div>

            <p class="text-center text-sm text-gray-600">Don't have an account? <a href="/register/signup" class="text-indigo-600 font-medium hover:underline">Create one here</a></p>
        </form>
    </div>
</div>
@endsection