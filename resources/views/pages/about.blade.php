@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <!-- Hero Banner with elegant glowing gradient -->
    <div class="relative bg-gradient-to-br from-blue-900 via-indigo-950 to-slate-900 text-white overflow-hidden py-24 mb-16 shadow-lg">
        <!-- Glow effects backdrop -->
        <div class="absolute top-0 right-0 -mt-24 -mr-24 w-96 h-96 rounded-full bg-blue-500/25 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-24 -ml-24 w-96 h-96 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <div class="inline-flex items-center gap-2 px-4.5 py-2 rounded-full bg-blue-500/10 border border-blue-400/20 text-blue-300 font-semibold text-xs tracking-wider uppercase mb-6 shadow-inner">
                <span class="w-2 h-2 rounded-full bg-blue-400 animate-pulse"></span>
                About Our Platform
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Empowering Careers, <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Connecting Futures</span>
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed font-medium">
                We are building the future of recruitment, making career search fast, precise, and premium for global job seekers.
            </p>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <!-- Grid Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center mb-20">
            <div>
                <span class="text-blue-600 font-extrabold text-sm uppercase tracking-widest block mb-2">Our Mission</span>
                <h2 class="text-3xl font-extrabold text-slate-900 mb-6 leading-tight">
                    Making opportunities visible and accessible to everyone.
                </h2>
                <div class="space-y-4 text-slate-600 leading-relaxed font-medium text-base">
                    <p>
                        At JobFinder, we believe that the search for a new career should be inspiring, not exhausting. We bridge the gap between talented professionals, elite enterprises, and highly coveted government sectors.
                    </p>
                    <p>
                        By providing intuitive search, clean categorized listings, and robust application flows, we empower job seekers to make their next career move with ultimate confidence.
                    </p>
                </div>
            </div>

            <!-- Visual statistics layout card -->
            <div class="bg-gradient-to-br from-blue-500/5 to-indigo-500/5 border border-blue-100 rounded-3xl p-8 md:p-10 shadow-sm relative overflow-hidden flex flex-col justify-center">
                <div class="absolute -right-16 -top-16 w-48 h-48 rounded-full bg-blue-500/10 blur-2xl"></div>
                <div class="grid grid-cols-2 gap-8 text-center relative z-10">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="block text-4xl font-extrabold text-blue-600 mb-2">200+</span>
                        <span class="text-sm font-bold text-slate-600">Daily Openings</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="block text-4xl font-extrabold text-blue-600 mb-2">50+</span>
                        <span class="text-sm font-bold text-slate-600">Recruiter Partners</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="block text-4xl font-extrabold text-blue-600 mb-2">12+</span>
                        <span class="text-sm font-bold text-slate-600">Qualifications</span>
                    </div>
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
                        <span class="block text-4xl font-extrabold text-blue-600 mb-2">10k+</span>
                        <span class="text-sm font-bold text-slate-600">Active Users</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Core Values Section -->
        <div>
            <div class="text-center max-w-3xl mx-auto mb-16">
                <span class="text-blue-600 font-extrabold text-sm uppercase tracking-widest block mb-2">Platform Core Values</span>
                <h2 class="text-3xl font-extrabold text-slate-900">What Drives Us Every Single Day</h2>
                <p class="text-slate-500 mt-3 font-medium">We design with intention and build with extreme quality to ensure you find excellence.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Value 1 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-150 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Absolute Trust</h3>
                    <p class="text-slate-500 leading-relaxed text-sm font-medium">
                        Every single job posting, qualification category, and employer profile is verified to ensure completely legitimate, secure opportunities.
                    </p>
                </div>

                <!-- Value 2 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-150 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Uncompromising Speed</h3>
                    <p class="text-slate-500 leading-relaxed text-sm font-medium">
                        Recruitment waits for no one. Our state of the art server filters load and return precise matching categories and results in microseconds.
                    </p>
                </div>

                <!-- Value 3 -->
                <div class="bg-white p-8 rounded-2xl border border-gray-150 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
                    <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:text-white transition duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-3">Equal Opportunity</h3>
                    <p class="text-slate-500 leading-relaxed text-sm font-medium">
                        Whether you possess a high school diploma, specialized qualification, or professional degree, our filter matches you equally to your dream career.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
