@extends('layout.app')

@section('title', 'Learn More')

@section('content')
<div class="relative min-h-screen bg-gray-100 py-16">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <div class="max-w-2xl mx-auto text-center">
            <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">
                Learn More About RenovAid
            </h1>
            <p class="mt-6 text-lg leading-8 text-gray-700">
                RenovAid is designed to streamline post-war reconstruction efforts by connecting homeowners, service providers, and government agencies.
            </p>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-blue-600">Rebuild Better</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Why Choose RenovAid?</p>
                <p class="mt-6 text-lg leading-8 text-gray-600">We provide a comprehensive platform for managing your reconstruction project from start to finish.</p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900">
                            Document Damages
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Easily document and catalog damage to your property with our intuitive tools.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900">
                            Find Services
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Connect with qualified service providers and get the help you need.</p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="text-base font-semibold leading-7 text-gray-900">
                            Track Progress
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">Monitor your reconstruction projects and stay updated on their progress.</p>
                        </dd>
                    </div>
                </dl>
            </div>
            <div class="mt-10 text-center">
                <a href="/" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-blue-500">Back to Home</a>
            </div>
        </div>
    </div>
</div>
@endsection