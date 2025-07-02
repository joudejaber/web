@extends('layout.app')

@section('title', 'Provider Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-2">
                Provider Details
            </h1>
            <p class="text-lg text-gray-600">
                Detailed information about this service provider
            </p>
        </div>

        <!-- Content Card -->
        <div class="bg-white rounded-3xl shadow-xl">
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100 rounded-t-3xl">
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ $provider->user->name }} <span class="text-gray-600">(ID: {{ $provider->id }})</span>
                </h2>
            </div>

            <div class="p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Email</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $provider->user->email }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Shop Name</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $provider->shop_name ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Location</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $provider->location ?? 'N/A' }}</p>
                    </div>
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">Contact Info</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $provider->contact_info ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="mb-6">
                    <h3 class="text-sm font-medium text-gray-500">Description</h3>
                    <p class="mt-1 text-sm text-gray-900">{{ $provider->description ?? 'N/A' }}</p>
                </div>

                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Services Offered</h3>
                    @if($provider->user->services->isEmpty())
                        <div class="bg-gray-50 rounded-lg p-4 text-center">
                            <p class="text-gray-500">No services available</p>
                        </div>
                    @else
                        <div class="space-y-3">
                            @foreach($provider->user->services as $service)
                                <div class="bg-blue-50 rounded-lg p-4">
                                    <h4 class="font-medium text-blue-800">{{ $service->name }}</h4>
                                    <p class="text-sm text-blue-600">{{ $service->type }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="mt-8">
                    <a href="{{ route('providers.index') }}" 
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Back to Providers
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection