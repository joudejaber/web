@extends('layout.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-100 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-3xl shadow-xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-gray-50 to-blue-50 px-8 py-6 border-b border-gray-100">
                <h1 class="text-3xl font-bold text-gray-900">Damage Details</h1>
                <p class="text-gray-600 mt-1">Appointment #{{ $appointment->id }}</p>
            </div>

            <div class="p-8">
                @if($damages->count() > 0)
                    <div class="space-y-6">
                        @foreach($damages as $damage)
                            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-200 hover:shadow-md transition-shadow">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-semibold text-gray-900 mb-2">{{ $damage->name }}</h3>
                                        <div class="space-y-2">
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500">Description</h4>
                                                <p class="text-gray-700">{{ $damage->description }}</p>
                                            </div>
                                            <div>
                                                <h4 class="text-sm font-medium text-gray-500">Reported On</h4>
                                                <p class="text-gray-700">{{ $damage->created_at->format('M d, Y h:i A') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @php
                                    $images = json_decode($damage->image_path) ?? [];
                                @endphp

                                @if(count($images) > 0)
                                    <div class="mt-6">
                                        <h4 class="text-sm font-medium text-gray-500 mb-3">Images</h4>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                                            @foreach($images as $image)
                                                <a href="{{ asset('storage/' . $image) }}" target="_blank" class="group">
                                                    <div class="aspect-w-4 aspect-h-3 rounded-lg overflow-hidden border border-gray-200 group-hover:border-blue-300 transition-colors">
                                                        <img src="{{ asset('storage/' . $image) }}" 
                                                             alt="{{ $damage->name }}" 
                                                             class="w-full h-full object-cover">
                                                    </div>
                                                </a>
                                            @endforeach
                                        </div>
                                    </div>
                                @else
                                    <div class="mt-4 p-4 bg-gray-50 rounded-lg text-center">
                                        <p class="text-gray-500">No images available for this damage</p>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12">
                        <div class="mx-auto h-20 w-20 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                            <svg class="h-10 w-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Damage Details Found</h3>
                        <p class="text-gray-500">No damage reports are available for this appointment</p>
                    </div>
                @endif

                <!-- Back Button -->
                <div class="mt-12 text-center">
                    <a href="{{ route('provider.appointments') }}"
                       class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-gray-600 to-gray-700 hover:from-gray-700 hover:to-gray-800 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-[1.02]">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                        Back to Appointments
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection