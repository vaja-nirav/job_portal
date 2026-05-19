@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <div class="bg-gradient-to-b from-blue-50 to-white pt-32 pb-24 relative z-10">
        <!-- Background decorative elements container -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none z-0">
            <div
                class="absolute top-0 right-0 -mr-20 -mt-20 w-96 h-96 rounded-full bg-blue-100 opacity-50 blur-3xl mix-blend-multiply">
            </div>
            <div
                class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 rounded-full bg-cyan-100 opacity-50 blur-3xl mix-blend-multiply">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center max-w-4xl mx-auto">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 font-semibold text-sm mb-6 border border-blue-200">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-600"></span>
                    </span>
                    Over 200+ New Jobs Added Today
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    Find Your Next <span class="text-blue-600">Opportunity</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10">
                    Discover thousands of job opportunities across government and private sectors. Your dream career starts
                    right here.
                </p>

                <!-- Search Box -->
                <div class="bg-white p-4 rounded-2xl shadow-xl shadow-blue-900/5 border border-gray-100 w-6xl mx-auto">
                    <form action="{{ route('jobs.index') }}" method="GET" class="flex flex-col md:flex-row gap-3">
                        <div class="flex-1 relative flex items-center">
                            <svg class="w-5 h-5 text-gray-400 absolute left-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            <input type="text" name="search" placeholder="Job title..."
                                class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-900 font-medium transition">
                        </div>

                        <div x-data="{ open: false, selected: '{{ request('type') }}', selectedName: 'Any Job Type', search: '' }" x-init="@foreach ($jobTypes as $type)
                                    if(selected == '{{ $type->id }}') selectedName = '{{ addslashes($type->name) }}'; @endforeach
                        $watch('open', value => {
                            if (value) {
                                search = '';
                                setTimeout(() => $refs.searchInput.focus(), 100);
                            }
                        })"
                            class="w-full md:w-56 relative flex items-center">
                            <input type="hidden" name="type" x-model="selected">
                            <button type="button" @click="open = !open" @click.away="open = false"
                                class="w-full pl-4 pr-10 py-3.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 font-medium appearance-none cursor-pointer transition text-left flex justify-between items-center"
                                :class="open ? 'bg-white ring-2 ring-blue-500' : ''">
                                <span x-text="selectedName" class="truncate block"></span>
                                <svg class="w-4 h-4 text-gray-500 absolute right-4 pointer-events-none transition-transform duration-200"
                                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <div x-show="open" x-transition:enter="transition ease-out duration-100"
                                x-transition:enter-start="transform opacity-0 scale-95"
                                x-transition:enter-end="transform opacity-100 scale-100"
                                x-transition:leave="transition ease-in duration-75"
                                x-transition:leave-start="transform opacity-100 scale-100"
                                x-transition:leave-end="transform opacity-0 scale-95"
                                class="absolute z-[100] top-[calc(100%+0.5rem)] left-0 w-full bg-white border border-gray-100 rounded-xl shadow-2xl shadow-blue-900/10 max-h-60 overflow-y-auto custom-scrollbar text-left"
                                style="display: none;">
                                <div class="p-2 sticky top-0 bg-white border-b border-gray-50 z-10">
                                    <div class="relative">
                                        <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <input type="text" x-model="search" x-ref="searchInput" placeholder="Search..."
                                            class="w-full pl-9 pr-3 py-2 bg-gray-50 border border-gray-200 rounded-lg focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm text-gray-700 transition"
                                            @keydown.enter.prevent="">
                                    </div>
                                </div>
                                <div class="py-1">
                                    <div x-show="'Any Job Type'.toLowerCase().includes(search.toLowerCase())"
                                        @click="selected = ''; selectedName = 'Any Job Type'; open = false"
                                        class="px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 cursor-pointer text-gray-700 text-sm font-medium transition-colors"
                                        :class="{ 'bg-blue-50 text-blue-700': selected === '' }">
                                        Any Job Type
                                    </div>
                                    @foreach ($jobTypes as $type)
                                        <div x-show="'{{ addslashes($type->name) }}'.toLowerCase().includes(search.toLowerCase())"
                                            @click="selected = '{{ $type->id }}'; selectedName = '{{ addslashes($type->name) }}'; open = false"
                                            class="px-4 py-2.5 hover:bg-blue-50 hover:text-blue-700 cursor-pointer text-gray-700 text-sm font-medium transition-colors"
                                            :class="{ 'bg-blue-50 text-blue-700': selected === '{{ $type->id }}' }">
                                            {{ $type->name }}
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div x-data="{ 
                            openModal: false, 
                            selectedQualifications: [],
                            search: '',
                            get selectedName() {
                                if (this.selectedQualifications.length === 0) return 'Any Qualification';
                                if (this.selectedQualifications.length === 1) {
                                    let name = '';
                                    @foreach($qualifications as $q)
                                        if (this.selectedQualifications.includes('{{ $q->id }}')) name = '{{ addslashes($q->name) }}';
                                    @endforeach
                                    return name || 'Any Qualification';
                                }
                                return 'Selected (' + this.selectedQualifications.length + ')';
                            }
                        }" x-init="
                            let reqVal = '{{ request('qualification') }}';
                            if (reqVal) {
                                selectedQualifications = reqVal.split(',').filter(x => x);
                            }
                        "
                            class="w-full md:w-64 relative flex items-center">
                            <input type="hidden" name="qualification" :value="selectedQualifications.join(',')">
                            <button type="button" @click="openModal = true"
                                class="w-full pl-4 pr-10 py-3.5 bg-gray-50 border-transparent rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent text-gray-700 font-medium appearance-none cursor-pointer transition text-left flex justify-between items-center"
                                :class="openModal ? 'bg-white ring-2 ring-blue-500' : ''">
                                <span x-text="selectedName" class="truncate block"></span>
                                <svg class="w-4 h-4 text-gray-500 absolute right-4 pointer-events-none transition-transform duration-200"
                                    :class="openModal ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>

                            <!-- The Modal Component -->
                            <div x-show="openModal" 
                                 class="fixed inset-0 z-[9999] overflow-y-auto" 
                                 style="display: none;"
                                 @keydown.escape.window="openModal = false">
                                
                                <!-- Backdrop -->
                                <div x-show="openModal" 
                                     x-transition:enter="transition ease-out duration-300"
                                     x-transition:enter-start="opacity-0"
                                     x-transition:enter-end="opacity-100"
                                     x-transition:leave="transition ease-in duration-200"
                                     x-transition:leave-start="opacity-100"
                                     x-transition:leave-end="opacity-0"
                                     class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                                     @click="openModal = false"></div>

                                <!-- Modal Content Wrapper -->
                                <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                                    <div x-show="openModal"
                                         x-transition:enter="transition ease-out duration-300"
                                         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                         x-transition:leave="transition ease-in duration-200"
                                         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                         class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg flex flex-col max-h-[85vh] border border-gray-100">
                                         
                                        <!-- Header -->
                                        <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white z-10">
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-900">Select Qualifications</h3>
                                                <p class="text-sm text-gray-500 mt-1">Select one or multiple qualifications to filter jobs</p>
                                            </div>
                                            <button type="button" @click="openModal = false" class="text-gray-400 hover:text-gray-600 transition-colors p-1.5 hover:bg-gray-100 rounded-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Search input inside modal -->
                                        <div class="p-4 border-b border-gray-100 bg-gray-50/50 sticky top-[73px] bg-white z-10">
                                            <div class="relative">
                                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                                <input type="text" x-model="search" placeholder="Type to filter qualifications..." 
                                                    class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm text-gray-700 transition">
                                            </div>
                                        </div>

                                        <!-- Body / Qualifications list with checkboxes -->
                                        <div class="flex-grow overflow-y-auto p-6 max-h-[50vh] custom-scrollbar space-y-3">
                                            @foreach ($qualifications as $qualification)
                                                <label x-show="'{{ addslashes($qualification->name) }}'.toLowerCase().includes(search.toLowerCase())"
                                                    class="flex items-center gap-3.5 px-4 py-3 bg-gray-50 border border-gray-200/60 rounded-xl cursor-pointer hover:bg-blue-50/40 hover:border-blue-200 transition group select-none">
                                                    <div class="relative flex items-center">
                                                        <input type="checkbox" value="{{ $qualification->id }}" x-model="selectedQualifications"
                                                            class="peer w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500/30 focus:ring-offset-0 transition cursor-pointer">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <span class="text-sm font-semibold text-gray-700 group-hover:text-gray-900 transition">{{ $qualification->name }}</span>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>

                                        <!-- Footer / Action Buttons -->
                                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between sticky bottom-0 z-10">
                                            <button type="button" @click="selectedQualifications = []" 
                                                class="text-xs font-bold text-gray-500 hover:text-red-600 transition-colors uppercase tracking-wider">
                                                Clear All
                                            </button>
                                            <div class="flex gap-2">
                                                <button type="button" @click="openModal = false" 
                                                    class="px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg text-sm font-bold hover:bg-gray-50 transition">
                                                    Cancel
                                                </button>
                                                <button type="button" @click="openModal = false" 
                                                    class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-bold transition shadow-sm">
                                                    Apply
                                                </button>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3.5 rounded-xl font-bold transition shadow-md shadow-blue-500/20 w-full md:w-auto flex-shrink-0">
                            Search Jobs
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Background decorative elements moved to top -->
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
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-36">
        <div class="flex flex-col md:flex-row justify-between items-end mb-12">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Latest Jobs</h2>
                <p class="text-lg text-gray-600">Freshly posted jobs tailored for you.</p>
            </div>
            <a href="{{ route('jobs.index') }}"
                class="mt-4 md:mt-0 text-blue-600 font-bold hover:text-blue-800 transition flex items-center gap-1 bg-blue-50 px-5 py-2.5 rounded-lg">
                View All Jobs
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3">
                    </path>
                </svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($latestJobs as $job)
                <div
                    class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col h-full overflow-hidden group">
                    <div class="p-6 flex-grow">
                        <div class="flex justify-between items-start mb-4">
                            @if ($job->thumbnail)
                                <img src="{{ asset('storage/' . $job->thumbnail) }}" alt="{{ $job->title }}"
                                    class="w-16 h-16 rounded-xl object-cover border border-gray-100 shadow-sm">
                            @else
                                <div
                                    class="w-16 h-16 rounded-xl bg-blue-50 flex items-center justify-center text-blue-600 font-bold text-2xl border border-blue-100 shadow-sm">
                                    {{ substr($job->title, 0, 1) }}
                                </div>
                            @endif

                            <span
                                class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-bold border border-green-100">
                                New
                            </span>
                        </div>

                        <h3
                            class="text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-blue-600 transition">
                            <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                        </h3>

                        <p class="text-sm text-gray-500 mb-4 flex items-center gap-1.5 font-medium">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Posted {{ $job->created_at->diffForHumans() }}
                        </p>

                        <div class="flex flex-wrap gap-2 mb-2">
                            @foreach ($job->jobTypes->take(1) as $type)
                                <span
                                    class="bg-gray-100 text-gray-700 px-2.5 py-1 rounded text-xs font-semibold">{{ $type->name }}</span>
                            @endforeach
                            @foreach ($job->categories->take(1) as $category)
                                <span
                                    class="bg-blue-50 text-blue-700 px-2.5 py-1 rounded text-xs font-semibold">{{ $category->name }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="p-4 border-t border-gray-50 bg-gray-50/50">
                        <a href="{{ route('jobs.show', $job->slug) }}"
                            class="block w-full text-center text-blue-600 font-bold text-sm hover:text-blue-800 transition">
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

    <!-- Find Jobs By Type -->
    <div class="bg-gray-50 py-20 border-y border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4 md:gap-0">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Find Jobs By Type</h2>
                    <p class="text-lg text-gray-600">Find the perfect working arrangement.</p>
                </div>
                @if (count($jobTypes) > 8)
                    <a href="{{ route('jobs.index') }}"
                        class="mt-4 md:mt-0 text-blue-600 font-bold hover:text-blue-800 transition flex items-center gap-1 bg-blue-50 px-5 py-2.5 rounded-lg">
                        View All Job Types
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                        </svg>
                    </a>
                @endif
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-4 gap-6">
                @foreach ($jobTypes->take(8) as $type)
                    <a href="{{ route('jobs.index', ['type' => $type->id]) }}"
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-blue-500 hover:shadow-md hover:-translate-y-1 transition-all group">
                        <div
                            class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-900 group-hover:text-blue-600 transition">{{ $type->name }}
                            </h3>
                            <p class="text-xs text-gray-500 font-medium mt-0.5">Explore Jobs &rarr;</p>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Browse By Qualification -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-4 md:gap-0">
            <div>
                <h2 class="text-3xl font-extrabold text-gray-900 mb-2">Find Jobs By Qualifications</h2>
                <p class="text-lg text-gray-600">Find opportunities tailored to your educational background.</p>
            </div>
            <a href="{{ route('jobs.index') }}" 
                class="mt-4 md:mt-0 text-blue-600 font-bold hover:text-blue-800 transition flex items-center gap-1 bg-blue-50 px-5 py-2.5 rounded-lg self-start md:self-auto">
                View All Qualifications
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                </svg>
            </a>
        </div>
        <div class="flex flex-wrap justify-center gap-3">
            @foreach ($qualifications->take(15) as $qual)
                <a href="{{ route('jobs.index', ['qualification' => $qual->id]) }}"
                    class="px-5 py-2.5 bg-white border border-gray-200 rounded-lg text-gray-700 font-semibold text-sm hover:bg-gray-900 hover:border-gray-900 hover:text-white transition shadow-sm">
                    {{ $qual->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- All Opening Jobs Section -->
    <div class="bg-gray-50/70 py-24 border-t border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-4 md:gap-0">
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 mb-2">All Opening Jobs</h2>
                    <p class="text-lg text-gray-600">Explore all active career opportunities currently available on our platform.</p>
                </div>
                <a href="{{ route('jobs.index') }}"
                    class="mt-4 md:mt-0 text-blue-600 font-bold hover:text-blue-800 transition flex items-center gap-1 bg-blue-50 px-5 py-2.5 rounded-lg self-start md:self-auto shadow-sm">
                    View All Openings
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>

            <div class="space-y-4">
                @forelse($allOpeningJobs as $job)
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 hover:border-blue-500 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 flex flex-col md:flex-row md:items-center justify-between gap-6 group shadow-sm">
                        <div class="flex items-center gap-5">
                            @if ($job->thumbnail)
                                <img src="{{ asset('storage/' . $job->thumbnail) }}" alt="{{ $job->title }}"
                                    class="w-14 h-14 rounded-xl object-cover border border-gray-100">
                            @else
                                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-50 to-indigo-50 border border-blue-100 text-blue-600 flex items-center justify-center font-bold text-xl shadow-inner group-hover:from-blue-600 group-hover:to-indigo-600 group-hover:text-white transition-all duration-300">
                                    {{ substr($job->title, 0, 1) }}
                                </div>
                            @endif
                            <div>
                                <span class="text-xs font-bold text-blue-600 tracking-wider uppercase">Active Posting</span>
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition leading-snug mt-0.5">
                                    <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                                </h3>
                                <div class="flex flex-wrap items-center gap-x-4 gap-y-1 mt-1 text-sm text-gray-500 font-medium">
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
                                @foreach ($job->jobTypes->take(2) as $type)
                                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-xs font-bold border border-gray-200/50">{{ $type->name }}</span>
                                @endforeach
                                @foreach ($job->categories->take(2) as $category)
                                    <span class="bg-blue-50 text-blue-700 px-3 py-1 rounded-lg text-xs font-bold border border-blue-100/50">{{ $category->name }}</span>
                                @endforeach
                            </div>
                            <a href="{{ route('jobs.show', $job->slug) }}"
                                class="bg-white border border-gray-200 text-gray-700 font-bold text-sm px-5 py-2.5 rounded-xl hover:bg-gray-900 hover:border-gray-900 hover:text-white transition shadow-sm w-full md:w-auto text-center shrink-0">
                                View details
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-16 bg-white rounded-2xl border border-gray-100">
                        <p class="text-gray-500 text-lg font-medium">No open jobs found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="bg-gray-900 text-white py-24 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div>
                    <h2 class="text-4xl font-extrabold mb-6 leading-tight text-white">Why we? - The Most Trusted Job Portal for Professionals</h2>
                    <p class="text-gray-400 mb-10 text-lg leading-relaxed">Stop wasting time checking dozens of websites.
                        We aggregate the best opportunities directly from official sources and deliver them straight to you.
                    </p>

                    <div class="space-y-8">
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 bg-blue-500/20 rounded-xl flex items-center justify-center shrink-0 border border-blue-500/30">
                                <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-2 text-white">Instant Notifications</h4>
                                <p class="text-gray-400 leading-relaxed">Be the first to apply. Get real-time updates as
                                    soon as an official notification is released anywhere.</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div
                                class="w-12 h-12 bg-green-500/20 rounded-xl flex items-center justify-center shrink-0 border border-green-500/30">
                                <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                    </path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-bold text-xl mb-2 text-white">100% Verified Listings</h4>
                                <p class="text-gray-400 leading-relaxed">We strictly verify all job openings from official
                                    government websites and direct corporate portals to prevent scams.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1573164713988-8665fc963095?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80"
                        alt="Professionals working" class="relative rounded-2xl shadow-2xl border border-gray-800">
                    <div
                        class="absolute -bottom-6 -left-6 bg-white text-gray-900 p-6 rounded-2xl shadow-xl border border-gray-100 hidden md:block">
                        <div class="flex items-center gap-4">
                            <div class="flex -space-x-4">
                                <img class="w-10 h-10 rounded-full border-2 border-white"
                                    src="https://i.pravatar.cc/100?img=1" alt="">
                                <img class="w-10 h-10 rounded-full border-2 border-white"
                                    src="https://i.pravatar.cc/100?img=2" alt="">
                                <img class="w-10 h-10 rounded-full border-2 border-white"
                                    src="https://i.pravatar.cc/100?img=3" alt="">
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
