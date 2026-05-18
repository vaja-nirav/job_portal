@extends('layouts.app')

@section('title', 'All Jobs')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h1 class="text-3xl font-bold text-slate-900 mb-8">All Job Openings</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @forelse($jobs as $job)
            <a href="{{ route('jobs.show', $job->slug) }}" class="group block bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 overflow-hidden transform hover:-translate-y-1">
                <div class="p-6">
                    <h3 class="text-lg font-bold text-slate-900 group-hover:text-indigo-600 transition">{{ $job->title }}</h3>
                    <p class="text-sm text-slate-500 mt-2">{{ $job->created_at->format('d M, Y') }}</p>
                </div>
            </a>
        @empty
            <p>No jobs found.</p>
        @endforelse
    </div>
    <div class="mt-8">
        {{ $jobs->links() }}
    </div>
</div>
@endsection
