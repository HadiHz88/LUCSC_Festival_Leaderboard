@extends('layouts.app')

@section('title', 'Login - LUCSC Festival')

@section('content')
    <div class="min-h-screen flex items-center justify-center">
        <div
            class="max-w-md w-full space-y-8 p-8 bg-white rounded-lg shadow-lg transform transition-all duration-300 hover:shadow-xl">
            <div>
                <h2 class="text-center text-3xl font-bold text-gray-800">Welcome Back</h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Sign in to manage teams and matches
                </p>
            </div>
            <form class="mt-8 space-y-6" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="rounded-md shadow-sm space-y-4">
                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="email" class="sr-only">Email address</label>
                        <input id="email" name="email" type="email" required
                            class="appearance-none rounded-lg relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Email address">
                    </div>
                    <div class="transform transition-all duration-200 hover:scale-[1.01]">
                        <label for="password" class="sr-only">Password</label>
                        <input id="password" name="password" type="password" required
                            class="appearance-none rounded-lg relative block w-full px-4 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200"
                            placeholder="Password">
                    </div>
                </div>

                @if ($errors->any())
                    <div class="rounded-md bg-red-50 p-4">
                        <div class="text-sm text-red-700">
                            {{ $errors->first() }}
                        </div>
                    </div>
                @endif

                <div>
                    <button type="submit"
                        class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200 transform hover:scale-105">
                        Sign in
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
