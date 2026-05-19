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
                Privacy <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Policy</span>
            </h1>
            <p class="text-sm text-slate-300 max-w-xl mx-auto leading-relaxed font-medium">
                Last updated: {{ date('F d, Y') }}. Learn how we gather, protect, and handle your personal data.
            </p>
        </div>
    </div>

    <!-- Legal text content -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 pb-24">
        <div class="bg-white rounded-3xl p-8 md:p-12 border border-gray-150 shadow-sm space-y-8 text-slate-600 font-medium leading-relaxed text-sm md:text-base">
            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">1. Information We Collect</h2>
                <p class="mb-3">
                    We collect personal information that you voluntarily provide to us when you subscribe to our newsletter, search for job postings, or get in touch through our contact form.
                </p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>Personal Details: Name, email address, phone number, and physical addresses.</li>
                    <li>Technical Information: Browser information, IP address, and cookie logs.</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">2. How We Use Your Information</h2>
                <p class="mb-3">
                    We use the information we collect to improve your search experience, answer support queries, and notify you of newly available postings.
                </p>
                <ul class="list-disc pl-5 space-y-2">
                    <li>To personalize your user experience on our portal.</li>
                    <li>To administer newsletter subscriptions and alerts.</li>
                    <li>To maintain safe and secure database operations.</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">3. Data Protection and Security</h2>
                <p>
                    We deploy cutting-edge technical security measures to maintain the safety of your personal information. All communications between your browser and our servers are encrypted using high-grade Secure Socket Layer (SSL) protocols.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-extrabold text-slate-900 mb-3">4. Third-Party Links</h2>
                <p>
                    Our portal contains outbound links to external websites (such as official government or enterprise registration forms). We have no responsibility or liability for the content and actions of these external domains.
                </p>
            </div>

            <div class="border-t border-gray-100 pt-6">
                <p class="text-xs text-slate-400">
                    If you have questions regarding this Privacy Policy, feel free to contact us at support@jobfinder.com.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
