@extends('layout.app')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <h1 class="text-2xl font-semibold mb-4">Your Appointments</h1>
    
    @if($appointments->isEmpty())
        <div class="bg-gray-50 p-4 rounded-md text-gray-600">
            No appointments found.
        </div>
    @else
        <div class="grid gap-4">
            @foreach($appointments as $appointment)
                <div class="bg-white p-6 border border-gray-200 rounded-lg shadow-sm">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="space-y-2">
                            <div class="flex items-start">
                                <span class="text-gray-600 font-medium w-24">Service:</span>
                                <span class="text-gray-900">
                                    @if($appointment->service)
                                        {{ $appointment->service->name }}
                                    @else
                                        <span class="text-gray-500 italic">Service not found</span>
                                    @endif
                                </span>
                            </div>
                            
                            <div class="flex items-start">
                                <span class="text-gray-600 font-medium w-24">Date:</span>
                                <span class="text-gray-900">
                                    {{ $appointment->appointment_time ? Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A') : 'Time not set' }}
                                </span>
                            </div>

                            <div class="flex items-start">
                                <span class="text-gray-600 font-medium w-24">Status:</span>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    @if($appointment->status === 'pending')
                                        bg-yellow-100 text-yellow-800
                                    @elseif($appointment->status === 'accepted')
                                        bg-green-100 text-green-800
                                    @elseif($appointment->status === 'declined')
                                        bg-red-100 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </div>

                            @if($appointment->notes)
                                <div class="flex items-start">
                                    <span class="text-gray-600 font-medium w-24">Notes:</span>
                                    <span class="text-gray-900">{{ $appointment->notes }}</span>
                                </div>
                            @endif
                        </div>

                        @if($appointment->status === 'pending')
                            <div class="flex items-center space-x-3 md:justify-end">
                                <a href="{{ route('appointment.accept', $appointment->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-colors">
                                    Accept
                                </a>

                                <a href="{{ route('appointment.decline', $appointment->id) }}" 
                                   class="inline-flex items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-medium rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                    Decline
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection