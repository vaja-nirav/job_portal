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
                Portal <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Disclaimer</span>
            </h1>
            <p class="text-sm text-slate-300 max-w-xl mx-auto leading-relaxed font-medium">
                Last updated: {{ date('F d, Y') }}. Please read this disclaimer regarding informational accuracy and external links.
            </p>
        </div>
    </div>

    <!-- Legal text content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 pb-24">
        <div class="bg-white rounded-3xl p-8 md:p-12 border border-gray-150 shadow-sm space-y-8 text-slate-600 font-medium leading-relaxed text-sm md:text-base">
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">1. General Information Only</h2>
                <p>
                    All information, job listings, and qualification criteria provided on JobFinder are for general informational purposes only. While we endeavor to keep the content accurate and current, we make no representations or warranties of any kind, express or implied, about the completeness, accuracy, reliability, suitability, or availability of the information listed.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">2. No Professional Advice</h2>
                <p>
                    The information contained on our portal does not constitute legal, professional, or employment advice. Any reliance you place on the information displayed is strictly at your own risk. Before applying for a position, you should verify all requirements, deadlines, and criteria directly with the hiring organisation.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">3. External Links Disclaimer</h2>
                <p>
                    Through our portal, you are able to link to other websites which are not under the control of JobFinder. We have no control over the nature, content, and availability of those sites. The inclusion of any outbound links does not necessarily imply a recommendation or endorsement of the views expressed within them.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">4. Verify Before Paying</h2>
                <p class="text-amber-700 font-semibold bg-amber-50 border border-amber-200 p-4 rounded-xl">
                    🚨 IMPORTANT SECURITY ADVICE: JobFinder never charges job seekers any fees for job search or application. If any third-party recruiting agency or individual contacts you demanding payment or personal bank details in connection with our listings, please reject it immediately and report it to our support channels.
                </p>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <p class="text-xs text-slate-400">
                    If you have questions regarding this Portal Disclaimer, feel free to contact us at support@jobfinder.com.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
