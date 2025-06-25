@extends('layout.app')

@section('title', 'About')

@section('content')
<div class="min-h-screen bg-gray-100 py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                About RenovAid
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-700">
                RenovAid is a platform dedicated to simplifying and accelerating post-war reconstruction efforts by connecting homeowners, service providers, and government agencies.
            </p>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-blue-600">Our Mission</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Building a Better Future</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    We aim to make reconstruction more transparent, efficient, and accessible by providing tools for homeowners, service providers, and policymakers.
                </p>
            </div>
            <div class="mt-10 text-center">
                <a href="/" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection
