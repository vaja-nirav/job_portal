@extends('layouts.app')

@section('content')
<div class="bg-slate-50 min-h-screen">
    <!-- Hero Banner with elegant glowing gradient -->
    <div class="relative bg-gradient-to-br from-blue-900 via-indigo-950 to-slate-900 text-white overflow-hidden py-20 mb-16 shadow-lg">
        <!-- Glow effects backdrop -->
        <div class="absolute top-0 right-0 -mt-24 -mr-24 w-96 h-96 rounded-full bg-blue-500/25 blur-3xl pointer-events-none"></div>
        <div class="absolute bottom-0 left-0 -mb-24 -ml-24 w-96 h-96 rounded-full bg-indigo-500/20 blur-3xl pointer-events-none"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-3xl md:text-4xl font-extrabold tracking-tight mb-3 leading-tight">
                Terms & <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Conditions</span>
            </h1>
            <p class="text-sm text-slate-300 max-w-xl mx-auto leading-relaxed font-medium">
                Last updated: {{ date('F d, Y') }}. Please read these terms carefully before exploring our career options.
            </p>
        </div>
    </div>

    <!-- Legal text content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 pb-24">
        <div class="bg-white rounded-3xl p-8 md:p-12 border border-gray-150 shadow-sm space-y-8 text-slate-600 font-medium leading-relaxed text-sm md:text-base">
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">1. Agreement to Terms</h2>
                <p>
                    By accessing or using our job portal, you represent that you have read, understood, and agree to be bound by these Terms & Conditions. If you do not agree to all of these terms, you must immediately discontinue your use of our services.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">2. User Conduct and Responsibilities</h2>
                <p class="mb-3">
                    As a user of our portal, you agree to use our platform only for legitimate career exploration purposes. You are strictly prohibited from:
                </p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Providing false or misleading information in any application or registration form.</li>
                    <li>Attempting to compromise the security, infrastructure, or databases of our system.</li>
                    <li>Scraping, automated data extraction, or copying job listings for commercial resale.</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">3. Job Posting Accuracy</h2>
                <p>
                    While we make every effort to display up-to-date and accurate job listings, JobFinder does not guarantee the availability, accuracy, or authenticity of any position posted. It is the user's sole responsibility to verify the terms of employment directly with the respective recruiting body or enterprise.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">4. Limitation of Liability</h2>
                <p>
                    Under no circumstances shall JobFinder, its directors, employees, or developers be liable for any direct, indirect, incidental, or consequential damages resulting from your use of, or inability to use, our recruitment portal or search features.
                </p>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <p class="text-xs text-slate-400">
                    If you have questions regarding these Terms & Conditions, feel free to contact us at support@jobfinder.com.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
