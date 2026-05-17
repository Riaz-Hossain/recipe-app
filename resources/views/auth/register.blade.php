@extends('layouts.app')

@section('content')
    <div class="min-h-screen flex items-center justify-center">

        <div class="w-full max-w-md bg-white shadow-lg rounded-2xl p-8">

            <h1 class="text-2xl font-bold text-center mb-2">Create Account 🚀</h1>
            <p class="text-center text-gray-500 mb-6">Start saving your recipes</p>

            <form method="POST" action="{{ route('register') }}" class="space-y-4">
                @csrf

                <!-- Name -->
                <div>
                    <label class="text-sm font-medium">Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-green-200">
                    @error('name')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

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

                <!-- Confirm Password -->
                <div>
                    <label class="text-sm font-medium">Confirm Password</label>
                    <input type="password" name="password_confirmation"
                        class="w-full mt-1 border rounded-lg p-2 focus:ring focus:ring-green-200">
                </div>

                <!-- Button -->
                <button class="w-full bg-green-500 hover:bg-green-600 text-white py-2 rounded-lg">
                    Create Account
                </button>

                <!-- Link -->
                <p class="text-center text-sm mt-4">
                    Already have an account?
                    <a href="{{ route('login') }}" class="text-green-600 hover:underline">
                        Login
                    </a>
                </p>

            </form>

        </div>

    </div>
@endsection
