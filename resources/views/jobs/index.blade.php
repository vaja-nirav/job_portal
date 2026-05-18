@extends('layouts.app')

@section('title', 'Browse All Jobs')

@section('content')
<div class="bg-gray-50 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10 flex flex-col md:flex-row md:items-end justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Browse Job Openings</h1>
                <p class="text-gray-600">Showing {{ $jobs->firstItem() ?? 0 }} to {{ $jobs->lastItem() ?? 0 }} of {{ $jobs->total() }} available jobs.</p>
            </div>
            
            <form action="{{ route('jobs.index') }}" method="GET" class="flex items-center gap-2 max-w-sm w-full">
                <input type="hidden" name="category" value="{{ request('category') }}">
                <input type="hidden" name="type" value="{{ request('type') }}">
                <input type="hidden" name="qualification" value="{{ request('qualification') }}">
                
                <div class="relative flex-grow">
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Refine search..." class="w-full pl-9 pr-3 py-2 bg-white border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm">
                </div>
                <button type="submit" class="bg-gray-900 text-white px-4 py-2 rounded-lg text-sm font-semibold hover:bg-gray-800 transition">Filter</button>
            </form>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($jobs as $job)
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
                                Active
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
                <div class="col-span-full py-20 text-center bg-white rounded-2xl border border-gray-200">
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
    </div>
</div>
@endsection
