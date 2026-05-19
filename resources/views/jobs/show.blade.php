@extends('layouts.app')

@section('title', $job->meta_title ?? $job->title)

@section('content')
<div class="bg-slate-50 py-12 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Back Navigation -->
        <div class="mb-8">
            <a href="{{ route('jobs.index') }}" class="inline-flex items-center gap-2 text-sm font-bold text-blue-600 hover:text-blue-700 transition group">
                <svg class="w-4 h-4 transform group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Back to Explore Jobs
            </a>
        </div>

        <!-- Premium Header Banner (Light Mode) -->
        <div class="bg-white rounded-3xl overflow-hidden shadow-sm mb-10 relative border border-gray-200/80">
            <!-- Subtle glow backdrop shapes -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 rounded-full bg-blue-50/40 blur-3xl pointer-events-none"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 rounded-full bg-indigo-50/30 blur-3xl pointer-events-none"></div>

            <div class="px-6 py-10 md:p-12 relative z-10">
                <div class="flex flex-wrap gap-2.5 mb-6">
                    @if($job->categories && count($job->categories) > 0)
                        <span class="bg-blue-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-blue-700 border border-blue-100 flex items-center gap-1.5">
                            🏢 {{ $job->categories->first()->name }}
                        </span>
                    @endif
                    <span class="bg-emerald-50 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider text-emerald-700 border border-emerald-100 flex items-center gap-1.5">
                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                        Active
                    </span>
                </div>
                
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-6 leading-tight max-w-4xl text-slate-900">{{ $job->title }}</h1>
                
                <div class="flex flex-wrap items-center gap-6 text-sm text-slate-500 font-medium pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>Posted: <strong class="text-slate-800 font-bold">{{ $job->created_at->format('d M, Y') }}</strong></span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span>Views: <strong class="text-slate-800 font-bold">{{ number_format($job->views_count) }}</strong></span>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2-Column Content Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Main Content Area (Column 1 - 8 cols) -->
            <div class="lg:col-span-8 space-y-8">
                
                <!-- 1. Job Description & Introduction -->
                @if($job->description)
                    <div class="bg-white p-8 rounded-3xl border border-gray-150 shadow-sm">
                        <h2 class="text-2xl font-extrabold text-slate-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2.5">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Job Description
                        </h2>
                        <div class="prose prose-slate prose-base max-w-none text-slate-600 font-medium leading-relaxed">
                            {!! $job->description !!}
                        </div>
                    </div>
                @endif

                <!-- 2. Job Overview Grid (Highly Premium) -->
                @if($job->overviews && count($job->overviews) > 0)
                    <div class="bg-white p-8 rounded-3xl border border-gray-150 shadow-sm">
                        <h2 class="text-2xl font-extrabold text-slate-900 mb-6 pb-3 border-b border-gray-100 flex items-center gap-2.5">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Job Overview
                        </h2>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach($job->overviews as $item)
                                <div class="bg-slate-50/50 py-6 px-5.5 rounded-2xl border border-gray-150 flex items-center gap-4">
                                    <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                        <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $item['label'] ?? '' }}</span>
                                        <span class="block text-slate-800 font-bold mt-0.5 text-sm md:text-base">{{ $item['value'] ?? '' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 3. Vacancy Details Table -->
                @if($job->Vacancy_Details && count($job->Vacancy_Details) > 0)
                    <div class="bg-white p-8 rounded-3xl border border-gray-150 shadow-sm">
                        <h2 class="text-2xl font-extrabold text-slate-900 mb-6 pb-3 border-b border-gray-100 flex items-center gap-2.5">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Vacancy Details
                        </h2>
                        <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm bg-white">
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200 text-left">
                                    <thead class="bg-slate-50/75">
                                        <tr>
                                            <th class="px-6 py-4 font-bold text-slate-800 uppercase tracking-wider text-xs">Post Name</th>
                                            <th class="px-6 py-4 font-bold text-slate-800 uppercase tracking-wider text-xs">Total Vacancies</th>
                                            <th class="px-6 py-4 font-bold text-slate-800 uppercase tracking-wider text-xs">Minimum Qualification</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-150">
                                        @foreach($job->Vacancy_Details as $detail)
                                            <tr class="hover:bg-slate-50/50 transition">
                                                <td class="px-6 py-6 font-bold text-slate-900 text-sm md:text-base">{{ $detail['post_name'] ?? '' }}</td>
                                                <td class="px-6 py-6">
                                                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">
                                                        {{ $detail['vacancies'] ?? '' }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-6 text-slate-500 font-semibold text-sm">{{ $detail['qualification'] ?? '' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- 4. Eligibility Criteria -->
                @if($job->Eligibility_Criteria)
                    <div class="bg-white p-8 rounded-3xl border border-gray-150 shadow-sm">
                        <h2 class="text-2xl font-extrabold text-slate-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2.5">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Eligibility Criteria
                        </h2>
                        <div class="prose prose-slate prose-base max-w-none text-slate-600 font-medium leading-relaxed">
                            {!! $job->Eligibility_Criteria !!}
                        </div>
                    </div>
                @endif

                <!-- 5. How to Apply Checklist -->
                @if($job->How_to_Apply)
                    <div class="bg-gradient-to-br from-white to-blue-50/20 p-8 rounded-3xl border border-gray-150 shadow-sm relative overflow-hidden">
                        <div class="absolute -right-12 -top-12 w-32 h-32 rounded-full bg-blue-500/5 blur-xl"></div>
                        <h2 class="text-2xl font-extrabold text-slate-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2.5 relative z-10">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            How to Apply
                        </h2>
                        <div class="prose prose-slate prose-base max-w-none text-slate-600 font-medium leading-relaxed relative z-10">
                            {!! $job->How_to_Apply !!}
                        </div>
                    </div>
                @endif

                <!-- 6. FAQs Expandable Accordions -->
                @if($job->FAQs && count($job->FAQs) > 0)
                    <div class="bg-white p-8 rounded-3xl border border-gray-150 shadow-sm">
                        <h2 class="text-2xl font-extrabold text-slate-900 mb-6 pb-3 border-b border-gray-100 flex items-center gap-2.5">
                            <span class="w-1.5 h-6 bg-blue-600 rounded-full"></span>
                            Frequently Asked Questions
                        </h2>
                        <div class="space-y-4">
                            @foreach($job->FAQs as $index => $faq)
                                <details class="faq-details group border border-gray-200 rounded-2xl bg-white transition duration-200 overflow-hidden" name="faq-accordion" {{ $index === 0 ? 'open' : '' }}>
                                    <summary class="flex justify-between items-center font-bold text-slate-800 px-6 py-6 cursor-pointer hover:bg-slate-50 select-none list-none text-sm md:text-base">
                                        <span>{{ $faq['question'] ?? '' }}</span>
                                        <span class="transition-transform duration-300 group-open:rotate-180 text-blue-600 flex-shrink-0 ml-4">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </span>
                                    </summary>
                                    <div class="px-6 pb-6 text-sm md:text-base text-slate-500 font-semibold leading-relaxed border-t border-gray-100 pt-5 bg-slate-50/20">
                                        {{ $faq['answer'] ?? '' }}
                                    </div>
                                </details>
                            @endforeach
                        </div>
                    </div>

                    <script>
                        document.querySelectorAll('details.faq-details').forEach((el) => {
                            const summary = el.querySelector('summary');
                            summary.addEventListener('click', (e) => {
                                if (!el.hasAttribute('open')) {
                                    document.querySelectorAll('details.faq-details').forEach((otherEl) => {
                                        if (otherEl !== el) {
                                            otherEl.removeAttribute('open');
                                        }
                                    });
                                }
                            });
                        });
                    </script>
                @endif

            </div>

            <!-- Sidebar (Column 2 - 4 cols) -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Timeline/Dates Cards -->
                @if($job->Important_Dates && count($job->Important_Dates) > 0)
                    <div class="bg-white p-6 rounded-3xl border border-gray-150 shadow-sm">
                        <h3 class="text-lg font-bold text-slate-900 mb-5 pb-3 border-b border-gray-100 flex items-center gap-2">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            Important Dates
                        </h3>
                        
                        <div class="relative pl-6 border-l border-blue-100 space-y-6">
                            @foreach($job->Important_Dates as $date)
                                <div class="relative">
                                    <!-- Bullet Node -->
                                    <span class="absolute -left-[31px] top-1 w-4.5 h-4.5 rounded-full bg-white border-4 border-blue-600 flex items-center justify-center shadow-sm"></span>
                                    <div>
                                        <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">{{ $date['event'] ?? '' }}</span>
                                        <span class="block text-slate-800 font-bold text-sm mt-0.5">{{ $date['date'] ?? '' }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Call to Actions / Important Links -->
                @if($job->Important_Link && count($job->Important_Link) > 0)
                    <div class="bg-gradient-to-br from-blue-900 to-indigo-950 p-6 rounded-3xl text-white border border-white/5 shadow-xl relative overflow-hidden">
                        <div class="absolute -right-16 -top-16 w-36 h-36 rounded-full bg-blue-500/20 blur-2xl"></div>
                        <h3 class="text-lg font-bold mb-4 flex items-center gap-2 relative z-10">
                            <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                            Important Links
                        </h3>
                        <p class="text-slate-300 text-xs mb-6 font-medium relative z-10 leading-relaxed">
                            Verify criteria and submit your official registration. JobFinder does not process application payments.
                        </p>
                        
                        <div class="space-y-3 relative z-10">
                            @foreach($job->Important_Link as $index => $link)
                                @if(!empty($link['url']) && !empty($link['label']))
                                    <a href="{{ $link['url'] }}" target="_blank" 
                                       class="flex justify-center items-center gap-2 w-full py-3.5 px-4 rounded-xl text-sm font-bold transition-all shadow-md {{ $index === 0 ? 'bg-blue-600 hover:bg-blue-500 text-white shadow-blue-500/20' : 'bg-white/10 hover:bg-white/15 text-white border border-white/10' }}">
                                        {{ $link['label'] }}
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Job Tags Category Cards -->
                <div class="bg-white p-6 rounded-3xl border border-gray-150 shadow-sm space-y-6">
                    <!-- Job Types -->
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Job Schedule Types</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($job->jobTypes as $type)
                                <a href="{{ route('jobs.index', ['type' => $type->id]) }}" 
                                   class="bg-slate-50 border border-gray-200 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-600 hover:border-blue-500 hover:text-blue-600 hover:bg-blue-50/30 transition">
                                    💼 {{ $type->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <!-- Qualifications -->
                    <div>
                        <h4 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Target Qualifications</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($job->qualifications as $qual)
                                <a href="{{ route('jobs.index', ['qualification' => $qual->id]) }}" 
                                   class="bg-slate-50 border border-gray-200 px-3 py-1.5 rounded-lg text-xs font-bold text-slate-600 hover:border-blue-500 hover:text-blue-600 hover:bg-blue-50/30 transition">
                                    🎓 {{ $qual->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>
@endsection
