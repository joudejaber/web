@extends('layout.app')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">Available Services</h1>
        <p class="mt-2 text-gray-600">Browse through our range of professional renovation services</p>
    </div>

    @if($services->isEmpty())
        <div class="bg-gray-50 rounded-lg p-8 text-center">
            <p class="text-gray-600">No services available at the moment.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($services as $service)
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow">
                    <div class="relative h-48 w-full overflow-hidden">
                        <img src="{{ asset('storage/' . $service->image) }}" 
                             alt="{{ $service->name }}" 
                             class="w-full h-full object-cover">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-900">{{ $service->name }}</h2>
                            <span class="px-3 py-1 text-sm font-medium text-blue-600 bg-blue-100 rounded-full">
                                {{ $service->type }}
                            </span>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center text-gray-600">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                <span>{{ $service->provider->name }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('appointments.create', ['service_id' => $service->id]) }}" 
                               class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                                Book Appointment
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection