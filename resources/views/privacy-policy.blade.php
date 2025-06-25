@extends('layout.app')

@section('title', 'Privacy Policy')

@section('content')
<div class="min-h-screen bg-gray-100 py-16">
    <div class="mx-auto max-w-4xl px-6 lg:px-8">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900">Privacy Policy</h1>
        <p class="mt-6 text-lg text-gray-700">
            Your privacy is important to us. This Privacy Policy explains how we collect, use, and protect your information when you use RenovAid.
        </p>

        <h2 class="mt-10 text-2xl font-semibold text-gray-900">Information We Collect</h2>
        <p class="mt-4 text-gray-700">We collect personal information such as name, email, and location to enhance user experience.</p>

        <h2 class="mt-10 text-2xl font-semibold text-gray-900">How We Use Your Information</h2>
        <p class="mt-4 text-gray-700">Your information is used to connect homeowners with service providers, improve services, and ensure a seamless experience.</p>

        <h2 class="mt-10 text-2xl font-semibold text-gray-900">Data Security</h2>
        <p class="mt-4 text-gray-700">We take appropriate security measures to protect your data from unauthorized access.</p>

        <div class="mt-10">
            <a href="/" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Back to Home</a>
        </div>
    </div>
</div>
@endsection
