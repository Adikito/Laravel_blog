@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="max-w-md mx-auto px-6">
    <div class="border border-gray-800 rounded-lg p-10 bg-gray-900/50">
        <h2 class="text-3xl font-semibold text-white mb-8 text-center tracking-tight">Create Account</h2>
        
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-300 mb-3">
                    Name
                </label>
                <input 
                    type="text" 
                    name="name" 
                    id="name" 
                    value="{{ old('name') }}"
                    required 
                    autofocus
                    class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                    placeholder="Your name"
                >
                @error('name')
                    <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-300 mb-3">
                    Email
                </label>
                <input 
                    type="email" 
                    name="email" 
                    id="email" 
                    value="{{ old('email') }}"
                    required
                    class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                    placeholder="your@email.com"
                >
                @error('email')
                    <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-300 mb-3">
                    Password
                </label>
                <input 
                    type="password" 
                    name="password" 
                    id="password" 
                    required
                    class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                    placeholder="••••••••"
                >
                @error('password')
                    <p class="mt-2 text-sm text-gray-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-gray-300 mb-3">
                    Confirm Password
                </label>
                <input 
                    type="password" 
                    name="password_confirmation" 
                    id="password_confirmation" 
                    required
                    class="w-full px-4 py-3 bg-gray-950 border border-gray-800 rounded-md text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-700 focus:border-transparent transition-all"
                    placeholder="••••••••"
                >
            </div>

            <div>
                <button 
                    type="submit" 
                    class="w-full text-white bg-gray-800 hover:bg-gray-700 px-4 py-3 rounded-md transition-colors font-semibold tracking-tight"
                >
                    Register
                </button>
            </div>

            <div class="text-center pt-4 border-t border-gray-800">
                <p class="text-sm text-gray-400">
                    Already have an account? 
                    <a href="{{ route('login') }}" class="text-white hover:text-gray-300 transition-colors font-medium">
                        Login here
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection
