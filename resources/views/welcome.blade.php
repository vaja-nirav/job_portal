@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-slate-900 text-white pt-24 pb-32 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-indigo-900/50 to-slate-900/50"></div>
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/cubes.png')] opacity-20"></div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <span class="px-4 py-1.5 rounded-full bg-indigo-500/20 text-indigo-300 text-sm font-semibold tracking-wide uppercase mb-6 inline-block border border-indigo-500/30">Your Future Awaits</span>
            <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-8 leading-tight">Find Your <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400">Dream Job</span> Today</h1>
            <p class="text-xl text-slate-300 mb-12 max-w-2xl mx-auto">Get the latest notifications for Government, IT, and Private sector jobs straight to your screen.</p>
            
            <form action="{{ route('jobs.index') }}" method="GET" class="max-w-4xl mx-auto bg-white/10 backdrop-blur-md p-3 rounded-2xl shadow-2xl flex flex-col md:flex-row gap-3 border border-white/20">
                <div class="flex-1 relative">
                    <input type="text" name="search" placeholder="Job title, keyword or company..." class="w-full pl-12 pr-4 py-4 text-slate-900 bg-white border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-inner">
                    <svg class="w-6 h-6 text-slate-400 absolute left-4 top-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                
                <select name="type" class="w-full md:w-48 px-4 py-4 text-slate-900 bg-white border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-inner cursor-pointer">
                    <option value="">Job Type</option>
                    @foreach($jobTypes as $type)
                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                    @endforeach
                </select>
                
                <select name="qualification" class="w-full md:w-48 px-4 py-4 text-slate-900 bg-white border-0 rounded-xl focus:ring-2 focus:ring-indigo-500 shadow-inner cursor-pointer">
                    <option value="">Qualification</option>
                    @foreach($qualifications as $qualification)
                        <option value="{{ $qualification->id }}">{{ $qualification->name }}</option>
                    @endforeach
                </select>

                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white px-8 py-4 rounded-xl font-bold text-lg transition duration-300 shadow-lg shadow-indigo-500/30 w-full md:w-auto">Search</button>
            </form>
        </div>
        
        <!-- Decorative blobs -->
        <div class="absolute top-0 left-0 w-72 h-72 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
    </div>

    <!-- Latest Jobs Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col md:flex-row justify-between items-end mb-10">
            <div>
                <h2 class="text-3xl font-bold text-slate-900 mb-2">Latest Job Openings</h2>
                <p class="text-slate-500">Discover the most recent opportunities added to our portal.</p>
            </div>
            <a href="{{ route('jobs.index') }}" class="mt-4 md:mt-0 text-indigo-600 font-bold hover:text-indigo-800 transition flex items-center gap-1 group">
                View All Jobs 
                <svg class="w-4 h-4 transform group-hover:translate-x-1 transition" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestJobs as $job)
                <a href="{{ route('jobs.show', $job->slug) }}" class="group block bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 overflow-hidden transform hover:-translate-y-1 relative">
                    <div class="p-6">
                        <div class="flex items-start gap-4 mb-5">
                            @if($job->thumbnail)
                                <img src="{{ asset('storage/'.$job->thumbnail) }}" alt="{{ $job->title }}" class="w-14 h-14 rounded-xl object-cover shadow-sm">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-indigo-100 to-indigo-50 flex items-center justify-center text-indigo-600 font-bold text-xl shadow-sm border border-indigo-100">
                                    {{ substr($job->title, 0, 1) }}
                                </div>
                            @endif
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition leading-tight mb-1">{{ $job->title }}</h3>
                                <p class="text-xs text-slate-500 flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $job->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2">
                            @foreach($job->jobTypes->take(1) as $type)
                                <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-md text-xs font-semibold">{{ $type->name }}</span>
                            @endforeach
                            @foreach($job->qualifications->take(1) as $qual)
                                <span class="bg-emerald-50 text-emerald-700 px-3 py-1 rounded-md text-xs font-semibold">{{ $qual->name }}</span>
                            @endforeach
                            @foreach($job->categories->take(1) as $category)
                                <span class="bg-slate-100 text-slate-700 px-3 py-1 rounded-md text-xs font-semibold">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>
                    <div class="absolute bottom-0 left-0 w-full h-1 bg-gradient-to-r from-indigo-500 to-cyan-500 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left duration-300"></div>
                </a>
            @empty
                <div class="col-span-full text-center py-16 bg-slate-50 rounded-2xl border-2 border-dashed border-slate-200">
                    <svg class="mx-auto h-12 w-12 text-slate-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-slate-500 text-lg font-medium">No jobs posted yet.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Browse By Job Type -->
    <div class="bg-slate-50 py-20 border-y border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-slate-900 mb-4">Explore by Job Type</h2>
                <p class="text-slate-500 max-w-2xl mx-auto">Find the perfect working arrangement that suits your lifestyle.</p>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($jobTypes->take(8) as $type)
                <a href="{{ route('jobs.index', ['type' => $type->id]) }}" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 text-center hover:border-indigo-500 hover:shadow-md transition group">
                    <div class="w-12 h-12 mx-auto bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center mb-4 group-hover:bg-indigo-600 group-hover:text-white transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="font-bold text-slate-900 group-hover:text-indigo-600 transition">{{ $type->name }}</h3>
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Browse By Qualification -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-slate-900 mb-4">Jobs by Qualification</h2>
            <p class="text-slate-500 max-w-2xl mx-auto">Search opportunities based on your educational background.</p>
        </div>
        <div class="flex flex-wrap justify-center gap-4">
            @foreach($qualifications->take(15) as $qual)
            <a href="{{ route('jobs.index', ['qualification' => $qual->id]) }}" class="px-6 py-3 bg-white border border-slate-200 rounded-full text-slate-700 font-medium hover:bg-indigo-50 hover:border-indigo-200 hover:text-indigo-700 transition shadow-sm">
                {{ $qual->name }}
            </a>
            @endforeach
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="bg-indigo-900 text-white py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <span class="text-indigo-400 font-bold uppercase tracking-wider text-sm">Why Choose Us?</span>
                    <h2 class="text-4xl font-extrabold mt-4 mb-6 leading-tight">Your Trusted Portal for Reliable Job Updates</h2>
                    <p class="text-indigo-200 mb-8 text-lg">We provide lightning-fast updates on government and private sector jobs, ensuring you never miss a deadline.</p>
                    
                    <ul class="space-y-6">
                        <li class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">Instant Notifications</h4>
                                <p class="text-indigo-200 text-sm">Get real-time updates as soon as an official notification is released.</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-4">
                            <div class="w-12 h-12 bg-white/10 rounded-xl flex items-center justify-center shrink-0">
                                <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-1">100% Verified Information</h4>
                                <p class="text-indigo-200 text-sm">We strictly verify all job openings from official government websites and direct company portals.</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="relative">
                    <div class="absolute inset-0 bg-gradient-to-tr from-indigo-500 to-cyan-400 rounded-3xl transform rotate-3 scale-105 opacity-50 blur-lg"></div>
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Team working" class="relative rounded-3xl shadow-2xl border-4 border-indigo-800/50">
                </div>
            </div>
        </div>
    </div>
@endsection
