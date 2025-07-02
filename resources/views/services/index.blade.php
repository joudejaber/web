@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100">
    <!-- Compact Hero Section -->
<div class="bg-white shadow-sm border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10">
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent mb-3">
                Professional Services
            </h1>
            <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                Transform your space with our expert renovation services. Quality craftsmanship, reliable professionals, exceptional results.
            </p>
        </div>
    </div>
</div>

    <!-- Services Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if($services->isEmpty())
            <div class="text-center py-20">
                <div class="max-w-md mx-auto">
                    <!-- Empty State Icon -->
                    <div class="mx-auto h-24 w-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Services Available</h3>
                    <p class="text-gray-500">We're working on adding new services. Check back soon!</p>
                </div>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-8">
                @foreach($services as $service)
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200 hover:-translate-y-1">
                        <!-- Service Image -->
                        <div class="relative overflow-hidden">
                            <div class="aspect-[4/3] w-full">
                                <img src="{{ asset('storage/' . $service->image) }}" 
                                     alt="{{ $service->name }}" 
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            <!-- Service Type Badge -->
                            <div class="absolute top-4 right-4">
                                <span class="px-3 py-1.5 text-xs font-semibold text-white bg-gradient-to-r from-blue-500 to-blue-600 rounded-full shadow-lg backdrop-blur-sm">
                                    {{ $service->type }}
                                </span>
                            </div>
                            <!-- Overlay Gradient -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Service Content -->
                        <div class="p-6">
                            <div class="mb-4">
                                <h3 class="text-xl font-bold text-gray-900 mb-2 group-hover:text-blue-600 transition-colors">
                                    {{ $service->name }}
                                </h3>
                                
                                <!-- Provider Info -->
                                <div class="flex items-center text-gray-600 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <div class="w-8 h-8 bg-gradient-to-br from-blue-100 to-indigo-100 rounded-full flex items-center justify-center">
                                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <span class="text-sm font-medium">{{ $service->provider->name }}</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex flex-col space-y-3">
                                <!-- View Details Button -->
                                <a href="{{ route('service.show', $service->id) }}" 
                                   class="flex items-center justify-center px-4 py-2.5 text-sm font-medium text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors group/btn">
                                    <span>View Details</span>
                                    <svg class="ml-2 w-4 h-4 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                    </svg>
                                </a>

                                <!-- Book Appointment Button -->
                                <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" 
                                   class="flex items-center justify-center px-4 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 rounded-lg shadow-sm hover:shadow-md transition-all duration-200 transform hover:scale-[1.02]">
                                    <svg class="mr-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    Book Appointment
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection