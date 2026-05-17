@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">

            <!-- Header -->
            <h1 class="text-2xl font-bold text-center mb-2">Welcome back 👋</h1>
            <p class="text-center text-gray-500 mb-6">Login to continue cooking</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Form -->
            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="text-sm font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-green-200">
                    @error('email')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label class="text-sm font-medium">Password</label>
                    <input type="password" name="password"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-green-200">
                    @error('password')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember -->
                <div class="flex items-center justify-between text-sm">
                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="remember">
                        Remember me
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-green-600 hover:underline">
                            Forgot?
                        </a>
                    @endif
                </div>

                <!-- Button -->
                <button class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
                    Login
                </button>

                <!-- Link -->
                <p class="text-center text-sm mt-4">
                    Don’t have an account?
                    <a href="{{ route('register') }}" class="text-green-600 hover:underline">
                        Sign up
                    </a>
                </p>

            </form>

        </div>

    </div>
@endsection
