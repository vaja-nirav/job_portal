@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-blue-50 to-white pt-16 pb-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm mb-6 border border-blue-200">
                    <span class="relative flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                    </span>
                    Over 200+ New Jobs Added Today
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    Find Your Next <span class="text-blue-600">Opportunity</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10">
                    Discover thousands of job opportunities across government and private sectors. Your dream career starts right here.
                </p>
                
                <!-- Search Box -->
                <div class="bg-white p-4 rounded-2xl shadow-xl shadow-blue-900/5 border border-gray-100 max-w-4xl mx-auto">
                    <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1 relative flex items-center">
                            <svg class="w-5 h-5 text-gray-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <input type="text" name="search" placeholder="Job title or keyword..." class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 font-medium transition">
                        </div>
                        
                        <div class="w-full md:w-56 relative flex items-center">
                            <select name="type" class="w-full pl-4 pr-10 py-3.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 font-medium appearance-none cursor-pointer transition">
                                <option value="">Any Job Type</option>
                                @foreach($jobTypes as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                        
                        <div class="w-full md:w-64 relative flex items-center">
                            <select name="qualification" class="w-full pl-4 pr-10 py-3.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 font-medium appearance-none cursor-pointer transition">
                                <option value="">Any Qualification</option>
                                @foreach($qualifications as $qualification)
                                    <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                                @endforeach
                            </select>
                            <svg class="w-4 h-4 text-gray-500 absolute right-4 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>

                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-xl font-bold transition shadow-md shadow-blue-500/20 w-full md:w-auto flex-shrink-0">
                            Search Jobs
                        </button>
                    </form>
                </div>
            </div>
        </div>
        
        <!-- Background decorative elements -->
        <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100 opacity-50 blur-3xl mix-blend-multiply"></div>
        <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-cyan-100 opacity-50 blur-3xl mix-blend-multiply"></div>
    </div>

    <!-- Stats Section -->
    <div class="border-y border-gray-200 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center divide-x divide-gray-100">
                <div>
                    <p class="text-4xl font-extrabold text-gray-900">200+</p>
                    <p class="text-sm font-medium text-gray-500 mt-1 uppercase tracking-wider">Active Jobs</p>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-gray-900">50+</p>
                    <p class="text-sm font-medium text-gray-500 mt-1 uppercase tracking-wider">Top Companies</p>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-gray-900">24/7</p>
                    <p class="text-sm font-medium text-gray-500 mt-1 uppercase tracking-wider">Live Updates</p>
                </div>
                <div>
                    <p class="text-4xl font-extrabold text-gray-900">10k+</p>
                    <p class="text-sm font-medium text-gray-500 mt-1 uppercase tracking-wider">Subscribers</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Jobs Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Latest Opportunities</h2>
                <p class="text-lg text-gray-600">Freshly posted jobs tailored for you.</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="mt-4 md:mt-0 text-blue-600 font-bold hover:text-blue-800 transition flex items-center gap-1 bg-blue-50 px-5 py-2.5 rounded-lg">
                View All Jobs 
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestJobs as $job)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full overflow-hidden group">
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            @if($job->thumbnail)
                                <img src="{{ asset('storage/'.$job->thumbnail) }}" alt="{{ $job->title }}" class="w-16 h-16 rounded-xl object-cover border border-gray-100 shadow-sm">
                            @else
                                <div class="w-16 h-16 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-2xl border border-blue-100 shadow-sm">
                                    {{ substr($job->title, 0, 1) }}
                                </div>
                            @endif
                            
                            <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                New
                            </span>
                        </div>
                        
                        <h3 class="text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-blue-600 transition">
                            <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                        </h3>
                        
                        <p class="text-sm text-gray-500 mb-4 flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Posted {{ $job->created_at->diffForHumans() }}
                        </p>
                        
                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach($job->jobTypes->take(1) as $type)
                                <span class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded text-xs font-semibold">{{ $type->name }}</span>
                            @endforeach
                            @foreach($job->categories->take(1) as $category)
                                <span class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded text-xs font-semibold">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    
                    <div class="p-4 border-t border-gray-50 bg-gray-50/50">
                        <a href="{{ route('jobs.show', $job->slug) }}" class="block w-full text-center text-blue-600 font-bold text-sm hover:text-blue-800 transition">
                            View Details &rarr;
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-gray-200">
                    <p class="text-gray-500 text-lg font-medium">No jobs posted yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Browse By Job Type -->
    <div class="bg-gray-50 py-20 border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-end mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Explore by Category</h2>
                    <p class="text-lg text-gray-600">Find the perfect working arrangement.</p>
                </div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                @foreach($jobTypes->take(8) as $type)
                <a href="{{ route('jobs.index', ['type' => $type->id]) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-blue-500 hover:shadow-md hover:-translate-y-1 transition-all group">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $type->name }}</h3>
                        <p class="text-xs text-gray-500 font-medium mt-0.5">Explore Jobs &rarr;</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Browse By Qualification -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12 max-w-2xl mx-auto">
            <h2 class="text-3xl font-extrabold text-gray-900 mb-4">Jobs by Qualification</h2>
            <p class="text-lg text-gray-600">Find opportunities tailored to your educational background.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach($qualifications->take(15) as $qual)
            <a href="{{ route('jobs.index', ['qualification' => $qual->id]) }}" class="px-5 py-2.5 bg-white border border-gray-200 rounded-lg text-gray-700 font-semibold text-sm hover:bg-gray-900 hover:border-gray-900 hover:text-white transition shadow-sm">
                {{ $qual->name }}
            </a>
            @endforeach
        </div>
        <div class="text-center mt-10">
            <a href="{{ route('jobs.index') }}" class="text-blue-600 font-bold hover:text-blue-800 transition underline decoration-2 underline-offset-4">View All Qualifications</a>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="bg-gray-900 text-white py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight text-white">The Most Trusted Job Portal for Professionals</h2>
                    <p class="text-gray-400 mb-10 text-lg leading-relaxed">Stop wasting time checking dozens of websites. We aggregate the best opportunities directly from official sources and deliver them straight to you.</p>
                    
                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center shrink-0 border border-blue-500/30">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-2 text-white">Instant Notifications</h4>
                                <p class="text-gray-400 leading-relaxed">Be the first to apply. Get real-time updates as soon as an official notification is released anywhere.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center shrink-0 border border-green-500/30">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-2 text-white">100% Verified Listings</h4>
                                <p class="text-gray-400 leading-relaxed">We strictly verify all job openings from official government websites and direct corporate portals to prevent scams.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Professionals working" class="relative rounded-2xl shadow-2xl border border-gray-800">
                    <div class="absolute -bottom-6 -left-6 bg-white text-gray-900 p-6 rounded-2xl shadow-xl border border-gray-100 hidden md:block">
                        <div class="flex items-center gap-4">
                            <div class="flex -space-x-4">
                                <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=1" alt="">
                                <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=2" alt="">
                                <img class="w-10 h-10 rounded-full border-2 border-white" src="https://i.pravatar.cc/100?img=3" alt="">
                            </div>
                            <div>
                                <p class="font-bold">Trusted by 10k+</p>
                                <p class="text-sm text-gray-500">Job seekers daily</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
