@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Back Navigation -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-8">
        <a href="{{ route('services.index') }}" 
           class="inline-flex items-center text-blue-600 hover:text-blue-700 font-medium transition-colors group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
            </svg>
            Back to Services
        </a>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Hero Image Section -->
            <div class="relative h-80 md:h-96 overflow-hidden bg-gray-100">
                <img src="{{ asset('storage/' . $service->image) }}" 
                     alt="{{ $service->name }}" 
                     class="w-full h-full object-contain">
                <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                
                <!-- Service Badge -->
                <div class="absolute top-6 right-6">
                    <span class="px-4 py-2 text-sm font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-full shadow-lg backdrop-blur-sm">
                        {{ $service->type }}
                    </span>
                </div>

                <!-- Service Title Overlay -->
                <div class="absolute bottom-6 left-6 right-6">
                    <h1 class="text-3xl md:text-4xl font-bold text-white mb-2">{{ $service->name }}</h1>
                    <p class="text-blue-100 text-lg">Professional {{ $service->type }} Service</p>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 p-8">
                <!-- Left Column - Service Details -->
                <div class="space-y-8">
                    <!-- Provider Info Card -->
                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border border-blue-100">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center shadow-lg">
                                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $service->user->name }}</h3>
                                <p class="text-blue-600 font-semibold mb-2">{{ $service->user->provider->shop_name ?? 'Professional Service Provider' }}</p>
                                <div class="flex items-center text-gray-600">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <span class="text-sm">{{ $service->user->provider->location ?? 'Location available upon booking' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Service Details -->
                    <div class="space-y-6">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Service Details</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                        </svg>
                                        <span class="font-semibold text-gray-900">Service Name</span>
                                    </div>
                                    <p class="text-gray-700">{{ $service->name }}</p>
                                </div>
                                <div class="bg-gray-50 rounded-xl p-4">
                                    <div class="flex items-center mb-2">
                                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                        </svg>
                                        <span class="font-semibold text-gray-900">Service Type</span>
                                    </div>
                                    <p class="text-gray-700">{{ $service->type }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- About the Provider -->
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">About the Provider</h3>
                            <div class="bg-gray-50 rounded-xl p-6">
                                <p class="text-gray-700 leading-relaxed">
                                    {{ $service->user->provider->description ?? 'This professional service provider is committed to delivering high-quality renovation services. With years of experience in the industry, they ensure exceptional craftsmanship and customer satisfaction on every project.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column - Booking Section -->
                <div class="lg:pl-8">
                    <div class="sticky top-8">
                        <!-- Booking Card -->
                        <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-2xl p-8 text-white shadow-2xl">
                            <div class="text-center mb-6">
                                <h3 class="text-2xl font-bold mb-2">Ready to Transform Your Space?</h3>
                                <p class="text-blue-100">Book your appointment today and get started on your renovation project.</p>
                            </div>

                            <!-- Features List -->
                            <div class="space-y-3 mb-8">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-300 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">Professional consultation</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-300 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">Quality materials & workmanship</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-300 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">Flexible scheduling</span>
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-green-300 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="text-sm">Satisfaction guaranteed</span>
                                </div>
                            </div>

                            <!-- Book Appointment Button -->
                            <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}"
                               class="block w-full text-center bg-white text-blue-600 font-bold py-4 px-6 rounded-xl hover:bg-gray-50 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                <div class="flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Book Appointment Now
                                </div>
                            </a>

                            <!-- Contact Info -->
                            <div class="mt-6 pt-6 border-t border-blue-500 text-center">
                                <p class="text-blue-100 text-sm">Need help? Contact us directly</p>
                                <div class="flex items-center justify-center mt-2">
                                    <svg class="w-4 h-4 text-blue-200 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    <span class="text-blue-200 text-sm">Available 24/7</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection