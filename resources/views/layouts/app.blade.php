<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>E-learning System KPPS - Hanif Purwanto</title>
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="bg-gray-100 text-gray-800">

    <!-- Navbar -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <a href="{{ url('/') }}" class="flex items-center text-xl font-bold text-indigo-600">
                        <img src="{{ asset('hero2.png') }}" alt="LMS KPU" class="h-16 w-auto">
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @auth
                        @if(auth()->user()->role === 'administrator')
                            <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-indigo-600">Dashboard</a>
                            <a href="{{ route('kpps-users.index') }}" class="text-gray-700 hover:text-indigo-600">Menajemen KPPS</a>
                        @endif
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-red-500 hover:text-red-700">Logout</button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-gray-700 hover:text-indigo-600">Login</a>
                        <a href="{{ route('register') }}" class="text-gray-700 hover:text-indigo-600">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="max-w-7xl mx-auto p-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-white shadow-md mt-10">
        <div class="max-w-7xl mx-auto px-4 py-6 text-center text-gray-500 text-sm">
            &copy; {{ date('Y') }} E-learning System KPPS - Hanif Purwanto. All rights reserved.
        </div>
    </footer>
    <!-- Javascript  -->
    @stack('scripts')
    <!-- End Javascript  -->
</body>
</html>
