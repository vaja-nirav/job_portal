@extends('layouts.app')

@section('title', 'Explore All Job Types - JobFinder')

@section('content')
    <!-- 1. All Job Types Listing Hero Section -->
    <div class="bg-gradient-to-b from-blue-50 to-white pt-24 pb-16 relative z-10">
        <!-- Background decorative elements container -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100 opacity-50 blur-3xl mix-blend-multiply"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-cyan-100 opacity-50 blur-3xl mix-blend-multiply"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm mb-6 border border-blue-200 shadow-sm">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                    </span>
                    Explore Job Types
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4 leading-tight">
                    All Job <span class="text-blue-600">Types</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    All jobs type listing. Find the perfect working arrangement to build your dream career.
                </p>

                <!-- Search box card for job types -->
                <div class="bg-white p-3 rounded-2xl shadow-xl shadow-blue-900/5 border border-gray-100 max-w-2xl mx-auto mt-6">
                    <form action="{{ route('categories.index') }}" method="GET" class="flex gap-2">
                        <div class="flex-1 relative flex items-center">
                            <svg class="w-5 h-5 text-gray-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search job types..."
                                class="w-full pl-12 pr-4 py-3 bg-gray-50/50 border border-gray-200/80 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-gray-900 font-medium transition text-sm">
                        </div>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-xl font-bold transition shadow-md shadow-blue-500/20 text-sm">
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- 2. Grid Workspace (Job Types Listing) -->
    <div class="bg-gray-50/50 py-16 border-t border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-8 flex items-center gap-2">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                </svg>
                Job Types / Arrangements
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($jobTypes as $type)
                    <div class="bg-white p-6 rounded-2xl border border-gray-200/60 shadow-sm hover:shadow-xl hover:border-blue-500 hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                        <div>
                            <div class="w-12 h-12 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold text-lg mb-4 group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                                {{ substr($type->name, 0, 1) }}
                            </div>
                            <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition leading-snug">{{ $type->name }}</h3>
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-50">
                            <a href="{{ route('jobs.index', ['type' => $type->id]) }}" 
                               class="text-blue-600 hover:text-blue-800 text-xs font-bold flex items-center gap-1 uppercase tracking-wider transition">
                                Explore Jobs &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination Links -->
            <div class="mt-12">
                {{ $jobTypes->withQueryString()->links() }}
            </div>
        </div>
    </div>
@endsection
