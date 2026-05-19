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
                Contact Support
            </div>
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 leading-tight">
                Let's Start a <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-indigo-300">Conversation</span>
            </h1>
            <p class="text-lg text-slate-300 max-w-2xl mx-auto leading-relaxed font-medium">
                Have questions or need assistance finding a career option? Our dedicated support team is available to assist you.
            </p>
        </div>
    </div>

    <!-- Contact Panels -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-24">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
            <!-- Left Info Panel (md:col-span-5) -->
            <div class="lg:col-span-5 space-y-8">
                <div>
                    <span class="text-blue-600 font-extrabold text-sm uppercase tracking-widest block mb-2">Support Channels</span>
                    <h2 class="text-3xl font-extrabold text-slate-900 leading-tight">We are always ready to help you.</h2>
                    <p class="text-slate-500 mt-3 leading-relaxed font-medium">
                        Fill out our contact form or reach out through our official lines. We typically respond within 24 hours.
                    </p>
                </div>

                <div class="space-y-6">
                    <!-- Card 1 -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Email Address</span>
                            <span class="block text-slate-800 font-bold mt-1 text-sm md:text-base">support@jobfinder.com</span>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="bg-white p-6 rounded-2xl border border-gray-150 shadow-sm flex items-start gap-4">
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center flex-shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold text-slate-400 uppercase tracking-wider">Our Headquarters</span>
                            <span class="block text-slate-800 font-bold mt-1 text-sm md:text-base">100 Innovation Way, Tech District, Suite 500</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Contact Form Card (md:col-span-7) -->
            <div class="lg:col-span-7">
                <div class="bg-white p-8 md:p-10 rounded-3xl border border-gray-150 shadow-xl shadow-slate-900/5">
                    <h3 class="text-2xl font-extrabold text-slate-900 mb-6">Send Us a Message</h3>

                    <!-- Display Alert Messages -->
                    @if(session('success'))
                        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 font-semibold text-sm flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Your Name</label>
                                <input type="text" name="name" id="name" required placeholder="John Doe"
                                    class="w-full px-4 py-3 bg-slate-50/50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-900 font-medium transition text-sm">
                            </div>
                            <div>
                                <label for="email" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Your Email</label>
                                <input type="email" name="email" id="email" required placeholder="john@example.com"
                                    class="w-full px-4 py-3 bg-slate-50/50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-900 font-medium transition text-sm">
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Subject</label>
                            <input type="text" name="subject" id="subject" required placeholder="How can we help you?"
                                class="w-full px-4 py-3 bg-slate-50/50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-900 font-medium transition text-sm">
                        </div>

                        <div>
                            <label for="message" class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Message</label>
                            <textarea name="message" id="message" rows="5" required placeholder="Type your message here..."
                                class="w-full px-4 py-3 bg-slate-50/50 border border-gray-200 rounded-xl focus:bg-white focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 text-slate-900 font-medium transition text-sm"></textarea>
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-xl transition shadow-lg shadow-blue-500/20 text-sm">
                            Send Message
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
