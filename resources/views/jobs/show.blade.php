@extends('layouts.app')

@section('title', $job->meta_title ?? $job->title)

@section('content')
<div class="bg-gray-50 py-12 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 text-blue-600 font-semibold hover:text-blue-800 transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Back to Jobs
            </a>
        </div>

        <div class="bg-white rounded-3xl shadow-lg border border-gray-100 overflow-hidden">
            <!-- Header section -->
            <div class="bg-blue-900 px-8 py-10 text-white relative overflow-hidden">
                <div class="relative z-10">
                    <div class="flex flex-wrap gap-2 mb-4">
                        @if($job->categories && count($job->categories) > 0)
                            <span class="bg-white/20 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-white border border-white/30">
                                {{ $job->categories->first()->name }}
                            </span>
                        @endif
                        <span class="bg-green-500/20 backdrop-blur-md px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider text-green-300 border border-green-500/30">
                            Active
                        </span>
                    </div>
                    
                    <h1 class="text-3xl md:text-5xl font-extrabold mb-4 leading-tight">{{ $job->title }}</h1>
                    
                    <div class="flex flex-wrap items-center gap-6 text-sm text-blue-200 font-medium">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            Posted {{ $job->created_at->format('d M, Y') }}
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            {{ number_format($job->views_count) }} Views
                        </div>
                    </div>
                </div>
                <!-- Decorative pattern -->
                <div class="absolute top-0 right-0 -mt-10 -mr-10 opacity-10">
                    <svg width="404" height="404" fill="none" viewBox="0 0 404 404"><defs><pattern id="85737c0e-0916-41d7-917f-596dc7edfa27" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse"><rect x="0" y="0" width="4" height="4" fill="currentColor"></rect></pattern></defs><rect width="404" height="404" fill="url(#85737c0e-0916-41d7-917f-596dc7edfa27)"></rect></svg>
                </div>
            </div>

            <div class="p-8">
                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-10 pb-8 border-b border-gray-100">
                    @foreach($job->jobTypes as $type)
                        <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold border border-gray-200">
                            💼 {{ $type->name }}
                        </span>
                    @endforeach
                    @foreach($job->qualifications as $qual)
                        <span class="bg-blue-50 text-blue-700 px-4 py-2 rounded-lg text-sm font-bold border border-blue-100">
                            🎓 {{ $qual->name }}
                        </span>
                    @endforeach
                </div>

                @if($job->description)
                    <div class="prose prose-blue prose-lg max-w-none mb-12 text-gray-700">
                        {!! $job->description !!}
                    </div>
                @endif

                @if($job->Important_Dates && count($job->Important_Dates) > 0)
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </span>
                            Important Dates
                        </h2>
                        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200">
                                <tbody class="divide-y divide-gray-200">
                                    @foreach($job->Important_Dates as $date)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-bold text-gray-900 w-1/2">{{ $date['event'] ?? '' }}</td>
                                        <td class="px-6 py-4 text-gray-600 w-1/2">{{ $date['date'] ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif

                @if($job->Vacancy_Details && count($job->Vacancy_Details) > 0)
                    <div class="mb-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </span>
                            Vacancy Details
                        </h2>
                        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
                            <table class="min-w-full divide-y divide-gray-200 text-left">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-4 font-bold text-gray-900 uppercase tracking-wider text-xs">Post Name</th>
                                        <th class="px-6 py-4 font-bold text-gray-900 uppercase tracking-wider text-xs">Vacancies</th>
                                        <th class="px-6 py-4 font-bold text-gray-900 uppercase tracking-wider text-xs">Qualification</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($job->Vacancy_Details as $detail)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 font-bold text-gray-900">{{ $detail['post_name'] ?? '' }}</td>
                                        <td class="px-6 py-4 text-blue-600 font-bold">{{ $detail['vacancies'] ?? '' }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $detail['qualification'] ?? '' }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-12">
                    @if($job->Eligibility_Criteria)
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </span>
                                Eligibility
                            </h2>
                            <div class="prose prose-blue text-gray-700">
                                {!! $job->Eligibility_Criteria !!}
                            </div>
                        </div>
                    @endif

                    @if($job->How_to_Apply)
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                </span>
                                How to Apply
                            </h2>
                            <div class="prose prose-blue text-gray-700 bg-gray-50 p-6 rounded-2xl border border-gray-200">
                                {!! $job->How_to_Apply !!}
                            </div>
                        </div>
                    @endif
                </div>

                @if($job->Important_Link && count($job->Important_Link) > 0)
                    <div class="mt-12 pt-10 border-t border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Important Links</h2>
                        <div class="flex flex-col sm:flex-row flex-wrap justify-center gap-4">
                            @foreach($job->Important_Link as $link)
                                @if(!empty($link['url']) && !empty($link['label']))
                                    <a href="{{ $link['url'] }}" target="_blank" class="inline-flex justify-center items-center gap-2 bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-xl transition shadow-lg shadow-blue-500/30">
                                        {{ $link['label'] }}
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
