@extends('layouts.app')

@section('title', 'Latest Jobs - JobFinder')

@section('content')
    <!-- 1. Hero Section with Search (Same Premium Homepage Backdrop & Form) -->
    <div class="bg-gradient-to-b from-blue-50 to-white pt-24 pb-16 relative z-10">
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
                    Fresh Openings Added Today
                </div>
                <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 tracking-tight mb-6 leading-tight">
                    Find the Latest <span class="text-blue-600">Opportunities</span>
                </h1>
                <p class="text-xl text-gray-600 mb-10">
                    Be the first to apply to newly released vacancies from top corporations and government divisions.
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

                        <!-- Job Type Dropdown Search -->
                        <div x-data="{ open: false, selected: '', selectedName: 'Any Job Type', search: '' }" x-init="$watch('open', value => {
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

                        <!-- Qualification Multi-Select Modal -->
                        <div x-data="{
                            openModal: false,
                            selectedQualifications: [],
                            search: '',
                            get selectedName() {
                                if (this.selectedQualifications.length === 0) return 'Any Qualification';
                                if (this.selectedQualifications.length === 1) {
                                    let name = '';
                                    @foreach ($qualifications as $q)
                                        if (this.selectedQualifications.includes('{{ $q->id }}')) name = '{{ addslashes($q->name) }}'; @endforeach
                                    return name || 'Any Qualification';
                                }
                                return 'Selected (' + this.selectedQualifications.length + ')';
                            }
                        }" class="w-full md:w-64 relative flex items-center">
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
                            <div x-show="openModal" class="fixed inset-0 z-[9999] overflow-y-auto" style="display: none;"
                                @keydown.escape.window="openModal = false">

                                <!-- Backdrop -->
                                <div x-show="openModal" x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                    x-transition:leave="transition ease-in duration-200"
                                    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                                    class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity"
                                    @click="openModal = false"></div>

                                <!-- Modal Content Wrapper -->
                                <div class="flex min-h-screen items-center justify-center p-4 text-center sm:p-0">
                                    <div x-show="openModal" x-transition:enter="transition ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="transition ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="relative transform overflow-hidden rounded-2xl bg-white text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-lg flex flex-col max-h-[85vh] border border-gray-100">

                                        <!-- Header -->
                                        <div
                                            class="px-6 py-5 border-b border-gray-100 flex items-center justify-between sticky top-0 bg-white z-10">
                                            <div>
                                                <h3 class="text-xl font-bold text-gray-900">Select Qualifications</h3>
                                                <p class="text-sm text-gray-500 mt-1">Select qualifications to filter jobs
                                                </p>
                                            </div>
                                            <button type="button" @click="openModal = false"
                                                class="text-gray-400 hover:text-gray-600 transition-colors p-1.5 hover:bg-gray-100 rounded-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                            </button>
                                        </div>

                                        <!-- Search input inside modal -->
                                        <div
                                            class="p-4 border-b border-gray-100 bg-gray-50/50 sticky top-[73px] bg-white z-10">
                                            <div class="relative">
                                                <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                                </svg>
                                                <input type="text" x-model="search" placeholder="Type to filter..."
                                                    class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm text-gray-700 transition">
                                            </div>
                                        </div>

                                        <!-- Body / Qualifications list with checkboxes -->
                                        <div class="flex-grow overflow-y-auto p-6 max-h-[50vh] custom-scrollbar space-y-3">
                                            @foreach ($qualifications as $qualification)
                                                <label
                                                    x-show="'{{ addslashes($qualification->name) }}'.toLowerCase().includes(search.toLowerCase())"
                                                    class="flex items-center gap-3.5 px-4 py-3 bg-gray-50 border border-gray-200/60 rounded-xl cursor-pointer hover:bg-blue-50/40 hover:border-blue-200 transition group select-none">
                                                    <div class="relative flex items-center">
                                                        <input type="checkbox" value="{{ $qualification->id }}"
                                                            x-model="selectedQualifications"
                                                            class="peer w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500/30 focus:ring-offset-0 transition cursor-pointer">
                                                    </div>
                                                    <div class="flex-grow">
                                                        <span
                                                            class="text-sm font-semibold text-gray-700 group-hover:text-gray-900 transition">{{ $qualification->name }}</span>
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>

                                        <!-- Footer -->
                                        <div
                                            class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between sticky bottom-0 z-10">
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
    </div>

    <!-- 2. Latest Jobs Section -->
    <div class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="mb-10 text-center md:text-left">
                <h2 class="text-3xl font-extrabold text-gray-900">Latest Jobs</h2>
                <p class="text-gray-600 mt-2">Discover recently published career openings across various domains.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($latestJobs as $job)
                    <div
                        class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-150 flex flex-col h-full overflow-hidden group">
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
                                    class="bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-bold border border-blue-100 flex items-center gap-1">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-600 animate-pulse"></span>
                                    New
                                </span>
                            </div>

                            <h3
                                class="text-xl font-bold text-gray-900 mb-2 leading-tight group-hover:text-blue-600 transition">
                                <a href="{{ route('jobs.show', $job->slug) }}">{{ $job->title }}</a>
                            </h3>

                            <p class="text-sm text-gray-500 mb-4 flex items-center gap-1.5 font-medium">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
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
                    <div class="col-span-full py-16 text-center bg-white rounded-2xl border border-gray-200">
                        <p class="text-gray-500">No recent jobs found. Check back later!</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- 3. Find Jobs By Type Section -->
    <div class="bg-white py-16 border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900">Find Jobs By Type</h2>
                    <p class="text-slate-500 mt-2 text-sm md:text-base">Find the perfect working arrangement.</p>
                </div>
                <a href="{{ route('categories.index') }}" 
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-blue-50 text-blue-700 font-bold text-sm rounded-xl hover:bg-blue-100 transition shadow-sm border border-blue-100/50">
                    View All Job Types &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($jobTypes->take(8) as $type)
                    <a href="{{ route('jobs.index', ['type' => $type->id]) }}"
                        class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 hover:border-blue-500 hover:shadow-md hover:-translate-y-1 transition-all group">
                        <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
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

    <!-- 4. Find Jobs By Qualifications Section -->
    <div class="bg-gray-50/50 py-16 border-t border-gray-200/50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-10">
                <div>
                    <h2 class="text-3xl font-extrabold text-slate-900">Find Jobs By Qualifications</h2>
                    <p class="text-slate-500 mt-2 text-sm md:text-base">Find opportunities tailored to your educational background.</p>
                </div>
                <a href="{{ route('qualifications.index') }}" 
                   class="inline-flex items-center gap-1.5 px-5 py-2.5 bg-blue-50 text-blue-700 font-bold text-sm rounded-xl hover:bg-blue-100 transition shadow-sm border border-blue-100/50">
                    View All Qualifications &rarr;
                </a>
            </div>

            <div class="flex flex-wrap gap-3.5">
                @foreach($qualifications->take(20) as $qual)
                    <a href="{{ route('jobs.index', ['qualification' => $qual->id]) }}" 
                       class="bg-white border border-gray-200 px-5 py-2.5 rounded-lg text-sm font-medium text-slate-700 hover:border-blue-500 hover:text-blue-600 hover:shadow-md transition duration-200">
                        {{ $qual->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
@endsection
