@extends('layout.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-4">
                Privacy Policy
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Your privacy is important to us. Here's how we handle your information.
            </p>
        </div>

        <!-- Policy Content -->
        <div class="bg-white rounded-3xl shadow-xl p-8 lg:p-10">
            <!-- Section 1 -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    Information We Collect
                </h2>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    We collect personal information such as name, email address, contact details, and property information to provide and improve our services. This helps us connect homeowners with qualified service providers and ensure a seamless experience.
                </p>
            </div>

            <!-- Section 2 -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    How We Use Your Information
                </h2>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    Your information is used to facilitate connections between homeowners and service providers, personalize your experience, improve our services, and communicate important updates. We never sell your personal data to third parties.
                </p>
            </div>

            <!-- Section 3 -->
            <div class="mb-10">
                <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-3 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                    </svg>
                    Data Security
                </h2>
                <p class="mt-4 text-gray-700 leading-relaxed">
                    We implement industry-standard security measures including encryption, secure servers, and regular audits to protect your data from unauthorized access. Our team is trained in data protection best practices to ensure your information remains safe.
                </p>
            </div>

            <!-- Back Button -->
            <div class="mt-12 text-center">
                <a href="/" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-medium rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all transform hover:scale-105">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>
</div>
@endsection