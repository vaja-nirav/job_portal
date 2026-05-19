@extends('layouts.app')

@section('title', 'Browse All Jobs - JobFinder')

@section('content')
    <!-- Sleek Minimalist Hero Section -->
    <div class="bg-gradient-to-b from-blue-50 to-white pt-20 pb-12 relative z-10">
        <!-- Background decorative elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100/50 opacity-40 blur-3xl mix-blend-multiply"></div>
            <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-cyan-100/50 opacity-40 blur-3xl mix-blend-multiply"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-3xl mx-auto">
                <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100/80 text-blue-700 font-semibold text-sm mb-6 border border-blue-200 shadow-sm">
                    <span class="relative flex h-3 w-3">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                    </span>
                    Explore All Live Vacancies
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 tracking-tight mb-4 leading-tight">
                    Browse All <span class="text-blue-600">Opportunities</span>
                </h1>
                <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                    Discover and apply to the newest jobs, customized for your skills, qualifications, and career aspirations.
                </p>
                
                <!-- Clean Minimal Search Input (No Dropdowns) -->
                <div class="bg-white p-3 rounded-2xl shadow-xl shadow-blue-900/5 border border-gray-100 max-w-2xl mx-auto mt-6">
                    <form action="{{ route('jobs.index') }}" method="GET" id="search-bar-form" class="flex gap-2">
                        <!-- Keep selected filters active when search bar is submitted -->
                        @if(request('type'))
                            @foreach((is_array(request('type')) ? request('type') : explode(',', request('type'))) as $tId)
                                <input type="hidden" name="type[]" value="{{ $tId }}">
                            @endforeach
                        @endif
                        @if(request('qualification') && request('qualification') !== 'all')
                            @foreach((is_array(request('qualification')) ? request('qualification') : explode(',', request('qualification'))) as $qId)
                                <input type="hidden" name="qualification[]" value="{{ $qId }}">
                            @endforeach
                        @endif
                        @if(request('category'))
                            @foreach((is_array(request('category')) ? request('category') : explode(',', request('category'))) as $cId)
                                <input type="hidden" name="category[]" value="{{ $cId }}">
                            @endforeach
                        @endif

                        <div class="flex-1 relative flex items-center">
                            <svg class="w-5 h-5 text-gray-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by job title or keyword..."
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

    <!-- Main Content Workspace: Left Sidebar Filters & Right Job Grid -->
    <div class="bg-gray-50/50 py-12 border-t border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8 items-start">
                
                <!-- 1. LEFT SIDEBAR FILTERS (Naukri style) -->
                <aside class="w-full lg:w-1/4 bg-white border border-gray-200/75 rounded-2xl p-6 shadow-sm sticky top-24 self-start max-h-[85vh] overflow-y-auto custom-scrollbar">
                    <form action="{{ route('jobs.index') }}" method="GET" id="sidebar-filters-form" class="space-y-6">
                        <!-- Keep search bar text active when filters are modified -->
                        @if(request('search'))
                            <input type="hidden" name="search" value="{{ request('search') }}">
                        @endif

                        <div class="flex items-center justify-between border-b border-gray-100 pb-4">
                            <h3 class="text-lg font-bold text-gray-900">Filters</h3>
                            @if(request()->anyFilled(['search', 'type', 'qualification', 'category']))
                                <a href="{{ route('jobs.index') }}" class="text-xs font-bold text-red-600 hover:text-red-800 transition uppercase tracking-wider">
                                    Clear All
                                </a>
                            @endif
                        </div>

                        <!-- Filter Group 1: Job Types -->
                        <div x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="flex items-center justify-between w-full font-bold text-sm text-gray-800 hover:text-blue-600 transition uppercase tracking-wide">
                                <span>Job Type</span>
                                <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="mt-3.5 space-y-2.5 max-h-44 overflow-y-auto custom-scrollbar pr-1">
                                @foreach($jobTypes as $type)
                                    @php
                                        $typeChecked = false;
                                        if(request()->has('type')) {
                                            $reqType = request('type');
                                            $typeChecked = is_array($reqType) ? in_array($type->id, $reqType) : in_array($type->id, explode(',', $reqType));
                                        }
                                    @endphp
                                    <label class="flex items-center gap-2.5 text-sm text-gray-600 hover:text-gray-900 cursor-pointer group">
                                        <input type="checkbox" name="type[]" value="{{ $type->id }}" onchange="this.form.submit()" 
                                            class="w-4.5 h-4.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500/20 focus:ring-offset-0 transition cursor-pointer"
                                            {{ $typeChecked ? 'checked' : '' }}>
                                        <span class="font-medium group-hover:text-gray-900 transition">{{ $type->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter Group 2: Qualifications -->
                        <div x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="flex items-center justify-between w-full font-bold text-sm text-gray-800 hover:text-blue-600 transition uppercase tracking-wide">
                                <span>Qualifications</span>
                                <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="mt-3.5 space-y-2.5 max-h-44 overflow-y-auto custom-scrollbar pr-1">
                                @foreach($qualifications as $qual)
                                    @php
                                        $qualChecked = false;
                                        if(request()->has('qualification') && request('qualification') !== 'all') {
                                            $reqQual = request('qualification');
                                            $qualChecked = is_array($reqQual) ? in_array($qual->id, $reqQual) : in_array($qual->id, explode(',', $reqQual));
                                        }
                                    @endphp
                                    <label class="flex items-center gap-2.5 text-sm text-gray-600 hover:text-gray-900 cursor-pointer group">
                                        <input type="checkbox" name="qualification[]" value="{{ $qual->id }}" onchange="this.form.submit()"
                                            class="w-4.5 h-4.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500/20 focus:ring-offset-0 transition cursor-pointer"
                                            {{ $qualChecked ? 'checked' : '' }}>
                                        <span class="font-medium group-hover:text-gray-900 transition">{{ $qual->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Filter Group 3: Categories -->
                        <div x-data="{ open: true }">
                            <button type="button" @click="open = !open" class="flex items-center justify-between w-full font-bold text-sm text-gray-800 hover:text-blue-600 transition uppercase tracking-wide">
                                <span>Categories</span>
                                <svg class="w-4 h-4 text-gray-500 transition-transform duration-200" :class="open ? '' : 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="open" x-collapse class="mt-3.5 space-y-2.5 max-h-44 overflow-y-auto custom-scrollbar pr-1">
                                @foreach($categories as $cat)
                                    @php
                                        $catChecked = false;
                                        if(request()->has('category')) {
                                            $reqCat = request('category');
                                            $catChecked = is_array($reqCat) ? in_array($cat->id, $reqCat) : in_array($cat->id, explode(',', $reqCat)) || (request('category') === $cat->name);
                                        }
                                    @endphp
                                    <label class="flex items-center gap-2.5 text-sm text-gray-600 hover:text-gray-900 cursor-pointer group">
                                        <input type="checkbox" name="category[]" value="{{ $cat->id }}" onchange="this.form.submit()"
                                            class="w-4.5 h-4.5 rounded border-gray-300 text-blue-600 focus:ring-blue-500/20 focus:ring-offset-0 transition cursor-pointer"
                                            {{ $catChecked ? 'checked' : '' }}>
                                        <span class="font-medium group-hover:text-gray-900 transition">{{ $cat->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                    </form>
                </aside>

                <!-- 2. RIGHT MAIN SECTION: JOB LISTINGS -->
                <main class="w-full lg:w-3/4">
                    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4 border-b border-gray-200/60 pb-5">
                        <div>
                            <h2 class="text-2xl font-extrabold text-slate-900 mb-1">All Jobs Listing</h2>
                            <p class="text-sm text-gray-500 font-medium">Showing {{ $jobs->firstItem() ?? 0 }} to {{ $jobs->lastItem() ?? 0 }} of {{ $jobs->total() }} available jobs.</p>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse($jobs as $job)
                            <div class="bg-white rounded-2xl p-6 border border-gray-150/80 hover:border-blue-500 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6 group shadow-sm">
                                <div class="flex items-center gap-5">
                                    @if($job->thumbnail)
                                        <img src="{{ asset('storage/'.$job->thumbnail) }}" alt="{{ $job->title }}" class="w-14 h-14 rounded-xl object-cover border border-gray-100 shadow-sm flex-shrink-0">
                                    @else
                                        <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl shadow-inner group-hover:from-blue-600 group-hover:to-indigo-600 group-hover:text-white transition-all duration-300 flex-shrink-0">
                                            {{ substr($job->title, 0, 1) }}
                                        </div>
                                    @endif
                                    <div>
                                        <span class="text-xs font-bold text-blue-600 tracking-wider uppercase">Active Posting</span>
                                        <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition leading-snug mt-0.5">
                                            <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                        </h3>
                                        <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1.5 text-sm text-gray-500 font-medium">
                                            <span class="flex items-center gap-1">
                                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                Posted {{ $job->created_at->diffForHumans() }}
                                            </span>
                                            @if($job->qualifications->isNotEmpty())
                                                <span class="flex items-center gap-1">
                                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5z"></path>
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"></path>
                                                    </svg>
                                                    {{ $job->qualifications->first()->name }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="flex flex-wrap md:flex-nowrap items-center gap-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        @foreach($job->jobTypes->take(2) as $type)
                                            <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-xs font-bold border border-gray-200/50">{{ $type->name }}</span>
                                        @endforeach
                                        @foreach($job->categories->take(2) as $category)
                                            <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-bold border border-blue-100/50">{{ $category->name }}</span>
                                        @endforeach
                                    </div>
                                    <a href="{{ route('jobs.show', $job->slug) }}" class="bg-white border border-gray-200 text-gray-700 font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-gray-900 hover:border-gray-900 hover:text-white transition shadow-sm w-full md:w-auto text-center shrink-0">
                                        View details
                                    </a>
                                </div>
                            </div>
                        @empty
                            <div class="py-20 text-center bg-white rounded-2xl border border-gray-200">
                                <svg class="mx-auto h-12 w-12 text-gray-300 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">No jobs found</h3>
                                <p class="text-gray-500">We couldn't find anything matching your criteria. Try adjusting your filters.</p>
                                <a href="{{ route('jobs.index') }}" class="mt-4 inline-block bg-blue-50 text-blue-600 font-semibold px-4 py-2 rounded-lg hover:bg-blue-100 transition">Clear Filters</a>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-12">
                        {{ $jobs->withQueryString()->links() }}
                    </div>
                </main>
                
            </div>
        </div>
    </div>
@endsection
