@extends('layout.app')

@section('content')
<div class="max-w-screen-xl mx-auto p-4">
    <h1 class="text-3xl font-bold mb-8 text-center text-black">Appointments</h1>

    @php
        $acceptedAppointments = $appointments
            ->where('status', 'accepted')
            ->sortBy(function($appointment) {
                return $appointment->appointment_time ? strtotime($appointment->appointment_time) : PHP_INT_MAX;
            });

        $pendingAppointments = $appointments
            ->where('status', 'pending')
            ->sortBy(function($appointment) {
                return $appointment->appointment_time ? strtotime($appointment->appointment_time) : PHP_INT_MAX;
            });
    @endphp

    {{-- Pending Appointments --}}
    <div class="mb-12">
        <h2 class="text-2xl font-semibold mb-4 text-black">Pending Appointments</h2>

        @if($pendingAppointments->isEmpty())
            <div class="bg-blue-50 p-6 rounded-lg text-center text-black">
                No pending appointments found.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($pendingAppointments as $appointment)
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 border-t-4 border-blue-500">
                        <div>
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                        <path d="M12 8v4l3 3m6 4a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                                <h2 class="ml-4 text-xl font-semibold text-gray-800">
                                    {{ $appointment->service->name ?? 'Service not found' }}
                                </h2>
                            </div>

                            <div class="space-y-3 text-gray-700">
                                <div class="flex items-center">
                                    <span class="w-28 font-medium">Customer:</span>
                                    <span>{{ $appointment->homeowner->name ?? 'Unknown Customer' }}</span>
                                </div>

                                <div class="flex items-center">
                                    <span class="w-28 font-medium">Date:</span>
                                    <span>
                                        {{ $appointment->appointment_time 
                                            ? Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A')
                                            : 'Time not set' }}
                                    </span>
                                </div>

                                @if(!empty($appointment->notes))
                                    <div class="flex items-start">
                                        <span class="w-28 font-medium">Notes:</span>
                                        <span>{{ $appointment->notes }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="mt-6 flex gap-4">
                            <form action="{{ route('appointment.accept', $appointment->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow-md transform transition duration-300 hover:scale-105">
                                    Accept
                                </button>
                            </form>
                        
                            <form action="{{ route('appointment.decline', $appointment->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-4 py-2 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg shadow-md transform transition duration-300 hover:scale-105">
                                    Reject
                                </button>
                            </form>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <div>
        <h2 class="text-2xl font-semibold mb-4 text-black">Accepted Appointments</h2>
    
        @if($acceptedAppointments->isEmpty())
            <div class="bg-blue-50 p-6 rounded-lg text-center text-black">
                No accepted appointments found.
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($acceptedAppointments as $appointment)
                    <div class="bg-white p-6 rounded-2xl shadow-lg hover:shadow-2xl transition duration-300 border-t-4 border-blue-500">
                        <div class="flex items-center mb-4">
                            <div class="bg-blue-100 text-blue-600 p-3 rounded-full">
                                <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                            <h2 class="ml-4 text-xl font-semibold text-gray-800">
                                {{ $appointment->service->name ?? 'Service not found' }}
                            </h2>
                        </div>
    
                        <div class="space-y-3 text-gray-700">
                            <div class="flex items-center">
                                <span class="w-28 font-medium">Customer:</span>
                                <span>{{ $appointment->homeowner->name ?? 'Unknown Customer' }}</span>
                            </div>
    
                            <div class="flex items-center">
                                <span class="w-28 font-medium">Date:</span>
                                <span>
                                    {{ $appointment->appointment_time 
                                        ? Carbon\Carbon::parse($appointment->appointment_time)->format('M d, Y h:i A')
                                        : 'Time not set' }}
                                </span>
                            </div>
    
                            @if(!empty($appointment->notes))
                                <div class="flex items-start">
                                    <span class="w-28 font-medium">Notes:</span>
                                    <span>{{ $appointment->notes }}</span>
                                </div>
                            @endif
                        </div>
    
                        <div class="mt-6 flex flex-col sm:flex-row gap-3 justify-between">
                            <span class="inline-flex items-center justify-center bg-blue-100 text-blue-700 text-xs px-3 py-1 rounded-full h-6">
                                Accepted
                            </span>                            
    
                            @if($appointment->contract)
                                <a href="{{ route('contract.byAppointment', $appointment->id) }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm transition duration-200">
                              View Contract
                                </a>
                            @else
                            <span>No contract available.</span>
                            @endif

                        </div>
                        <div class="mt-4">
                            <a href="{{ route('appointments.damage-report', $appointment->id) }}" 
                               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg text-sm transition duration-200">
                                View Damage Details
                            </a>
                        </div>
                        
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    

</div>
@endsection
