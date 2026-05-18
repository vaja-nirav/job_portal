<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Job Update Portal')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>
<body class="antialiased bg-slate-50 text-slate-800">

    <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex">
                    <div class="shrink-0 flex items-center">
                        <a href="{{ route('home') }}" class="text-2xl font-bold text-indigo-600">JobPortal</a>
                    </div>
                    <div class="hidden sm:ml-6 sm:flex sm:space-x-8 ml-auto">
                        <a href="{{ route('home') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300">Home</a>
                        <a href="{{ route('jobs.index') }}" class="inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300">All Jobs</a>
                        <a href="{{ route('jobs.index', ['category' => 'Government Jobs']) }}" class="hidden lg:inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300">Latest Jobs</a>
                        <a href="{{ route('jobs.index', ['category' => 'IT Jobs']) }}" class="hidden lg:inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300">Job Types</a>
                        <a href="{{ route('jobs.index', ['category' => 'Bank Jobs']) }}" class="hidden lg:inline-flex items-center px-1 pt-1 border-b-2 border-transparent text-sm font-medium text-slate-500 hover:text-slate-700 hover:border-slate-300">Qualifications</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-slate-900 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h3 class="text-xl font-bold mb-4">JobPortal</h3>
                <p class="text-slate-400">Your number one source for the latest job updates and notifications.</p>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Quick Links</h3>
                <ul class="space-y-2 text-slate-400">
                    <li><a href="#" class="hover:text-white transition">About Us</a></li>
                    <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                    <li><a href="#" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-xl font-bold mb-4">Subscribe for Updates</h3>
                <form class="flex" action="{{ route('subscribe') }}" method="POST">
                    @csrf
                    <input type="email" name="email" placeholder="Your Email" required class="px-4 py-2 w-full rounded-l-md text-slate-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 @error('email') border-red-500 @enderror">
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-r-md transition">Subscribe</button>
                </form>
                @if(session('success'))
                    <p class="text-emerald-400 text-sm mt-2 font-medium">{{ session('success') }}</p>
                @endif
                @error('email')
                    <p class="text-red-400 text-sm mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </footer>
</body>
</html>
