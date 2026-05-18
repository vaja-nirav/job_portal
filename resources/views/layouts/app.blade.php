<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Job Portal - Find Your Dream Career')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="antialiased bg-gray-50 text-gray-800 flex flex-col min-h-screen">

    <!-- Navbar -->
    <nav class="bg-white border-b border-gray-100 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <div class="flex items-center">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-extrabold text-blue-700 tracking-tight">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7h-4V5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v2H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-10-2h4v2h-4V5zm10 14H4V9h16v10z"/></svg>
                        JobFinder
                    </a>
                </div>
                
                <div class="hidden lg:flex space-x-1 items-center">
                    <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition">Home</a>
                    <a href="{{ route('jobs.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition">All Jobs</a>
                    <a href="{{ route('jobs.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition">Latest Jobs</a>
                    <a href="{{ route('jobs.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition">Job Types</a>
                    <a href="{{ route('jobs.index') }}" class="px-4 py-2 rounded-lg text-sm font-semibold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition">Qualification</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 pt-16 pb-8 text-gray-300 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
                <div class="md:col-span-2">
                    <a href="{{ route('home') }}" class="flex items-center gap-2 text-2xl font-extrabold text-white tracking-tight mb-4">
                        <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 24 24"><path d="M20 7h-4V5c0-1.103-.897-2-2-2h-4c-1.103 0-2 .897-2 2v2H4c-1.103 0-2 .897-2 2v10c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V9c0-1.103-.897-2-2-2zm-10-2h4v2h-4V5zm10 14H4V9h16v10z"/></svg>
                        JobFinder
                    </a>
                    <p class="text-gray-400 mb-6 max-w-sm">We connect the best talent with top companies and government sectors. Start your journey today.</p>
                </div>
                
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Quick Links</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('jobs.index') }}" class="hover:text-blue-400 transition">Find Jobs</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">About Us</a></li>
                        <li><a href="#" class="hover:text-blue-400 transition">Contact Support</a></li>
                    </ul>
                </div>
                
                <div>
                    <h3 class="text-white font-bold mb-4 uppercase text-sm tracking-wider">Job Alerts</h3>
                    <form action="{{ route('subscribe') }}" method="POST" class="mt-2">
                        @csrf
                        <div class="flex">
                            <input type="email" name="email" required placeholder="Enter your email" class="w-full px-4 py-2.5 rounded-l-lg bg-gray-800 border border-gray-700 text-white focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-500 px-4 py-2.5 rounded-r-lg font-bold transition text-white">Subscribe</button>
                        </div>
                        @if(session('success'))
                            <p class="text-green-400 text-xs mt-2 font-medium">{{ session('success') }}</p>
                        @endif
                        @error('email')
                            <p class="text-red-400 text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </form>
                </div>
            </div>
            
            <div class="border-t border-gray-800 pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p>&copy; {{ date('Y') }} JobFinder. All rights reserved.</p>
                <div class="flex gap-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>
