@extends('layouts.app')

@section('title', $job->meta_title ?? $job->title)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
        <h1 class="text-4xl font-extrabold text-slate-900 mb-4">{{ $job->title }}</h1>
        <div class="flex items-center gap-4 text-sm text-slate-500 mb-8 pb-8 border-b border-slate-100">
            <span>Posted: {{ $job->created_at->format('d M, Y') }}</span>
            <span>&bull;</span>
            <span>Views: {{ $job->views_count }}</span>
        </div>

        @if($job->description)
            <div class="prose prose-indigo max-w-none mb-12">
                {!! $job->description !!}
            </div>
        @endif

        @if($job->Important_Dates && count($job->Important_Dates) > 0)
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Important Dates</h2>
            <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden mb-12">
                <table class="min-w-full divide-y divide-slate-200">
                    <tbody class="divide-y divide-slate-200">
                        @foreach($job->Important_Dates as $date)
                        <tr>
                            <td class="px-6 py-4 font-medium text-slate-900">{{ $date['event'] ?? '' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $date['date'] ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

        @if($job->Vacancy_Details && count($job->Vacancy_Details) > 0)
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Vacancy Details</h2>
            <div class="bg-slate-50 rounded-xl border border-slate-200 overflow-hidden mb-12">
                <table class="min-w-full divide-y divide-slate-200 text-left">
                    <thead class="bg-slate-100">
                        <tr>
                            <th class="px-6 py-3 font-semibold text-slate-900">Post Name</th>
                            <th class="px-6 py-3 font-semibold text-slate-900">Vacancies</th>
                            <th class="px-6 py-3 font-semibold text-slate-900">Qualification</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white">
                        @foreach($job->Vacancy_Details as $detail)
                        <tr>
                            <td class="px-6 py-4 text-slate-900">{{ $detail['post_name'] ?? '' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $detail['vacancies'] ?? '' }}</td>
                            <td class="px-6 py-4 text-slate-600">{{ $detail['qualification'] ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        
        @if($job->Eligibility_Criteria)
            <h2 class="text-2xl font-bold text-slate-900 mb-4">Eligibility Criteria</h2>
            <div class="prose prose-indigo max-w-none mb-12">
                {!! $job->Eligibility_Criteria !!}
            </div>
        @endif

        @if($job->How_to_Apply)
            <h2 class="text-2xl font-bold text-slate-900 mb-4">How to Apply</h2>
            <div class="prose prose-indigo max-w-none mb-12">
                {!! $job->How_to_Apply !!}
            </div>
        @endif
    </div>
</div>
@endsection
